@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Editar Usuário </h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br>
                  <form method="post" action="{{route('user_update', ['id' => $user->id])}}" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                      {{csrf_field()}}

                    <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Nome </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="name" value="{{$user->name}}" autofocus name="name" required="required" class="form-control col-md-7 col-xs-12">
                        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">E-mail </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="email" name="email" value="{{$user->email}}" required="required" class="form-control col-md-7 col-xs-12">
                        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    @if(Auth::user()->isAdmin())
                    <div class="form-group {!! $errors->has('roles') ? 'has-error' : '' !!}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Acesso </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">

                        <select id="roles" name="roles" required="required" class="form-control col-md-7 col-xs-12">
                            @foreach($roles as $role)
                              <option value="{{$role->id}}" {{ $user->isAdmin() ? 'selected' : '' }}>{{$role->description}}</option>
                            @endforeach
                        </select>

                        {!! $errors->first('roles', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>
                    @endif

                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="{{route('users')}}" class="btn btn-primary" type="button">Cancelar</a>
                          <button  data-toggle="modal" data-target="#password" class="btn btn-danger" type="button">Alterar Senha</button>
                          <button type="submit" class="btn btn-success">Salvar</button>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>


          <div class="modal inmodal" id="password" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
              <div class="modal-content animated bounceInRight">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                          <h4 class="modal-title">Alterar Senha</h4>
                      </div>
                      <form method="post" action="{{route('user_update_password', ['id' => $user->id])}}">
                          {{csrf_field()}}
                        <div class="modal-body">
                            <div class="form-group">
                              <label>Senha</label>
                              <input type="text" name="password" autofocus placeholder="Informar Senha" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                  </div>
              </div>
          </div>


    </div>
    <!-- /page content -->
@endsection
