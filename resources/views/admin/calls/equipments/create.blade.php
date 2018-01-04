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
					<h2>Equipamentos
					</h2>

					<a href="{{route('call', ['id' => $call->id])}}" class="btn btn-success btn-xs pull-right">Finalizar Chamado</a>								
					
					<a href="{{route('equipments_add', ['call' => $call->id])}}" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus"> </i>&nbsp;Adicionar Equipamento</a>

					<div class="clearfix"></div>
				</div>
				<div class="x_content">

					<table id="datatable-buttons" class="table table-striped table-bordered dataTable no-footer dtr-inline">
							<thead>
									<th>*</th>
									<th>Nome</th>
									<th>Marca</th>
									<th>Modelo</th>
									<th>Ativo</th>
									<th>Série</th>
									<th>Entrada</th>
									<th>Status</th>
								</thead>
		
								<tbody>
									@forelse($equipments as $equipment)
									<tr>
										<td>
											<a href="?remove-equipment={{$equipment->id}}" class="btn btn-danger btn-xs btn-default">Remover</a>
										</td>
										<td>{{$equipment->name}}</td>
										<td>{{$equipment->brand->name}}</td>
										<td>{{$equipment->model}}</td>
										<td>{{$equipment->active_code}}</td>
										<td>{{$equipment->serial}}</td>
										<td>{{(new Datetime($equipment->date))->format('d/m/Y')}}</td>
										<td>{{$equipment->status->name}}</td>
		
									</tr>
									@empty
									<tr>
										<td colspan="8">
											<p class="lead">Sem Equipamento</p>
										</td>
									</tr>
									@endforelse
								</tbody>
					</table>

				</div>
			</div>
		</div>

		<div class="modal inmodal" id="add-equipments" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content animated bounceInRight">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">Adicionar Equipamentos</h4>
					</div>
					<div class="modal-body">
						<div class="form-group"><label>Pesquisar</label>
							<input type="email" placeholder="..." class="form-control"></div>


						<div class="row">
							<div class="col-md-12 text-center">
								<br/>
								<h1>Search Dynamic Autocomplete using Bootstrap Typeahead JS</h1>
								<input class="typeahead form-control" style="margin:0px auto;width:300px;" type="text">
							</div>
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
		</div>

	</div>

</div>
<!-- /page content -->
@endsection @push('scripts')
<script type="text/javascript">

	var dataSet = [];

	$('input.typeahead').bootcomplete({
		
        url:'/equipments/ajax/' + $(this).val()
    });
/*
	$('input.typeahead').typeahead({
			hint: true,
			minLength: 2,
			highlight: true,
			source:  function (query, process) {
			return $.get('/equipments/ajax/' + query, { query: query }, function (data) {
					console.log(data);
					dataSet = data = $.parseJSON(data);
					return process(data);
				});
			}
		});
/*
		

</script>
@endpush