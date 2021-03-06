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
                  <h2>Relatorio de {{ $report->name }}</h2>
                    @if(Auth::user()->isAdmin())
                        <a href="{{route('query_create')}}" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus"> </i>&nbsp;Nova Busca</a>
                    @endif
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <div class="row">

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
                          @if (Auth::user()->isAdmin())
                            <th>*</th>
                          @endif
                        <th>Nome</th>
                        <th></th>
                      </thead>

                      <tbody>
                        @foreach($queries as $query)
                            <tr>
                                @if (Auth::user()->isAdmin())
                                  <td>
                                    <a class="btn btn-xs btn-primary" href="{{route('models_edit', ['id' => $query->id])}}"><i class="fa fa-edit"></i> Editar</a>
                                  </td>
                                @endif
                              <td>{{$query->name}}</td>
                              <td><a href="{{ route('query_run', ['id' => $query->id]) }}" class="btn btn-xs btn-success">Executar</a></td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>

                  </div>
              </div>
            </div>
          </div>
    </div>

  </div>
    <!-- /page content -->
@endsection
