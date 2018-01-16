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
                  <h2>Chamados
                    </h2>

                      <a href="{{route('calls_create')}}" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus"> </i>&nbsp;Novo Chamado</a>

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
                      <th>Assunto</th>
                      <th>Chamado Int.</th>
                      <th>Chamado Ext.</th>
                      <th>Equipamento</th>
                      <th>Estoque</th>
                      <th>Modelo</th>
                      <th>N. Série</th>
                      <th>Usuário</th>
                      <th>Data</th>
                      <th>Situação</th>
                    </thead>

                    <tbody>
                      @foreach($calls as $call)

                          @if($call->user->id == Auth::user()->id || Auth::user()->isAdmin())
                          <tr
                            data-urlview="{{route('call_confirmation', ['id' => $call->id])}}"
                            @if(($call->status == App\Call::STATUS_ABERTO || $call->status == App\Call::STATUS_AGUARDANDO_AUTORIZACAO))
                                data-urledit="{{route('call_equipments_create', ['call' => $call->id])}}"
                            @endif
                            @if($call->status == App\Call::STATUS_AGUARDANDO_AUTORIZACAO && Auth::user()->isAdmin() && !empty($call->equipment))
                                data-urlauthorize="{{route('call_confirmation', ['id' => $call->id])}}"
                            @endif
                            @if(($call->status == App\Call::STATUS_ABERTO || $call->status == App\Call::STATUS_AGUARDANDO_AUTORIZACAO) && !empty($call->equipment))
                                data-urlcancel="{{route('call_cancel', ['id' => $call->id])}}"
                            @endif

                            class="@if($call->status == App\Call::STATUS_AGUARDANDO_AUTORIZACAO)
                              warning
                            @elseif($call->status == App\Call::STATUS_AUTORIZADO)
                              success
                            @elseif($call->status == App\Call::STATUS_CANCELADO)
                              danger
                            @endif"
                            >
                            <td>{{$call->subject->subject}}</td>
                            <td>{{$call->id}}</td>
                            <td>{{$call->external_code}}</td>
                            <td>{{ $call->equipment ? $call->equipment->name : ""}}</td>
                            <td>{{ $call->equipment ? $call->equipment->warehouse->name : ""}}</td>
                            <td>{{ $call->equipment ? $call->equipment->models->name : ""}}</td>
                            <td>{{ $call->equipment ? $call->equipment->serial : ""}}</td>
                            <td>{{$call->user->name}}</td>
                            <td>{{(new Datetime($call->date))->format('d/m/Y')}}</td>
                            <td>{{$call->status}}</td>
                          </tr>
                          @endif
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

@push('scripts')

<script>

    $('#table').on('click-row.bs.table', function (e, value, row, index) {

        const $id = value._data.field;

        const $status = value._data.callstatus;
        const url_view = value._data.urlview;
        const url_edit = value._data.urledit;
        const url_cancel = value._data.urlcancel;
        const url_authorize = value._data.urlauthorize;

        const selfRow = row;

        $('.modal-body > p').html('');
        $('.modal-body > p').append(value[0]);

        $('#btn-view').attr('href', url_view);

        $('#btn-editable').hide();
        $('#btn-cancel').hide();
        $('#btn-authorize').hide();
        $('#btn-entry').hide();

        if((url_edit)) {
            $('#btn-editable').attr('href', url_edit).show();
        }

        if(url_authorize) {
            $('#btn-authorize').attr('href', url_authorize).show();
        }

        if(url_cancel) {
            $('#btn-cancel').attr('href', url_cancel).show();
        }

        @if (Auth::user()->isAdmin())
            $('.modal-options-call').modal('show');
        @endif

        $('#btn-cancel').click(function(e) {

            swal({
                title: 'Deseja realmente Cancelar?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim'
                }).then((result) => {
                if (result.value) {

                  window.location.href = url_cancel;

                  selfRow.hide();

                }
            })

        });

    });

</script>
@endpush
