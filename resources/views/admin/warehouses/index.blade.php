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
                  <h2>Estoques
                    </h2>
                    @if(Auth::user()->isAdmin())
                      <a href="{{route('warehouses_create')}}" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus"> </i>&nbsp;Novo Estoque</a>
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
                      <th>Cidade</th>
                      <th>Estado</th>
                    </thead>

                    <tbody>
                      @foreach($warehouses as $warehouse)
                          <tr data-field="{{$warehouse->id}}">
                            <td>{{$warehouse->name}}</td>
                            <td>{{$warehouse->city}}</td>
                            <td>{{$warehouse->state}}</td>
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

      //var $id = 0;

      $('#table').on('click-row.bs.table', function (e, value, row, index) {
          var $id = value._data.field;

          const selfRow = row;

          $('#btn-edit').attr('href', '/admin/warehouse/' + $id +'/edit');

          @if (Auth::user()->isAdmin())
              $('.modal-options').modal('show');
          @endif

          $('#btn-remove').click(function(e) {

              const urlAPIRemoveWarehouse = '/admin/warehouse/' + $id +'/remove';

              swal({
                  title: 'Deseja realmente Inativar?',
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Sim'
                  }).then((result) => {
                  if (result.value) {

                    $.post(urlAPIRemoveWarehouse, { id: $id, _token : "{{ csrf_token() }}" }).then((data) => {

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

      });



  </script>

@endpush
