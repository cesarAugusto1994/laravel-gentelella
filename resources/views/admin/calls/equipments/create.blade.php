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

					@if($call->equipment)
						<a href="{{route('call', ['id' => $call->id])}}" class="btn btn-success btn-xs pull-right">Finalizar Chamado</a>
					@endif

					@if(!$call->equipment)
							<a href="{{route('equipments_add', ['call' => $call->id])}}" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus"> </i>&nbsp;Adicionar Equipamento</a>
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
							data-sortable="true"
			 >
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
									@if($call->equipment)
									<tr>
										<td>
											<a href="?remove-equipment={{$call->equipment->id}}" class="btn btn-danger btn-xs btn-default">Remover</a>
										</td>
										<td>{{$call->equipment->name}}</td>
										<td>{{$call->equipment->warehouse->name}}</td>
										<td>{{$call->equipment->models->name}}</td>
										<td>{{$call->equipment->active_code}}</td>
										<td>{{$call->equipment->serial}}</td>
										<td>{{(new Datetime($call->equipment->date))->format('d/m/Y')}}</td>
										<td>{{$call->equipment->status->name}}</td>

									</tr>
									@else
									<tr>
										<td colspan="8">
											<p>Nenhum Equipamento foi adicionado</p>
										</td>
									</tr>
									@endif
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
