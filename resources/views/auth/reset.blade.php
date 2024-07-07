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
    <link href="{{asset('css/style_v2.css')}}" rel="stylesheet">

    <title>Sistema de Produtos</title>

</head>
<body>

    <div class="container-fluid" id="form-container">
        <div class="row contentInscricao">
            <!-- imagem esquerda -->
            <div id="imagem-fundo" class="col-lg-7 col-md-7 col-xs-12"> 
                <img src="{{asset('image/logo.png')}}" alt="logo" class="imagem-logo">
            </div>

            <!-- formulario direita -->
            <div class="col-lg-5 col-md-5 col-xs-12 loginArea">
                <div class="col-12" id="titulo">
                    <div class="box-geral-esquerda">
                        <div class="box-texto">
                          <h2><span id="signLoginTitle">Sistema de Produtos</span></h2>
                        </div>
                    </div>

                </div>

                @if(isset($arr) && $arr['success'] == true)
                    <div id="formLogin">
                        <form id="formulario" action="{{route('reset-pass')}}" method="post" class="row justify-content-center">
                            @csrf

                            <div class="alert alert-success" role="alert">
                                {{ $arr['message'] }}
                            </div>

                        </form>
                    </div>
                @else 
                    <div id="formLogin">
                        <form id="formulario" action="{{route('reset-pass')}}" method="post" class="row justify-content-center">
                            @csrf

                            @if(isset($arr) && $arr['success'] == false)
                                <div class="row firstDiv">
                                    <div class="alert alert-danger" role="alert">
                                        {{ $arr['message'] }}
                                    </div>
                                </div>
                            @endif

                            <div class="form-group col-12 col-md-12 ">
                                <label for="">E-mail <small>(Será enviado instruções por email)</small></label>
                                <input type="text" name="email" id="email" class="form-control"  placeholder="E-mail" value="">  
                                {{-- <i class="bi bi-person-fill icon-input"></i>       --}}
                            </div>

                            <div class="form-group col-12 col-md-12">
                                <div class=" justify-content-center">
                                    <button type="submit" class="col-10 col-md-6 btn btn-primary btn-lg mt-5">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
                <hr>
                <div class="row justify-content-center align-items-end">
                    <footer class="mt-auto footerLogin">Sistema de Produtos LTDA © {{date('Y')}}</footer>        
                </div>
            </div>
        </div>
    </div>


{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-1.9.1.js"></script> --}}




</body>
</html>




            