@extends('painel.master')

@section('content')

<div class="row">
    <div class="form-group">
        <div class="col-sm-12">
            <h2>Obrigações do Mês</h2>
        </div>
    </div>

    <div class="form-inline"> 
        <div class="form-group">
            <div class="col-sm-12">
                {{ Form::label('Período:  ', null, ['class' => 'control-label']) }}
                {{ Form::select('size',  array(
                    '1' => 'janeiro', 
                    '2' => 'Fevereiro',
                    '3' => 'Março',
                    '4' => 'Abril',
                    '5' => 'Maio',
                    '6' => 'Junho',
                    '7' => 'Julho',
                    '8' => 'Agosto',
                    '9' => 'Setembro',
                    '10' => 'Outubro',
                    '11' => 'Novembro',
                    '12' => 'Dezembro'
                    ), $mesAtual, ['class' => 'form-control']) }}
                {{ Form::text('ano', $anoAtual, ['class' => 'form-control']) }}
            </div><!-- /col-sm-12-->
        </div><!-- /for-group-->
    </div><!-- /form-inline-->

</div>

<div class="separator"></div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>C.N.P.J.</th>
                            <th>Razão Social</th>
                            <th>Fl.Pagamento</th>
                            <th>GPS</th>
                            <th>FGTS</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($obrigacoes as $obrigacao)
                            <tr>
                                <td>{{$obrigacao->cpf_cnpj}}</td>
                                <td>{{$obrigacao->nome_razaosocial}}</td>
                                <td>{{ ($obrigacao->cl_fl_pagto == 1) ? Form::checkbox('fl_pagto', $obrigacao->fl_pagto, $obrigacao->fl_pagto  ) : 'Não se aplica' }}</td>                               
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>            
        </div>        
    </div>    
</div>


@endsection

