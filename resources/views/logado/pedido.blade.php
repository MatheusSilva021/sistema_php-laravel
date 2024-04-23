@extends('layout.logado')
@section('titulo', 'Pedidos')
@section('head')
    <style>
        body {
            background-color: #e0e0e0;
        }

        .py-6 {
            padding-top: 5rem !important;
            padding-bottom: 7rem !important;
        }

        @media(min-width: 1000px) {
            .conteudo {
                width: 800px;
                height: auto;
                border-radius: 25px;
                background-color: #ffffff;
                box-shadow: black 1px;
            }
        }

        @media(max-width: 800px) {
            .conteudo {
                width: 800px;
                height: auto;
                border-radius: 25px;
                background-color: #ffffff;
                box-shadow: rgba(0, 0, 0, 0.336) 2px 2px 2px 2px;
            }
        }

        a {
            text-decoration: none;
            color: white;
        }

        .btn-voltar {
            color: #881E3B !important;
        }

        .icon {
            width: 13px;
            height: 13px;
            background-size: cover;
            background-repeat: no-repeat;
            display: inline-block;
            background-image: url('data:image/png;base64,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');
        }

        .btn-add {
            height: 80px;
        }
    </style>
@endsection
@section('conteudo')
    <nav class="navbar fixed-top bg-body-tertiary">
        <div class="container-fluid">
            <h1 class="navbar-brand fs-3">Pedidos da comanda: {{ $comanda }}</h1>
            <ul class="navbar-nav me-2 mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="/menu" class="fs-5 btn-voltar"><i class="icon"></i>Voltar</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container d-flex justify-content-center align-items-center min-vh-100 py-6">
        <div class="container-fluid conteudo">
            <div class="row w-75 mx-auto  {{ session('msg') ? 'mt-3' : '' }}">
                <x-msg.sucesso />
                <x-msg.erro />
            </div>
            <h1 class="fs-3 mt-3 text-center">Itens cadastrados na Comanda:</h1>
            <div class="my-3 itens">
                @forelse ($pedidos as $pedido)
                    <h2 class="fs-5">Item: {{ $pedido->desc_produto }}</h2>
                    <h2 class="fs-5">Quantidade: {{ $pedido->quantidade_produto }}</h2>
                    <div class="col-sm-12 col-md-6">
                        <h2 class="fs-5">Observação:
                            {{ $pedido->observacao }}</h2>
                    </div>
                    @if ($pedido->status == 0)
                        <div class="d-flex justify-content-center mt-3">
                            <form action="/cancelPed" method="post">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="comanda" value="{{ $comanda }}" />
                                <input type="hidden" name="codigoProd" value="{{ $pedido->cod_pedido }}" />
                                <input type="submit" value="Cancelar" class="btn btn-danger">
                            </form>
                        </div>
                    @elseif (session('admin'))
                        <div class="d-flex justify-content-center mt-3">
                            <form action="/cancelPed" method="post">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="comanda" value="{{ $comanda }}" />
                                <input type="hidden" name="codigoProd" value="{{ $pedido->cod_pedido }}" />
                                <input type="submit" value="Cancelar" class="btn btn-danger">
                            </form>
                        </div>
                    @endif
                    @if (!$loop->last)
                        {!! '<hr>' !!}
                    @endif
                @empty
                    <h1 class="fs-4 text-center">Não há pedidos cadastrados</h1>
                @endforelse
            </div>
        </div>
    </div>

    <nav class="navbar fixed-bottom bg-body-tertiary">
        <div class="container-fluid">
            <a class="w-100" href="/adicionarItem/{{ $comanda }}"><button
                    class="btn btn-add btn-success w-100">Adicionar
                    Itens</button></a>
        </div>
    </nav>
@endsection
