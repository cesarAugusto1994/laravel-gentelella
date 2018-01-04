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
                  <h2>Chamados 
                    </h2>
                    
                      <a href="{{route('calls_create')}}" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus"> </i>&nbsp;Novo Chamado</a>
                    
                      <div class="clearfix"></div>
                </div>
                <div class="x_content">


                  <table id="datatable-buttons" class="table table-striped table-bordered dataTable no-footer dtr-inline">

                    <thead>
                      <th></th>
                      <th>Assunto</th>
                      <th>Usuário</th>
                      <th>Data</th>
                      <th>Situação</th>
                    </thead>

                    <tbody>
                      @foreach($calls as $call)
                          <tr>
                              <td>
                                  <div class="input-group-btn">
                                   
                                    <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span>
                                    </button>
                                    
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="{{route('call_confirmation', ['id' => $call->id])}}">Visualizar</a>
                                        @if($call->status == 'ABERTO' || $call->status == 'AGUARDANDO AUTORIZACAO')
                                        <li><a href="{{route('call_equipments_create', ['call' => $call->id])}}">Editar</a>
                                        </li>
                                        @endif
                                        @if($call->status == 'AGUARDANDO AUTORIZACAO' && Auth::user()->isAdmin())
                                        <li><a href="{{route('call_confirmation', ['id' => $call->id])}}">Autorizar</a>
                                        </li>
                                        @endif
                                        @if($call->status == 'ABERTO' || $call->status == 'AGUARDANDO AUTORIZACAO')
                                        <li><a href="{{route('call_cancel', ['id' => $call->id])}}">Cancelar</a>
                                        </li>
                                        @endif
                                      </ul>
                                  </div>
                              </td>
                            <td>{{$call->subject->subject}}</td>
                            <td>{{$call->user->name}}</td>
                            <td>{{(new Datetime($call->date))->format('d/m/Y')}}</td>
                            <td>{{$call->status}}</td>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>
              </div>
            </div>
          </div>


    </div>
    <!-- /page content -->
@endsection

@push('scripts')

    <script>

        $(document).ready(function(){
          $('#datatable-buttons').DataTable();
      });

    </script>
@endpush