@extends('painel.master')

@section('content')

<h2>Listagem de Usuários</h2>

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
                            <!-- Button trigger modal -->
                            <a class="btn btn-danger" href="#" data-acao="{{url("painel/usuarios/excluir/".$usuario->id)}}" id="exclui" data-target="#ModalExclusao" data-toggle="modal">Excluir</a>                            
                            <!-- /Button trigger modal -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection

