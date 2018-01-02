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
                  <h2>Novo Chamado </h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br>
                  <form method="post" action="{{route('calls_store')}}" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                      {{csrf_field()}}

                    <div class="form-group {!! $errors->has('subject') ? 'has-error' : '' !!}">
                      <label for="subject" class="control-label col-md-3 col-sm-3 col-xs-12">Assunto </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control col-md-7 col-xs-12" name="subject" required>
                            <option value="">Selecione um Assunto</option>
                            @foreach($subjects as $subject)
                              <option value="{{$subject->id}}">{{$subject->subject}}</option>
                            @endforeach
                          </select>
                        {!! $errors->first('subject', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="form-group {!! $errors->has('date') ? 'has-error' : '' !!}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Para o dia </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="date" class="form-control col-md-7 col-xs-12" type="text" name="date">
                        {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Solicitante </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input readonly disabled value="{{Auth::user()->name}}" class="form-control col-md-7 col-xs-12" type="text">
                      </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button class="btn btn-primary" type="button">Cancelar</button>
                        <button type="submit" class="btn btn-success">Adicionar Equipamentos</button>
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