@extends('painel.master')

@section('content')

<h2>Listagem de Usuários</h2>
<div class="row">
    <div class="col-md-6">
        <a href="{{url('painel/usuarios/cadastrar/')}}" class="btn btn-info"><i class="fa fa-user-plus" aria-hidden="true"></i> Novo Usuário</a>
    </div>
</div>


<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_content">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>e-mail</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                    <tr>
                        <th scope="row">{{$usuario->id}}</th>
                        <td>
                            <a href="{{url('painel/usuarios/editar')}}/{{$usuario->id}}">{{$usuario->name}}</a>
                        </td>
                        <td>{{$usuario->email}}</td>
                        <td>
                            <!-- Excluir -->
                            <a class="btn btn-sm btn-danger" href="#" data-acao="{{url("painel/usuarios/excluir/".$usuario->id)}}" id="exclui{{$usuario->id}}" data-target="#ModalExclusao" data-toggle="modal">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                                Excluir
                            </a>                            
                            <!-- /Excluir -->
                            <!-- Editar -->
                            <a class="btn btn-sm btn-primary" href="{{url('painel/usuarios/editar')}}/{{$usuario->id}}">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Alterar
                            </a>                            
                            <!-- /Editar -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection

