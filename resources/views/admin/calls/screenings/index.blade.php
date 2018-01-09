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
                  <h2>Triagem
                    </h2>

                      <div class="clearfix"></div>
                </div>
                <div class="x_content">

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
                          <th>*</th>
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
                            <td>
                              <form action="{{route('equipment_back_to_stock', ['id' => $equipment->id])}}" method="post">
                                {{csrf_field()}}
                              <button type="submit" class="btn btn-success btn-xs">Retornar as Estoque</button>
                              </form>
                            </td>
                            <td>{{$equipment->name}}</td>
                            <td>{{$equipment->brand->name}}</td>
                            <td>{{$equipment->model}}</td>
                            <td>{{$equipment->active_code}}</td>
                            <td>{{$equipment->serial}}</td>
                            <td>{{(new DateTime($equipment->date))->format('d/m/Y')}}</td>
                            <td>{{$equipment->status->name}}</td>

                          </tr>
                          @empty
                          <tr>
                            <td colspan="8">
                              <p>Nenhum Equipamento foi adicionado</p>
                            </td>
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
