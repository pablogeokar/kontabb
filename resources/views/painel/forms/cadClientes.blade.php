@extends('painel.master')

@section('content')

<div class="col-md-12 col-sm-12 col-xs-12">
    @if( isset($id))
    <form method="post" action="{{url('/painel/clientes/editar/'.$id)}}"
          class="form-horizontal form-label-left">
        @else
        <form method="post" action="{{url('/painel/clientes/cadastrar/')}}"
              class="form-horizontal form-label-left">
            @endif

            @if( isset($errors) && count($errors) > 0 )
            <div class="form-group">
                <div class="alert alert-danger" role="alert">
                    @foreach( $errors->all() as $error)
                    {{$error}}<br>
                    @endforeach
                </div>
            </div>
            @endif

            {{csrf_field()}}

            <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Cadastro de Empresas</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="cpf_cnpj">C.P.F/C.N.P.J.</label>  
                            <div class="col-md-4">
                                <input name="cpf_cnpj" class="form-control input-md" id="cpf_cnpj" required="" type="text" placeholder="digite o CPF ou CNPJ" value="{{$clientes->cpf_cnpj or null}}">
                                <span class="help-block">Apenas números sem pontos ou traços</span>  
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="nome_razaosocial">Nome/Razão Social</label>  
                            <div class="col-md-4">
                                <input name="nome_razaosocial" class="form-control input-md" id="nome_razaosocial" required="" type="text" placeholder="digite o Nome/Razão Social" value="{{$clientes->nome_razaosocial or null}}">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="nome_responsavel">Nome do responsável</label>  
                            <div class="col-md-4">
                                <input name="nome_responsavel" class="form-control input-md" id="nome_responsavel" type="text" placeholder="digite o nome do responsável" value="{{$clientes->nome_responsavel or null}}">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="cpf_responsavel">C.P.F. do responsável</label>  
                            <div class="col-md-4">
                                <input name="cpf_responsavel" class="form-control input-md" id="cpf_responsavel" type="text" placeholder="digite o CPF do responsável" value="{{$clientes->cpf_responsavel or null}}">
                                <span class="help-block">Apenas números sem pontos ou traços</span>  
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="codigo_simplesnacional">Código de acesso Simples Nacional</label>  
                            <div class="col-md-4">
                                <input name="codigo_simplesnacional" class="form-control input-md" id="codigo_simplesnacional" type="text" placeholder="digite o código de acesso do Simples Nacional" value="{{$clientes->codigo_simplesnacional or null}}">
                                <span class="help-block">Apenas números sem pontos ou traços</span>  
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">E-mail</label>  
                            <div class="col-md-4">
                                <input name="email" class="form-control input-md" id="email" type="email" placeholder="digite o e-mail" value="{{$clientes->email or null}}">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="password">Senha</label>  
                            <div class="col-md-4">
                                <input name="password" class="form-control input-md" id="password" type="password" placeholder="senha para acesso a área do cliente" value="{{$clientes->password or null}}">

                            </div>
                        </div>

                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="salvar"></label>
                            <div class="col-md-4">
                                <button name="salvar" class="btn btn-inverse" id="salvar">Salvar</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </form>
</div>


@endsection
