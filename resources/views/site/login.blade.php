<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

    <!-- Bootstrap CSS -->
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
       
    <!-- Bootstrap Bundle with Popper -->
    <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- CSS do projeto -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    
    <title>Login</title>
</head>
<body>

    <div class="container col-10 col-md-10" id="form-container">
        <div class="row justify-content-center">
            <!-- imagem esquerda -->
            <div class="col-lg-5 col-10 p-0">
                <img src="{{asset('image/principal.jpeg')}}" alt="" class="img-fluid" id="imagem">
            </div>
            <!-- formulario direita -->
            <div class="col-lg-7 col-10">
                <div class="col-12" id="titulo">
                    <div class="box-geral-esquerda">
                        <div class="box-texto">
                        <h2><span id="signLoginTitle">Sistema de Produtos</span></h2>
                        </div>
                    </div>
                    

                <form id="formulario" action="{{route('site.login')}}" method="post" class="row justify-content-center">
                    @csrf
                    <div class="col-10">
                        <label for="" class="pt-3">E-mail</label>
                        <input id="email" name="email" type="text" class="col-12 padrao-input" placeholder="seu-email@teste.com">
                            
                        </input>
                    </div>
                    <div class="col-10">
                        <label for="" class="pt-3">Senha</label>
                        <input id="password" name="password" type="password" class="col-12 padrao-input" placeholder="Sua senha">
                            
                        </input>
                    </div>
                    
                    
                    <div class="col-10">    
                        {{-- <a href="#" id="inscreva-se" type="text" class="col-12 btn btn-primary mt-5">
                            Login
                        </a> --}}
                        <button type="submit" class="col-12 btn btn-primary mt-5">Login</button>
                    </div>      
                    <div class="col-10">    
                        {{-- <a href="/cadastro.html" id="inscreva-se" type="text" class="col-12 mt-5">
                            Nao tenho login
                        </a> --}}
                        {{isset($erro) && $erro != '' ? $erro : ""}}
                    </div>      
                </form>
            </div>
        </div>
    </div>

</body>
</html>