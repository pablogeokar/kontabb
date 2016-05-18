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
                    ), $mesAtual, ['class' => 'form-control', 'id' => 'mes']) }}
                {{ Form::text('ano', $anoAtual, ['class' => 'form-control', 'id' => 'ano']) }}
                @if ($atualizarObrigacoes != null)
                <a id="gerar" href="{{url('painel/obrigacoes/gerar-obrigacoes/')}}" class="btn btn-info"><i class="fa fa-calendar" aria-hidden="true"></i> Atualizar Obrigações <span class="badge">{{$qtdObrigacoes}}</span></a>
                <div class="alert bg-warning alert-dismissible fade in" role="alert">
                    <button class="close" aria-label="Close" type="button" data-dismiss="alert"><span aria-hidden="true">×</span>
                    </button>
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <strong>Atualização necessária ,</strong> clique no botão [Atualizar Obrigações] para atualizar a listagem.
                </div>
                @endif
            </div><!-- /col-sm-12-->
        </div><!-- /for-group-->
    </div><!-- /form-inline-->

</div>

<div class="separator"></div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">                               
                <div class="row">
                    {!! Form::hidden('',url('painel/obrigacoes'), ['id' => 'acao']) !!}
                    @if ($obrigacoes)                                                            
                    <div class="col-sm-3 col-xs-12 bg-primary" style="height: 30px;">C.N.P.J./Razão Social</div>
                    <div class="col-sm-1 col-xs-4 bg-primary">Folha Pagto.</div>
                    <div class="col-sm-1 col-xs-4 bg-primary">GPS</div>
                    <div class="col-sm-1 col-xs-4 bg-primary">FGTS</div>
                    <div class="col-sm-1 col-xs-4 bg-primary">DAS Simples</div>
                    <div class="col-sm-1 col-xs-4 bg-primary">DARF Pró-Labore</div>
                    <div class="col-sm-1 col-xs-4 bg-primary">Cont. Sindical</div>                    
                    <div class="clearfix bg-primary"></div>              
                    <div class="separator"></div> 
                </div>
                @else
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="alert bg-warning alert-dismissible fade in" role="alert">
                        <button class="close" aria-label="Close" type="button" data-dismiss="alert"><span aria-hidden="true">×</span>
                        </button>
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <strong>Sem obrigações lançadas para este mês,</strong> clique no botão gerar obrigações para que a tabela seja montada!
                    </div>
                    <a id="gerar" href="{{url('painel/obrigacoes/gerar-obrigacoes/')}}" class="btn btn-info"><i class="fa fa-calendar" aria-hidden="true"></i> Gerar Obrigações</a>
                </div>
                @endif
                @foreach($obrigacoes as $obrigacao)
                <div class="row">
                    {!! Form::open(array('url' => url('painel/obrigacoes/editar/'.$obrigacao['cpf_cnpj'].'/'.$obrigacao['mes'].'/'.$obrigacao['ano']))) !!}                                                         
                    <div class="col-sm-3 col-xs-12">{{$obrigacao['cpf_cnpj']}} - {{$obrigacao['nome_razaosocial']}}</div>
                    <div class="col-sm-1 col-xs-4">{{ ($obrigacao['cl_fl_pagto'] == 1) ? Form::checkbox('fl_pagto', 1, $obrigacao['fl_pagto']  ) : 'Não' }}</div>
                    <div class="col-sm-1 col-xs-4">{{ ($obrigacao['cl_gps'] == 1) ? Form::checkbox('gps', 1, $obrigacao['gps']  ) : 'Não' }}</div>
                    <div class="col-sm-1 col-xs-4">{{ ($obrigacao['cl_fgts'] == 1) ? Form::checkbox('fgts', 1, $obrigacao['fgts']  ) : 'Não' }}</div>
                    <div class="col-sm-1 col-xs-4">{{ ($obrigacao['cl_simples'] == 1) ? Form::checkbox('simples', 1, $obrigacao['simples']  ) : 'Não' }}</div>
                    <div class="col-sm-1 col-xs-4">{{ ($obrigacao['cl_darf_prolabore'] == 1) ? Form::checkbox('darf_prolabore', 1, $obrigacao['darf_prolabore']  ) : 'Não' }}</div>
                    <div class="col-sm-1 col-xs-4">{{ ($obrigacao['cl_cont_sindical'] == 1) ? Form::checkbox('cont_sindical', 1, $obrigacao['cont_sindical']  ) : 'Não' }}</div>
                    <div class="col-sm-1 col-xs-4">{{ Form::submit('Salvar', ['class' => 'btn-xs'])}}</div>                    
                    {!! Form::close() !!}
                    <div class="separator"></div>
                </div>
                @endforeach
            </div>            
        </div>        
    </div>    
</div>

@endsection

@section('script')

<script>
    $(document).ready(function () {

        var mes = $('#mes').val();
        var ano = $('#ano').val();
        var link = $('a#gerar').attr('href');
        var linklistagem = $('#acao').val();
        $('a#gerar').attr('href', link + '/' + mes + '/' + ano);

        $('#mes').on('change', function () {
            mes = $('#mes').val();
            ano = $('#ano').val();
            $('a#gerar').attr('href', link + '/' + mes + '/' + ano);
            window.location = linklistagem + '/index/' + mes + '/' + ano;
        });

    });
</script>

@endsection

