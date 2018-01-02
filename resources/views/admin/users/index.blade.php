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


                  <table id="datatable-buttons" class="table table-striped table-bordered dataTable no-footer dtr-inline">

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
                                <div class="input-group-btn">
                                  <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu dropdown-menu-right" role="menu">                                    
                                        <li><a href="{{route('user_edit', ['id' => $user->id])}}">Editar</a></li>
                                    </ul>
                                </div>
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