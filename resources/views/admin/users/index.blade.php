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
                  <h2>Usuarios
                    </h2>
                      @if(Auth::user()->isAdmin())
                        <a href="{{route('users_create')}}" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus"> </i>&nbsp;Novo Usuario</a>
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
                      <th>E-mail</th>
                      <th>Acesso</th>
                      <th>Status</th>
                    </thead>

                    <tbody>
                      @foreach($users as $user)
                          <tr data-field="{{ $user->id }}"
                            data-urledit="{{route('user_edit', ['id' => $user->id]) }}"
                            data-urlremove="{{route('user_remove', ['id' => $user->id]) }}"
                            class="{{!$user->active ? 'danger' : ''}}">
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->roles->first()['description']}}</td>
                            <td>{{$user->active ? 'Ativo' : 'Inativo'}}</td>
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
        const url_edit = value._data.urledit;
        const url_remove = value._data.urlremove;

        const selfRow = row;

        $('.modal-body > p').html('');
        $('.modal-body > p').append(value[0]);

        $('#btn-edit').attr('href', url_edit);

        @if (Auth::user()->isAdmin())
            $('.modal-options').modal('show');
        @endif

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

    });

</script>

@endpush
