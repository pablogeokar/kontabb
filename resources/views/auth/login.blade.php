<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Kontabb | Contabilidade Borges</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styling plus plugins -->
        <link href="css/custom.css" rel="stylesheet">

        <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">

        <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body style="background:#F7F7F7;">

        <div id="wrapper">
            <div id="login">
                <section class="login_content">
                    <img src="images/logo-png.png" alt="">
                    <form method="POST" action="{{ url('/login') }}">
                        <h1>Acesso ao Sistema</h1>
                        {!! csrf_field() !!}
                        
                        <!--Mensagens do Sistema -->
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                        @if ($errors->has('email'))
                        <div class="alert alert-error">
                            {{ $errors->first('email') }}
                        </div>
                        @endif
                        <!--/Mensagens do Sistema -->
                        
                        <div>
                            <input type="text" class="form-control" placeholder="e-mail" required="" name="email"/>
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Senha" required="" name="password"/>
                        </div>
                        <div>
                            <input type="submit" class="btn btn-default submit" value="Logar" name="logar"/>
                            <!--<a class="reset_pass" href="{{ url('/password/reset')}}" data-target="#ModalLembrarSenha" data-toggle="modal">esqueci minha senha?</a>-->
                            <a class="reset_pass" href="" data-target="#ModalLembrarSenha" data-toggle="modal">esqueci minha senha?</a>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </section>
            </div>
        </div>

        <!-- Modal lembrar Senha -->
        <div class="modal fade" id="ModalLembrarSenha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Redefinir Senha</h4>
                    </div>
                    <div class="modal-body">                        

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                            {!! csrf_field() !!}
                            
                            <div class="form-group">
                                <label class="col-md-4 control-label">Seu e-mail</label>
                                <div class="col-md-8">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-info">
                                        <i class="fa fa-btn fa-envelope"></i> Enviar link para redefinir senha
                                    </button>
                                </div>
                            </div>
                        </form>                        

                    </div>                    
                </div>
            </div>
        </div>
        <!-- /Modal Exclusão-->
        
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
    </body>

</html>
