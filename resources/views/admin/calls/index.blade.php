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


                  <table id="table"
                      class="table table-bordered table-responsive table-hover"
                      data-toggle="table"
                      data-striped="true"
                      data-search="true"
                      data-show-toggle="true"
                      data-show-columns="true"
                      data-pagination="true"
                      data-single-select="true"
                      data-maintain-selected="true"
                      data-show-pagination-switch="true"
                      data-sortable="true"
                      data-show-export="true"
                      data-click-to-select="true"
                      data-flat="true"
                      data-show-refresh="true"
                      data-advanced-search="true"
                      data-toolbar="#toolbar"
               >

                    <thead>
                      <th></th>
                      <th>Assunto</th>
                      <th>Chamado Int.</th>
                      <th>Chamado Ext.</th>
                      <th>Equipamento</th>
                      <th>Marca</th>
                      <th>Modelo</th>
                      <th>N. Série</th>
                      <th>Usuário</th>
                      <th>Data</th>
                      <th>Situação</th>
                    </thead>

                    <tbody>
                      @foreach($calls as $call)

                          @if($call->user->id == Auth::user()->id || Auth::user()->isAdmin())
                          <tr>
                              <td>
                                <div class="btn-group  btn-group-sm">
                                  <a class="btn btn-xs btn-default" href="{{route('call_confirmation', ['id' => $call->id])}}">Visualizar</a>
                                  @if($call->status == 'ABERTO' || $call->status == 'AGUARDANDO AUTORIZACAO')
                                      <a class="btn btn-xs btn-default" class="btn btn-default" href="{{route('call_equipments_create', ['call' => $call->id])}}">Editar</a>
                                  @endif
                                  @if($call->status == 'AGUARDANDO AUTORIZACAO' && Auth::user()->isAdmin())
                                      @if(!empty($call->equipment))
                                          <a class="btn btn-xs btn-success" href="{{route('call_confirmation', ['id' => $call->id])}}">Autorizar</a>
                                      @else
                                          <button class="btn btn-success source" onclick="new PNotify({
                                              title: 'Notificação',
                                              text: 'Deve adicionar um equipamento para autorizar o chamado.',
                                              styling: 'brighttheme'
                                          });">Autorizar</button>
                                      @endif
                                  @endif
                                  @if(($call->status == 'ABERTO' || $call->status == 'AGUARDANDO AUTORIZACAO') && !empty($call->equipment))
                                      <a class="btn btn-xs btn-danger" href="{{route('call_cancel', ['id' => $call->id])}}">Cancelar</a>
                                  @endif
                                </div>
                              </td>
                            <td>{{$call->subject->subject}}</td>
                            <td>{{$call->id}}</td>
                            <td>{{$call->external_code}}</td>
                            <td>{{ $call->equipment ? $call->equipment->name : ""}}</td>
                            <td>{{ $call->equipment ? $call->equipment->brand->name : ""}}</td>
                            <td>{{ $call->equipment ? $call->equipment->models->name : ""}}</td>
                            <td>{{ $call->equipment ? $call->equipment->serial : ""}}</td>
                            <td>{{$call->user->name}}</td>
                            <td>{{(new Datetime($call->date))->format('d/m/Y')}}</td>
                            <td>{{$call->status}}</td>
                          </tr>
                          @endif
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
