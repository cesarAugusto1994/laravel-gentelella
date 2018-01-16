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
                  <h2>Chamados Autorizados
                    </h2>
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
                          <tr data-urlview="{{route('call_confirmation', ['id' => $call->id])}}"
                            @if($call->status == App\Call::STATUS_AUTORIZADO || $call->status == App\Call::STATUS_AGUARDANDO_AUTORIZACAO)
                                data-urlentry="{{route('call_entry', ['id' => $call->id])}}"
                            @endif
                            >
                            <td>{{$call->subject->subject}}</td>
                            <td>{{$call->id}}</td>
                            <td>{{$call->external_code}}</td>
                            <td>{{$call->equipment->name}}</td>
                            <td>{{$call->equipment->warehouse->name}}</td>
                            <td>{{$call->equipment->models->name}}</td>
                            <td>{{$call->equipment->serial}}</td>
                            <td>{{$call->user->name}}</td>
                            <td>{{(new Datetime($call->date))->format('d/m/Y')}}</td>
                            <td>{{$call->status}}</td>
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

@push('scripts')


<script>

    $('#table').on('click-row.bs.table', function (e, value, row, index) {

        const $id = value._data.field;

        const $status = value._data.callstatus;
        const url_view = value._data.urlview;
        const url_entry= value._data.urlentry;

        const selfRow = row;

        $('.modal-body > p').html('');
        $('.modal-body > p').append(value[0]);

        $('#btn-view').attr('href', url_view);

        $('#btn-editable').hide();
        $('#btn-cancel').hide();
        $('#btn-authorize').hide();
        $('#btn-entry').show();

        if((url_entry)) {
            $('#btn-entry').attr('href', url_entry).show();
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
