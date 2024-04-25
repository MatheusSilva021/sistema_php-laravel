<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class usuarioController extends Controller
{
    public function index()
    {
        try {
            return view('logado.menu');
        } catch (Exception $e) {
            session()->flush();
            return redirect('/')->with('msg.erro', 'Não foi possível carregar a página, Código de erro: ' . $e->getCode());
        }
    }

    public function buscarComandaIndex()
    {
        try {
            return view('logado.comanda');
        } catch (Exception $e) {
            return redirect('/menu')->with('msg.erro', 'Não foi possível carregar a página, Código de erro: ' . $e->getCode());
        }
    }

    public function buscarComanda(Request $request)
    {
        try {
            $comanda = DB::table('comandas')->where('comanda', '=', $request->comanda)->first();
            if ($comanda) {
                return redirect('/comanda/' . $request->comanda);
            } else {
                DB::table('comandas')->insert(['comanda' => $request->comanda, 'mesa' => $request->mesa]);
                return redirect('/comanda/' . $request->comanda);
            }
        } catch (Exception $e) {
            return redirect('/buscarComanda')->with('msg.erro', 'Houve um erro, código do erro: ' . $e->getMessage());
        }
    }

    public function comandaIndex($comanda)
    {
        try {
            $pedidos = DB::table('pedidos')
                ->select('cod_pedido', 'desc_produto', 'quantidade_produto', 'observacao', 'status')
                ->where('comanda', '=', $comanda)
                ->get();


            return view('logado.pedido', ['pedidos' => $pedidos, 'comanda' => $comanda]);
        } catch (Exception $e) {
            return redirect('/buscarComanda')->with('msg.erro', 'Houve um erro, código do erro: ' . $e->getMessage());
        }
    }

    public function adicionarItemIndex($comanda)
    {
        try {


            $codigos = DB::table('grupos')
                ->select('cod_grupo', 'nome')
                ->get();

            $produtos = [];

            foreach ($codigos as $codigo) {
                $produtosDaCategoria = DB::table('produtos')
                    ->select('cod_produto', 'descricao', 'valor', 'cod_grupo')
                    ->where('estoque', '>', 0)
                    ->where('cod_grupo', $codigo->cod_grupo)
                    ->get();

                $produtos[$codigo->nome] = $produtosDaCategoria;
            }

            return view('logado.adicionarItem', ['comanda' => $comanda, 'codigos' => $codigos, 'produtos' => $produtos]);
        } catch (Exception $e) {
            return redirect('/comanda/' . $comanda)->with('msg.erro', 'Houve um erro, código do erro: ' . $e->getCode());
        }
    }

    public function adicionarItem(Request $request, $comanda)
    {
        try {
            $codProduto = $request->cod_prod;
            $quantidade = $request->quantidade;
            $observacao = $request->observacao;

            $mesa = DB::table('comandas')->select('mesa')->where('comanda', '=', $comanda)->first();


            $array = [];
            foreach ($codProduto as $i =>  $produto) {
                if ($quantidade[$i] > 0) {
                    $result = DB::table('produtos')
                        ->select('descricao', 'valor', 'cod_grupo')
                        ->where('cod_produto', '=', $produto)
                        ->first();

                    if ($observacao[$i] == null) {
                        $observacao[$i] = 'Nenhuma Observação';
                    }

                    $array[] = [
                        'cod_usuario' => session('codUsuario'),
                        'cod_produto' => $produto,
                        'comanda' => $comanda,
                        'desc_produto' => $result->descricao,
                        'quantidade_produto' => $quantidade[$i],
                        'valor_unit' => $result->valor,
                        'cod_grupo' => $result->cod_grupo,
                        'mesa' => $mesa->mesa,
                        'observacao' => $observacao[$i],
                        'status' => 0,
                        'created_at' => now()
                    ];
                }
            }
            DB::table('pedidos')->insert($array);
            return redirect('/comanda/' . $comanda)->with('msg.sucesso', 'Pedido inserido com sucesso');
        } catch (Exception $e) {
            return redirect('/comanda/' . $comanda)->with('msg.erro', 'Houve um erro, código do erro: ' . $e->getCode());
        }
    }

    public function cancelPed(Request $request)
    {
        try {
            $comanda = $request->comanda;
            $ped = DB::table('pedidos')
                ->select('status', 'comanda')
                ->where('cod_pedido', $request->codigoProd)
                ->first();

            if (session('admin') && $ped->status == 1) {
                $dados = DB::table('pedidos')
                    ->select('desc_produto', 'quantidade_produto', 'cod_usuario')
                    ->where('cod_pedido', $request->codigoProd)
                    ->first();

                $garcom = DB::table('usuarios')
                    ->select('nome')
                    ->where('cod_usuario', $dados->cod_usuario)
                    ->first();

                $insert = [
                    'garcom' => $garcom->nome,
                    'desc_produto' => $dados->desc_produto,
                    'quantidade_produto' => $dados->quantidade_produto,
                    'horario' => Carbon::now('America/Sao_Paulo')
                ];

                DB::table('ped_excluidos')
                    ->insert($insert);


                DB::table('pedidos')
                    ->where('cod_pedido', $request->codigoProd)
                    ->delete();

                return redirect('/comanda/' . $comanda)->with('msg.sucesso', 'O pedido foi excluido com sucesso');
            }
            if ($ped->status == 1) {
                return redirect('/comanda/' . $comanda)->with('msg.erro', 'O pedido já foi impresso na cozinha');
            } elseif ($ped->status == 0) {
                DB::table('pedidos')
                    ->where('cod_pedido', $request->codigoProd)
                    ->delete();
                return redirect('/comanda/' . $comanda)->with('msg.sucesso', 'O pedido foi excluido com sucesso');
            }
        } catch (Exception $e) {
            return redirect('/comanda/' . $comanda)->with('msg.erro', 'Houve um erro ao excluir o pedido, código:' . $e->getMessage());
        }
    }
}
