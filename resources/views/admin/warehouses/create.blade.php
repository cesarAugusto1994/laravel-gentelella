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
                  <h2>Novo Estoque </h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br>
                  <form method="POST" action="{{route('warehouses_store')}}" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                    {{csrf_field()}}
                    <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nome
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="name" name="name" value="{{old('name')}}" required="required" class="form-control col-md-7 col-xs-12">
                        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="form-group {!! $errors->has('city') ? 'has-error' : '' !!}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Cidade
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="city" name="city" value="{{old('city')}}" required="required" class="form-control col-md-7 col-xs-12">
                        {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="form-group {!! $errors->has('state') ? 'has-error' : '' !!}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Estado
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="state" name="state" value="{{old('name')}}" required="required" class="form-control col-md-7 col-xs-12">
                        {!! $errors->first('state', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href="{{route('warehouses')}}" class="btn btn-primary" type="button">Cancelar</a>
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
