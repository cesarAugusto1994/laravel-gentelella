@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">

        <div class="page-title">
            <div class="title_left">
              <h3>Status</h3>
            </div>

            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Go!</button>
                  </span>
                </div>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Status 
                    </h2>
                    @if(Auth::user()->isAdmin())
                      <a href="{{route('status_create')}}" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus"> </i>&nbsp;Novo Status</a>
                    @endif
                      <div class="clearfix"></div>
                </div>
                <div class="x_content">


                  <table id="datatable-buttons" class="table table-striped table-bordered dataTable no-footer dtr-inline">

                    <thead>
                      <th>Nome</th>
                    </thead>

                    <tbody>
                      @foreach($statuses as $status)
                          <tr>
                            <td>{{$status->name}}</td>
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