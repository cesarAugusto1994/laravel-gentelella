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
                      <th>*</th>
                      <th>Nome</th>
                      <th>E-mail</th>
                      <th>Acesso</th>
                    </thead>

                    <tbody>
                      @foreach($users as $user)
                          <tr>
                            <td>
                              <a class="btn btn-xs btn-primary" href="{{route('user_edit', ['id' => $user->id])}}"><i class="fa fa-edit"></i> Editar</a>
                            </td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->roles->first()['description']}}</td>
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

        $(document).ready(function(){
          $('#datatable-buttons').DataTable();
      });

    </script>
@endpush
