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
                    @if(Auth::user()->isAdmin())
                      <a href="{{route('report_create')}}" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus"> </i>&nbsp;Novo Relatório</a>
                    @endif
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <div class="row">
                    @foreach($reports as $report)
                        <a href="{{ route('report', ['id' => $report->id]) }}">
                            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="tile-stats">
                                  <div class="icon"><i class="fa fa-box"></i>
                                  </div>
                                  <div class="count text-center">{{ $report->name }}</div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

              </div>
            </div>
          </div>
    </div>

  </div>
    <!-- /page content -->
@endsection
