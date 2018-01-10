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
                  <h2>Relatorios
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <div class="row">
                    <a href="#">
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-box"></i>
                          </div>
                          <div class="count text-center">Estoque</div>
                        </div>
                      </div>
                    </a>
                </div>

              </div>
            </div>
          </div>
    </div>

  </div>
    <!-- /page content -->
@endsection
