@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">

        <div class="page-title">
            <div class="title_left">
              <h3>Equipamentos</h3>
            </div>

            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Go!</button>
                  </span>
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
                    @if(Auth::user()->isAdmin())
                      <a href="{{route('equipments_create')}}" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus"> </i>&nbsp;Novo Equipamento</a>
                    @endif
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">


                  <table id="datatable-buttons" class="table table-responsive table-striped table-hover">

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
                                <div class="input-group-btn">
                                  <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                      <li><a href="#">Detalhes</a>
                                      </li>
                                      <li><a href="#">Editar</a>
                                      </li>
                                      <li><a href="#">Logs</a>
                                      </li>
                                      <li class="divider"></li>
                                      <li><a href="#">Inativar</a>
                                      </li>
                                    </ul>
                                </div>
                            </td>
                            <td>{{$equipment->name}}</td>
                            <td>{{$equipment->brand->name}}</td>
                            <td>{{$equipment->model}}</td>
                            <td>{{$equipment->active_code}}</td>
                            <td>{{$equipment->serial}}</td>
                            <td>{{$equipment->date}}</td>
                            <td>{{$equipment->status->name}}</td>

                          </tr>
                      @empty
                          <tr>
                              <td colspan="8"><p class="lead">Sem Equipamento</p></td>
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