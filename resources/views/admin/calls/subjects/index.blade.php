@extends('layouts.blank') @push('stylesheets')
<!-- Example -->
<!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush @section('main_container')

<!-- page content -->
<div class="right_col" role="main">

	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Assuntos Chamados
					</h2>

					<a href="{{route('subjects_create')}}" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus"> </i>&nbsp;Novo Assunto Chamado</a>

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
						</thead>

						<tbody>
							@foreach($subjects as $subject)
							<tr>
								<td>{{$subject->subject}}</td>
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
@endsection @push('scripts')

<script>
	$(document).ready(function(){
          $('#datatable-buttons').DataTable();
      });

</script>
@endpush
