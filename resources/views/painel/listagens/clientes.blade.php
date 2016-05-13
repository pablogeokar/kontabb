@extends('painel.master')

@section('content')

<h2>Listagem de Clientes</h2>
<div class="row">
    <div class="col-md-6">
        <a href="{{url('painel/clientes/cadastrar/')}}" class="btn btn-info"><i class="fa fa-user-plus" aria-hidden="true"></i> Novo Cliente</a>
    </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_content">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>CNPJ</th>
                        <th>Forma Tributação</th>
                        <th>Razão Social</th>
                        <th>CPF do Responsável</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                    <tr>
                        <td scope="row">{{$cliente->cpf_cnpj}}</td>
                        <td>{{$cliente->nome}}</td>
                        <td><a href="{{url('painel/clientes/editar')}}/{{$cliente->cpf_cnpj}}">{{$cliente->nome_razaosocial}}</a> </td>
                        <td>{{$cliente->cpf_responsavel}}</td>
                        <td>
                            @if($cliente->codigo_simplesnacional != '')
                            <a href="{{asset('servicos/simplesnacional/')}}?cnpj={{$cliente->cpf_cnpj}}&cpf={{$cliente->cpf_responsavel}}&codigo={{$cliente->codigo_simplesnacional}}" target="_blank">
                                <img src="{{asset('images/simples.png')}}" style="width: 28px; height: 28px; margin-top: 0;" title="Acessar o portal do Simples Nacional"/>
                            </a>
                            @endif

                            @if($cliente->login_sefaz_ba != '' && $cliente->senha_sefaz_ba != '')
                            <a href="{{asset('servicos/sefaz-ba/')}}?login={{$cliente->login_sefaz_ba}}&senha={{$cliente->senha_sefaz_ba}}" target="_blank">
                                <img src="{{asset('images/sefaz-ba.ico')}}" style="width: 28px; height: 28px; margin-top: 0;" title="Notas fiscais destinatário Sefaz-BA"/>
                            </a>
                            @endif

                        </td>


                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
