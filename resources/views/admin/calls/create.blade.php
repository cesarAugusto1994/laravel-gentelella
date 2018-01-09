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
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group {!! $errors->has('subject') ? 'has-error' : '' !!}">
                      <label for="subject" class="control-label col-md-3 col-sm-3 col-xs-12">Assunto </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control col-md-7 col-xs-12" name="subject" required>
                            @foreach($subjects as $subject)
                              <option value="{{$subject->id}}">{{$subject->subject}}</option>
                            @endforeach
                          </select>
                        {!! $errors->first('subject', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="form-group {!! $errors->has('external_code') ? 'has-error' : '' !!}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Chamado </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="external_code" required class="form-control col-md-7 col-xs-12" type="text" name="external_code">
                        {!! $errors->first('external_code', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="form-group {!! $errors->has('approval_date') ? 'has-error' : '' !!}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Para o dia </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="approval_date" required class="form-control col-md-7 col-xs-12 datepicker" type="text" name="approval_date">
                        {!! $errors->first('approval_date', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="form-group  {!! $errors->has('user') ? 'has-error' : '' !!}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Solicitante </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        @if(!Auth::user()->isAdmin())
                        <input readonly disabled value="{{Auth::user()->name}}" name="user" class="form-control col-md-7 col-xs-12" type="text">
                        @else
                          <select class="form-control col-md-7 col-xs-12" name="user">
                              @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == Auth::user()->id ? 'selected' : '' }} >{{ $user->name }}</option>
                              @endforeach
                          </select>
                        @endif
                        {!! $errors->first('user', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="form-group  {!! $errors->has('description') ? 'has-error' : '' !!}">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Informe o motivo da Solicitação </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea name="description" required class="form-control col-md-7 col-xs-12"></textarea>
                        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>  Adicionar Equipamentos</button>
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
