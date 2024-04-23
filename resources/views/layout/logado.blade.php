@if (session('logado'))
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('titulo')</title>
        <script src="{{ URL::asset('js/jquery-3.7.1.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.bundle.js') }}"></script>
        <link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet">
        @section('head')

        @show
    </head>

    <body>
        @section('conteudo')

        @show
    </body>
@else
    {{ redirect('/')->send() }}
@endif
