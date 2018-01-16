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
                  <h2>Equipamentos
                    </h2>
                    @if(Auth::user()->isAdmin())
                      <a href="{{route('equipments_create')}}" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus"> </i>&nbsp;Novo Equipamento</a>
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
                      <th>Nome</th>
                      <th>Estoque</th>
                      <th>Modelo</th>
                      <th>Ativo</th>
                      <th>Série</th>
                      <th>Entrada</th>
                      <th>Status</th>
                    </thead>

                    <tbody>
                      @forelse($equipments as $equipment)
                          <tr data-urledit="{{route('equipment_edit', ['id' => $equipment->id])}}"
                            @if($equipment->status->id == App\Equipment::STATUS_DISPONIVEL)
                                data-urldescart="{{route('equipment_descart', ['id' => $equipment->id])}}"
                            @endif
                            >
                            <td>{{$equipment->name}}</td>
                            <td>{{$equipment->warehouse->name}}</td>
                            <td>{{$equipment->models->name}}</td>
                            <td>{{$equipment->active_code}}</td>
                            <td>{{$equipment->serial}}</td>
                            <td>{{(new DateTime($equipment->date))->format('d/m/Y')}}</td>
                            <td>{{$equipment->status->name}}</td>
                          </tr>
                      @empty
                          <tr>
                              <p>Nenhum Equipamento foi adicionado</p>
                            </tr>
                      @endforelse
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
        const url_edit = value._data.urledit;
        const url_remove = value._data.urlremove;
        const url_descart = value._data.urldescart;

        const selfRow = row;

        $('.modal-body > p').html('');
        $('.modal-body > p').append(value[0]);

        $('#btn-edit').attr('href', url_edit);

        $('#btn-remove').hide();
        $('#btn-descart').hide();

        @if (Auth::user()->isAdmin())
            $('.modal-options').modal('show');
        @endif

        if(url_descart) {
            $('#btn-descart').attr('href', url_descart).show();
        }

        $('#btn-remove').click(function(e) {

            swal({
                title: 'Deseja realmente Inativar?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim'
                }).then((result) => {
                if (result.value) {

                  $.post(url_remove, { id: $id, _token : "{{ csrf_token() }}" }).then((data) => {

                    if (data.code > 0) {
                      label = data.code == 200 ? 'Sucesso' : 'Erro';

                      swal(
                        label,
                        data.message,
                        data.class
                      )
                    }

                  })

                  selfRow.hide();

                }
            })

        });

        $('#btn-descart').click(function(e) {

            swal({
                title: 'Deseja realmente  este Equipamento?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim'
                }).then((result) => {
                if (result.value) {

                    window.location.href = url_descart;

                }
            })

        });
    });

</script>

@endpush
