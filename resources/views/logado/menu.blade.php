@extends('layout.logado')
@section('titulo', 'Menu')
@section('head')
    <style>
        body {
            background-color: #e0e0e0;
        }

        @media(min-width: 1000px) {
            .conteudo {
                width: 800px;
                height: 320px;
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
            text-align: center;
        }
    </style>
@endsection
@section('conteudo')
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="conteudo">
            <div class="row w-75 mx-auto">
                <x-msg.sucesso />
                <x-msg.erro />
            </div>
            <div class="my-5">
                <div class="row">
                    <h2 class="fs-1 text-center">Bem vindo, {{ session('nomeUsuario') }}</h2>
                </div>
                <div class="row w-100 d-flex justify-content-center align-items-center mx-auto">
                    <a class="w-75 mt-3 btn fs-5 d-flex justify-content-center align-items-center" href='/buscarComanda'
                        style="background-color: #881E3B; color: white; height:60px;">Iniciar
                        Pedido</a>
                    <a class="w-75 mt-3 btn fs-5 d-flex justify-content-center align-items-center" href='/sair'
                        style="background-color: #881E3B; color: white; height:60px; ">Sair</a>
                </div>
            </div>
        </div>
    </div>
@endsection
