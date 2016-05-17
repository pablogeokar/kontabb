@extends('painel.master')

@section('content')

<div class="col-md-12 col-sm-12 col-xs-12">
    @if( isset($cpf_cnpj))
    <form method="post" action="{{url('/painel/clientes/editar/'.$cpf_cnpj)}}"
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
                        <h2>Informações Principais</h2>
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="cpf_cnpj">C.P.F/C.N.P.J.</label>  
                            <div class="col-md-6">
                                <input name="cpf_cnpj" class="form-control input-md" id="cpf_cnpj" required="" type="text" placeholder="digite o CPF ou CNPJ" value="{{$clientes->cpf_cnpj or null}}">
                                <span class="help-block">Apenas números sem pontos ou traços</span>  
                            </div>
                        </div>

                        <!-- Select -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="id_forma_tributacao">Forma de Tributação</label>  
                            <div class="col-md-6">                                
                                <select class="form-control" name="id_forma_tributacao">
                                    @foreach ($formasTributacao as $opcao)                                                                                                                                              

                                    @if (isset($clientes))

                                    @if($clientes->id_forma_tributacao == $opcao->id)

                                    <option selected="selected" value="{{$opcao->id}}">{{$opcao->nome}}</option>
                                    @else

                                    <option value="{{$opcao->id}}">{{$opcao->nome}}</option>
                                    @endif

                                    @else

                                    <option value="{{$opcao->id}}">{{$opcao->nome}}</option>
                                    @endif

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="nome_razaosocial">Nome/Razão Social</label>  
                            <div class="col-md-6">
                                <input name="nome_razaosocial" class="form-control input-md" id="nome_razaosocial" required="" type="text" placeholder="digite o Nome/Razão Social" value="{{$clientes->nome_razaosocial or null}}">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="nome_responsavel">Nome do responsável</label>  
                            <div class="col-md-6">
                                <input name="nome_responsavel" class="form-control input-md" id="nome_responsavel" type="text" placeholder="digite o nome do responsável" value="{{$clientes->nome_responsavel or null}}">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="cpf_responsavel">C.P.F. do responsável</label>  
                            <div class="col-md-6">
                                <input name="cpf_responsavel" class="form-control input-md" id="cpf_responsavel" type="text" placeholder="digite o CPF do responsável" value="{{$clientes->cpf_responsavel or null}}">
                                <span class="help-block">Apenas números sem pontos ou traços</span>  
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="codigo_simplesnacional">Código de acesso Simples Nacional</label>  
                            <div class="col-md-6">
                                <input name="codigo_simplesnacional" class="form-control input-md" id="codigo_simplesnacional" type="text" placeholder="digite o código de acesso do Simples Nacional" value="{{$clientes->codigo_simplesnacional or null}}">
                                <span class="help-block">Apenas números sem pontos ou traços</span>  
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="login_sefaz_ba">Login Sefaz-BA</label>  
                            <div class="col-md-6">
                                <input name="login_sefaz_ba" class="form-control input-md" id="login_sefaz_ba" type="text" placeholder="digite o código de acesso da Sefaz-BA" value="{{$clientes->login_sefaz_ba or null}}">
                                <span class="help-block">Apenas números sem pontos ou traços</span>  
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="senha_sefaz_ba">Senha de acesso - Sefaz-BA</label>  
                            <div class="col-md-6">
                                <input name="senha_sefaz_ba" class="form-control input-md" id="senha_sefaz_ba" type="text" placeholder="digite a senha de acesso da Sefaz-BA" value="{{$clientes->senha_sefaz_ba or null}}">                                
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">E-mail</label>  
                            <div class="col-md-6">
                                <input name="email" class="form-control input-md" id="email" type="email" placeholder="digite o e-mail" value="{{$clientes->email or null}}">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="password">Senha</label>  
                            <div class="col-md-6">
                                <input name="password" class="form-control input-md" id="password" type="password" placeholder="senha para acesso a área do cliente" value="{{$clientes->password or null}}">

                            </div>
                        </div>

                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="salvar"></label>
                            <div class="col-md-6">
                                <button name="salvar" class="btn btn-inverse" id="salvar">Salvar</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- configuracoes gerais -->
            <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">                        
                        <h2>Configurações Gerais</h2>
                        <i class="fa fa-wrench" aria-hidden="true"></i>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="form-group">
                            
                            <h4>Obrigações Mensais</h4>
                            <div class="separator"></div>
                            
                            <div class="checkbox">
                                <label>
                                  {{ Form::checkbox('cl_fl_pagto', ($clientes->cl_fl_pagto or 0), ($clientes->cl_fl_pagto or 0)  ) }}
                                    Folha de Pagamento Mensal.
                                </label>
                            </div>
                            
                            <div class="checkbox">
                                <label>
                                  {{ Form::checkbox('cl_gps', ($clientes->cl_gps or 0), ($clientes->cl_gps or 0)  ) }}
                                    GPS.
                                </label>
                            </div>                            
                            
                            <div class="checkbox">
                                <label>
                                  {{ Form::checkbox('cl_fgts', ($clientes->cl_fgts or 0), ($clientes->cl_fgts or 0)  ) }}
                                    FGTS.
                                </label>
                            </div>  
                            
                            <div class="checkbox">
                                <label>
                                  {{ Form::checkbox('cl_simples', ($clientes->cl_simples or 0), ($clientes->cl_simples or 0)  ) }}
                                    DAS Simples Nacional.
                                </label>
                            </div>
                            
                             <div class="checkbox">
                                <label>
                                  {{ Form::checkbox('cl_darf_prolabore', ($clientes->cl_darf_prolabore or 0), ($clientes->cl_darf_prolabore or 0)  ) }}
                                    DARF Pro-Labore.
                                </label>
                            </div>
                            
                             <div class="checkbox">
                                <label>
                                  {{ Form::checkbox('cl_cont_sindical', ($clientes->cl_cont_sindical or 0), ($clientes->cl_cont_sindical or 0)  ) }}
                                    Contribuição Sindical.
                                </label>
                            </div> 
                            
                        </div>
                    </div>                    
                </div>
            </div>
            <!-- /configuracoes gerais -->

        </form>
</div>


@endsection
