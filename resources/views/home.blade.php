@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">

      <div class="row tile_count">
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"> Equipamentos</span>
            <div class="count">{{ count($equipments) }}</div>
            <span class="count_bottom"></span>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"> Equipamentos Disponiveis</span>
            <div class="count">{{ count($availableEquiments) }}</div>
            <span class="count_bottom"></span>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"> Equipamentos Em Uso</span>
            <div class="count green">{{ count($inUseEquiments) }}</div>
            <span class="count_bottom"></span>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"> Equipamentos em Triagem</span>
            <div class="count">{{ count($screeningEquipments) }}</div>
            <span class="count_bottom"></span>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"> Chamados Solicitados</span>
            <div class="count">{{ count($peddingCalls) }}</div>
            <span class="count_bottom"></span>
          </div>
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"> Chamados Autorizados</span>
            <div class="count">{{ count($authorizedCalls) }}</div>
            <span class="count_bottom"></span>
          </div>
        </div>

        <div class="row">


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Em Uso</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li></li>
                    <li></li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <table class="tile_info">
                    <tbody>
                        @forelse($inUseEquiments as $equipment)
                          <tr>
                              <td>
                                <p><i class="fa fa-square green"></i><a href="{{ route('equipments', $equipment->id ) }}">{{ $equipment->name }}</a></p>
                              </td>
                              <td>{{ $equipment->brand->name }}</td>
                          </tr>

                        @empty

                        <tr>
                            <td>Nenhum Equipamento se encontra em uso.</td>
                        </tr>

                        @endforelse
                  </tbody></table>

                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2>Triagem</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <table class="tile_info">
                    <tbody>
                        @forelse($screeningEquipments as $equipment)
                          <tr>
                              <td>
                                <p><i class="fa fa-square cyan"></i><a href="{{ route('equipments', $equipment->id ) }}">{{ $equipment->name }}</a></p>
                              </td>
                              <td>{{ $equipment->brand->name }}</td>
                          </tr>
                        @empty
                            <tr>
                                <td>Nenhum Equipamento se encontra em triagem.</td>
                            </tr>
                        @endforelse
                  </tbody></table>

                </div>
              </div>
            </div>


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Reservados</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="tile_info">
                    <tbody>
                        @forelse($peddingCalls as $call)
                              <tr>
                                  <td>
                                    <p><i class="fa fa-square blue"></i><a href="{{ route('equipments', $call->equipment->id ) }}">{{ $call->equipment->name }}</a></p>
                                  </td>
                                  <td><a href="{{ route('call', $call->id ) }}">n. {{ $call->id }}</a></td>
                              </tr>
                          @empty
                              <tr>
                                  <td>Nenhum Equipamento se encontra reservado.</td>
                              </tr>
                          @endforelse
                  </tbody></table>
                </div>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Atividades Recentes</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">

                    <ul class="list-unstyled timeline widget">
                      @forelse($logs as $log)
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                              <a>{{ $log->message }}</a></h2>
                            <div class="byline">
                              <span>{{ App\Helpers\TimesAgo::render($log->created_at) }}</span> por <a>{{ $log->user->name }}</a>
                            </div>
                          </div>
                        </div>
                      </li>
                      @empty
                          <li>Nenhum Log foi registrado até o momento.</li>
                      @endforelse
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
    <!-- /page content -->
@endsection
