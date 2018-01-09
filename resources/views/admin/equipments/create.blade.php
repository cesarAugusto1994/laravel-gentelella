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
                  <h2>Novo Equipamento </h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br>

                  <form method="POST" action="{{route('equipments_store')}}" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nome <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="name" autofocus id="name" value="{{old('name')}}" required="required" class="form-control col-md-7 col-xs-12">
                        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="form-group {!! $errors->has('brand') ? 'has-error' : '' !!}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Marca </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="brand" required>
                          <option value="">Selecione uma Marca</option>
                          @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                          @endforeach
                        </select>
                        {!! $errors->first('brand', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="form-group {!! $errors->has('model') ? 'has-error' : '' !!}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Modelo </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="model" required>
                          <option value="">Selecione um Modelo</option>
                          @foreach($models as $model)
                            <option value="{{$model->id}}">{{$model->name}}</option>
                          @endforeach
                        </select>
                        {!! $errors->first('model', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="form-group {!! $errors->has('active') ? 'has-error' : '' !!}">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nº Ativo </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="active" class="form-control col-md-7 col-xs-12" type="text" name="active">
                        {!! $errors->first('active', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>
                    <div class="form-group {!! $errors->has('serial') ? 'has-error' : '' !!}">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nº Série </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="serial" class="form-control col-md-7 col-xs-12" type="text" name="serial">
                        {!! $errors->first('serial', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="form-group {!! $errors->has('status') ? 'has-error' : '' !!}">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control col-md-7 col-xs-12" name="status" required>
                            <option value="">Selecione um Status</option>
                            @foreach($statuses as $status)
                              <option value="{{$status->id}}">{{$status->name}}</option>
                            @endforeach
                          </select>
                        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="form-group {!! $errors->has('qtty') ? 'has-error' : '' !!}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Quantidade <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" value="1" min="1" id="qtty" name="qtty" required="required" class="form-control col-md-7 col-xs-12">
                          {!! $errors->first('qtty', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href="{{route('equipments')}}" class="btn btn-primary" type="button">Cancelar</a>
                        <button type="submit" class="btn btn-success">Salvar</button>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>


    </div>
    <!-- /page content -->
@endsection
