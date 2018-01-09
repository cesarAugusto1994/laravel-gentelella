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
                  <h2> Chamado nº {{$call->id}}</h2>
                  <form action="{{route('call_finish', ['id' => $call->id])}}" method="post">
                    {{csrf_field()}}
                  <button type="submit" class="btn btn-success btn-xs pull-right"><i class="fa fa-save"> </i>&nbsp;Finalizar Chamado</a>
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
                  <h2>Equipamento
                  </h2>

                  <a href="{{route('call_equipments_create', ['call' => $call->id])}}" class="btn btn-primary btn-xs pull-right"><i class="fa fa-edit"> </i>&nbsp;Editar Chamado</a>

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
                          @if($call->equipment)
                          <tr>
                            <td>{{$call->equipment->name}}</td>
                            <td>{{$call->equipment->brand->name}}</td>
                            <td>{{$call->equipment->models->name}}</td>
                            <td>{{$call->equipment->active_code}}</td>
                            <td>{{$call->equipment->serial}}</td>
                            <td>{{(new Datetime($call->equipment->date))->format('d/m/Y')}}</td>
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
