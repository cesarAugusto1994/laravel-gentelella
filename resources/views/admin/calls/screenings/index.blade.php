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
        
                  <table id="datatable-buttons" class="table table-striped table-bordered dataTable no-footer dtr-inline">
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
                            <td>
                          
                                <div class="input-group-btn">
                                  <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li>
                                          <form action="{{route('equipment_back_to_stock', ['id' => $equipment->id])}}" method="post">
                                            {{csrf_field()}}
                                          <button type="submit" class="btn btn-link">Retornar Ao Estoque</button>                  
                                          </form>
                                          </li>
                                    </ul>
                                </div>
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
                              <p class="lead">Sem Equipamento</p>
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