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
                  <h2>Relatório de Estoque Agrupado por ({{ $group }})
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
                      <th>Marca</th>
                      <th>Modelo</th>
                      <th>Ativo</th>
                      <th>Série</th>
                      <th>Entrada</th>
                      <th>Status</th>
                    </thead>

                    <tbody>
                      @forelse($equipments as $equipment)
                          <tr>
                            <td>{{$equipment->name}}</td>
                            <td>{{$equipment->brand->name}}</td>
                            <td>{{$equipment->models->name}}</td>
                            <td>{{$equipment->active_code}}</td>
                            <td>{{$equipment->serial}}</td>
                            <td>{{(new DateTime($equipment->date))->format('d/m/Y')}}</td>
                            <td>{{$equipment->status->name}}</td>

                          </tr>
                      @empty
                          <tr>
                              <p>Nenhum Equipamento foi adicionado</p>
                            </tr>
                      @endforelse
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
