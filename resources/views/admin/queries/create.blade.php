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
                  <h2>Nova Busca </h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br>
                  <form method="POST" action="{{route('query_store')}}" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                    {{csrf_field()}}
                    <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nome
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="name" name="name" value="{{old('name')}}" required="required" class="form-control col-md-7 col-xs-12">
                        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="form-group {!! $errors->has('link') ? 'has-error' : '' !!}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Endereço API
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="link" name="link" value="{{old('link')}}" required="required" class="form-control col-md-7 col-xs-12">
                        {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="form-group {!! $errors->has('report') ? 'has-error' : '' !!}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Relatório </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="report" required>
                          <option value="">Selecione um Relatório</option>
                          @foreach($reports as $report)
                            <option value="{{$report->id}}">{{$report->name}}</option>
                          @endforeach
                        </select>
                        {!! $errors->first('report', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href="{{route('reports')}}" class="btn btn-primary" type="button">Cancelar</a>
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
