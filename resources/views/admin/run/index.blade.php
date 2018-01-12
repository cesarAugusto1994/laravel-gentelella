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
                  <h2>Relatorios {{ $query->link }}
                    </h2>
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
                       data-url="{{ $query->link }}"
                       data-show-refresh="true"
                       data-advanced-search="true"
                       data-toolbar="#toolbar"
                >

                <thead>
                    <tr>
                        <th data-field="name" data-sortable="true">Nome</th>
                    </tr>
                </thead>

                </table>


                  </div>

              </div>
            </div>
          </div>
    </div>

  </div>
    <!-- /page content -->
@endsection
