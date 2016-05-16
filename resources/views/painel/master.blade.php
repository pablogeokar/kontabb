<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Kontabb | Contabilidade Borges</title>

        <!-- Bootstrap core CSS -->
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

        <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
        <!--<link href="{{asset('css/animate.min.css')}}" rel="stylesheet">-->

        <!-- Custom styling plus plugins -->
        <link href="{{asset('css/custom.css')}}" rel="stylesheet">

        <script src="{{asset('js/jquery.min.js')}}"></script>
        <!--<script src="{{asset('js/nprogress.js')}}"></script>-->


        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>


    <body class="nav-md">

        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">

                        <div class="navbar nav_title" style="border: 0;">
                            <a href="{{url('/painel')}}" class="site_title"><!--<i class="fa fa-paw">--></i><span>Kontabb</span></a>
                        </div>
                        <div class="clearfix"></div>

                        <!-- menu prile quick info -->
                        <div class="profile">
                            <div class="profile_pic">
                                {{-- Carrega a imagem do avatar se existir --}}
                                @if (is_file("images/usuarios/". Auth::user()->id.'.png'))
                                <img src="{{asset('images/usuarios/'.Auth::user()->id.'.png')}}" alt="..."
                                     class="img-circle profile_img">
                                @elseif (is_file("images/usuarios/". Auth::user()->id.'.jpg'))
                                <img src="{{asset('images/usuarios/'.Auth::user()->id.'.jpg')}}" alt="..."
                                     class="img-circle profile_img">
                                @else
                                <img src="{{asset('images/usuarios/default.gif')}}" alt="..."
                                     class="img-circle profile_img">
                                @endif
                            </div>
                            <div class="profile_info">
                                <span>Bem Vindo,</span>
                                <h2>{{ Auth::user()->name }}</h2>
                            </div>
                        </div>
                        <!-- /menu prile quick info -->

                        <br/>

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                            <div class="menu_section">
                                <h3>Painel de Controle</h3>
                                <ul class="nav side-menu">
                                    <li><a><i class="fa fa-edit"></i> Cadastros <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="{{url('painel/usuarios')}}">Usuários</a></li>
                                            <li><a href="{{url('painel/clientes')}}">Clientes</a></li>
                                            <li><a href="{{url('painel/obrigacoes')}}">Obrigações</a></li>
                                        </ul>
                                    </li>                                    
                                </ul>
                            </div>

                        </div>
                        <!-- /sidebar menu -->


                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">

                    <div class="nav_menu">
                        <nav class="" role="navigation">
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>

                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                                       aria-expanded="false">

                                        {{-- Carrega a imagem do avatar se existir --}}
                                        @if (is_file("images/usuarios/". Auth::user()->id.'.png'))
                                        <img src="{{asset('images/usuarios/'.Auth::user()->id.'.png')}}"
                                             alt="">{{ Auth::user()->name }}
                                        @elseif(is_file("images/usuarios/". Auth::user()->id.'.jpg'))
                                        <img src="{{asset('images/usuarios/'.Auth::user()->id.'.jpg')}}"
                                             alt="">{{ Auth::user()->name }}
                                        @else
                                        <img src="{{asset('images/usuarios/default.gif')}}"
                                             alt="">{{ Auth::user()->name }}
                                        @endif
                                        {{-- fim do Carregamento de imagem do avatar --}}

                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">                              
                                        <li><a href="{{url('/logout')}}"><i class="fa fa-sign-out pull-right"></i> Sair</a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- NOTIFICAÇÕES                        
                               FIM NOTIFICAÇÕES-->
                            </ul>
                        </nav>
                    </div>

                </div>
                <!-- /top navigation -->


                <!-- page content -->                
                <div class="right_col" role="main">
                    <div class="">        
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        @yield('content')                   
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- footer content -->
                    <footer>
                        <div class="copyright-info">
                            <p class="pull-right">&copy;{{date('Y')}} - Todos os direitos reservados - <a href="http://www.kontabb.com.br">kontabb - Contabilidade Borges</a>
                            </p>
                        </div>
                        <div class="clearfix"></div>
                    </footer>
                    <!-- /footer content -->
                </div>
                <!-- /page content -->



            </div>

        </div>

        <div id="custom_notifications" class="custom-notifications dsp_none">
            <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">

            </ul>
            <div class="clearfix"></div>
            <div id="notif-group" class="tabbed_notifications"></div>
        </div>

        <!-- Modal Exclusão -->
        <div class="modal fade" id="ModalExclusao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão</h4>
                    </div>
                    <div class="modal-body">
                        <h2>Deseja realmente realizar a exclusão?<br>
                            Esta operação não poderá ser desfeita.
                        </h2>
                    </div>
                    <div class="modal-footer">                                             
                        <a href="#" class="btn" data-dismiss="modal">Cancelar</a>
                        <a href="#" id="btnExclui" class="btn btn-danger">Excluir</a>                       
                    </div>
                </div>
            </div>
        </div>
        <!-- /Modal Exclusão-->

        <script src="{{asset('js/bootstrap.min.js')}}"></script>

        <!-- gauge js 
        <script type="text/javascript" src="{{asset('js/gauge/gauge.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/gauge/gauge_demo.js')}}"></script>-->
        <!-- bootstrap progress js -->
        <script src="{{asset('js/progressbar/bootstrap-progressbar.min.js')}}"></script>
        <script src="{{asset('js/nicescroll/jquery.nicescroll.min.js')}}"></script>

        <script src="{{asset('js/custom.js')}}"></script>
        <script src="{{asset('js/pablo.js')}}"></script> 
        @yield('script')
    </body>

</html>

