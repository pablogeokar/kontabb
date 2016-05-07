@extends('painel.master')

@section('content')


<div class="col-md-12 col-sm-12 col-xs-12">
    @if( isset($id))
    <form method="post" action="/painel/usuarios/editar/{{$id}}"
          class="form-horizontal form-label-left" id="demo-form2" novalidate=""
          data-parsley-validate="" enctype="multipart/form-data">
        @else
        <form method="post" action="/painel/usuarios/cadastrar"
              class="form-horizontal form-label-left" id="demo-form2" novalidate=""
              data-parsley-validate="">
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

            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <div class="form-group">
                        <a href="" id="upload_link">                             
                            {{-- Carrega a imagem do avatar se existir --}}
                            @if( isset($id))
                            @if (is_file("images/usuarios/".$id.'.png'))
                            <img src="{{asset('images/usuarios/'.$id.'.png')}}"
                                 title="Alterar Imagem"
                                 class="img-responsive avatar-view">
                            @elseif(is_file("images/usuarios/".$id.'.jpg'))
                            <img src="{{asset('images/usuarios/'.$id.'.jpg')}}"
                                 title="Alterar Imagem"
                                 class="img-responsive avatar-view">
                            @else
                            <img src="{{asset('images/usuarios/default.gif')}}"
                                 title="Alterar Imagem"
                                 class="img-responsive avatar-view">
                            @endif
                            @else
                            <img src="{{asset('images/usuarios/default.gif')}}"
                                 title="Alterar Imagem" class="img-responsive avatar-view">
                            @endif
                            {{-- fim do Carregamento de imagem do avatar --}}
                        </a>
                        <input name="foto" id="upload" type="file"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Código: </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="id" disabled="disabled" class="form-control" type="text"
                           placeholder="código automático"
                           value="{{$usuarios->id or null}}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                       for="first-name">Nome: <span
                        class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="name" class="form-control col-md-7 col-xs-12"
                           id="first-name"
                           required="required" type="text"
                           value="{{$usuarios->name or null}}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                       for="last-name">E-mail: <span
                        class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="email" class="form-control col-md-7 col-xs-12"
                           id="last-name"
                           required="required" type="email"
                           value="{{$usuarios->email or null}}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                       for="last-name">Senha: <span
                        class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="password" class="form-control col-md-7 col-xs-12"
                           id="last-name"
                           required="required" type="password">
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <!--<button class="btn btn-primary" type="submit">Cancel</button>-->
                    <button class="btn btn-success" type="submit">Salvar</button>
                </div>
            </div>

        </form>


</div>


<div class="clearfix"></div>





@endsection