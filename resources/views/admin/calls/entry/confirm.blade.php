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
                  <h2>Devolução de Equipamento
                    </h2>
                      <form action="{{route('call_entry_screening', ['id' => $call->id])}}" method="post">
                          {{csrf_field()}}
                          <button type="submit" class="btn btn-success btn-xs pull-right"><i class="fa fa-check"> </i>&nbsp;Iniciar Triagem do Equipamento</a>
                      </form>
                      <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <p>
                      Para o dia {{ (new DateTime($call->date))->format('d/m/Y') }}
                  </p>
                  <p>
                      Solicirado por: {{ $call->user->name }}
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Equipamentos
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
                          <th>Nome</th>
                          <th>Estoque</th>
                          <th>Modelo</th>
                          <th>Ativo</th>
                          <th>Série</th>
                          <th>Entrada</th>
                          <th>Status</th>
                        </thead>

                        <tbody>
                          @if($call->equipment)
                          <tr>
                            <td>{{$call->equipment->name}}</td>
                            <td>{{$call->equipment->warehouse->name}}</td>
                            <td>{{$call->equipment->model_id}}</td>
                            <td>{{$call->equipment->active_code}}</td>
                            <td>{{$call->equipment->serial}}</td>
                            <td>{{(new DateTime($call->equipment->date))->format('d/m/Y')}}</td>
                            <td>{{$call->equipment->status->name}}</td>

                          </tr>
                          @else
                          <tr>
                            <td colspan="8">
                              <p>Nenhum Equipamento foi adicionado</p>
                            </td>
                          </tr>
                          @endif
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
