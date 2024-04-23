<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usuario;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function index()
    {
        return view('login.login');
    }

    public function logar(Request $request)
    {
        try {
            $login = $request->login;
            $senha = $request->senha;
            $user = DB::table('usuarios')->where('login', '=', $login, 'and', 'senha', '=', $senha)->first();
            if ($user) {
                $request->session()->put('logado', true);
                $request->session()->put('nomeUsuario', $user->nome);
                $request->session()->put('codUsuario', $user->cod_usuario);
                if($login == 'admin'){
                    $request->session()->put('admin', true);
                }
                return redirect('/menu');
            } else {
                return redirect('/')->with('msg.erro', 'Login e/ou Senha incorreta');
            }
        } catch (Exception  $e) {
            return redirect('/')->with('msg.erro', 'Login e/ou Senha incorreta, Código de erro: ' . $e->getCode());
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect("/");
    }
}
