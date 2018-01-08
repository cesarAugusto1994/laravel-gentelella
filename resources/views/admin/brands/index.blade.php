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
                  <h2>Marcas
                    </h2>
                    @if(Auth::user()->isAdmin())
                      <a href="{{route('brands_create')}}" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus"> </i>&nbsp;Nova Marca</a>
                    @endif
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
                        @if (Auth::user()->isAdmin())
                          <th>*</th>
                        @endif
                      <th>Nome</th>
                    </thead>

                    <tbody>
                      @foreach($brands as $brand)
                          <tr>
                              @if (Auth::user()->isAdmin())
                                <td>
                                    <div class="input-group-btn">
                                      <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span>
                                      </button>
                                      <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                            <li><a href="{{route('brands_edit', ['id' => $brand->id])}}">Editar</a></li>
                                        </ul>
                                    </div>
                                </td>
                              @endif
                            <td>{{$brand->name}}</td>
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
