@if (session('logado'))
    {{ redirect('/menu')->send() }}
@else
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login</title>
        <script src="{{ URL::asset('js/bootstrap.bundle.js') }}"></script>
        <link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet">
        <style>
            body {
                background-color: #e0e0e0;
            }

            @media(min-width: 1000px) {

                input[type="text"],
                [type="password"],
                [type="submit"] {
                    width: 600px;
                    heigth: 60px;
                }

                .conteudo {
                    width: 800px;
                    height: 320px;
                    border-radius: 25px;
                    background-color: #ffffff;
                    box-shadow: black 1px;
                }
            }

            @media(max-width: 800px) {

                input[type="text"],
                [type="password"],
                [type="submit"] {
                    width: 300px;
                }

                .conteudo {
                    width: 800px;
                    height: 320px;
                    border-radius: 25px;
                    background-color: #ffffff;
                    box-shadow: rgba(0, 0, 0, 0.336) 2px 2px 2px 2px;
                }
            }

            .form-control:focus {
                border-color: black !important;
                box-shadow: inset 0 1px 1px rgba(255, 0, 0, 0.075), 0 0 8px rgba(0, 0, 0, 0.6);
            }

            .form-control {
                border-color: #881E3B !important;
                border-width: 2px;
            }

            .pt-45 {
                padding-top: 2rem !important;
            }
        </style>
    </head>

    <body>
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="conteudo">
                <div class="row">
                    <h1
                        class="fs-1 text-center {{ session('msg') ? 'pt-2' : 'pt-45' }} {{ session('msg') ? '' : 'pb-3' }}">
                        Login</h1>
                </div>
                <div class="row w-75 mx-auto">
                    <x-msg.sucesso />
                    <x-msg.erro />
                </div>
                <div class="row">
                    <form action="/login" method="post" novalidate>
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control form-control-lg mx-auto" name="login"
                                placeholder="Login" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control form-control-lg mx-auto" name="senha"
                                placeholder="Senha" required>
                        </div>
                        <div class="d-flex justify-content-center">
                            <input type="submit" class="btn" style="background-color: #881E3B; color: white;"
                                value="Logar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            const form = document.querySelector("form");

            form.addEventListener(
                "submit",
                (e) => {
                    if (!form.checkValidity()) {
                        e.preventDefault();
                    }
                    form.classList.add("was-validated");
                    console.log("submit");
                },
                false
            );
        </script>
    </body>

    </html>
@endif
