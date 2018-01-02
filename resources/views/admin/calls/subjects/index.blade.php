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
					<table id="datatable-buttons" class="table table-striped table-bordered dataTable no-footer dtr-inline">
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