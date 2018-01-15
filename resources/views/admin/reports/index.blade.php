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
                  <h2>Relatorios de Equipamentos
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <div class="row">
                        
                    @foreach($statuses as $status)
                    <a href="{{ route('report_equipmennts_from_status', ['id' => $status->id]) }}">
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                              <div class="icon"><i class="fa fa-box"></i>
                              </div>
                              <div class="count text-center">{{ $status->name }} <span class="tag">{{ count($status->equipments) }}</span></div>
                            </div>
                        </div>
                    </a>
                    @endforeach

                </div>

              </div>
            </div>
          </div>


          <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Relatorios de Estoque
                      </h2>
                      <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
  
                    <div class="row">
                          
                      <a href="{{ route('report_equipmennts_grouping', ['group' => 'brand_id']) }}">
                          <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                              <div class="tile-stats">
                                <div class="icon"><i class="fa fa-box"></i>
                                </div>
                                <div class="count text-center">Por Marca </div>
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
