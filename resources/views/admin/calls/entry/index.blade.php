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
                  <h2>Chamados Autorizados
                    </h2>
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
                      <th></th>
                    </thead>

                    <tbody>
                      @foreach($calls as $call)
                          <tr>
                            <td>{{$call->subject->subject}}</td>
                            <td>{{$call->id}}</td>
                            <td>{{$call->external_code}}</td>
                            <td>{{$call->equipment->name}}</td>
                            <td>{{$call->equipment->brand->name}}</td>
                            <td>{{$call->equipment->models->name}}</td>
                            <td>{{$call->equipment->serial}}</td>
                            <td>{{$call->user->name}}</td>
                            <td>{{(new Datetime($call->date))->format('d/m/Y')}}</td>
                            <td>{{$call->status}}</td>
                            <td>
                                  <a class="btn btn-xs btn-default" href="{{route('call_confirmation', ['id' => $call->id])}}">Visualizar</a>
                                  @if($call->status == App\Call::STATUS_AUTORIZADO || $call->status == App\Call::STATUS_AGUARDANDO_AUTORIZACAO)
                                      <a class="btn btn-xs btn-success" href="{{route('call_entry', ['id' => $call->id])}}">Iniciar Entrada</a>
                                  @endif
                            </td>
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
