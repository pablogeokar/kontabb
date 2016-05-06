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
                <div>
                    <input type="text" class="form-control" placeholder="e-mail" required="" name="email"/>
                </div>
                <div>
                    <input type="password" class="form-control" placeholder="Senha" required="" name="password"/>
                </div>
                <div>
                    <input type="submit" class="btn btn-default submit" value="Logar" name="logar"/>
                    <a class="reset_pass" href="{{ url('/password/reset') }}">esqueci minha senha?</a>
                </div>
                <div class="clearfix"></div>
            </form>
        </section>
    </div>
</div>


</div>


</body>

</html>
