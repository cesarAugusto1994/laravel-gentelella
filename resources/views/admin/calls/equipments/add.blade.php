@extends('layouts.blank') @push('stylesheets')
<!-- Example -->
<!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush @section('main_container')

<!-- page content -->
<div class="right_col" role="main">

	<div class="page-title">
		<div class="title_left">
			<h3>Chamados</h3>
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
					<h2>Chamados - Adicionar Equipamentos </h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<br>
					<form method="get" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
						<div class="form-group {!! $errors->has('filter') ? 'has-error' : '' !!}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Filtro
                      </label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="filter" autofocus value="{{old('subject')}}" name="filter" required="required" class="form-control col-md-7 col-xs-12">								{!! $errors->first('subject', '
								<p class="help-block">:message</p>') !!}
							</div>
						</div>

						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<button type="submit" class="btn btn-success">Pesquisar</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Equipamentos
					</h2>

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
									<a href="?filter={{$filter}}&add-equipment={{$equipment->id}}" class="btn btn-success btn-xs btn-default">Adicionar</a>
								</td>
								<td>{{$equipment->name}}</td>
								<td>{{$equipment->brand->name}}</td>
								<td>{{$equipment->model}}</td>
								<td>{{$equipment->active_code}}</td>
								<td>{{$equipment->serial}}</td>
								<td>{{$equipment->date}}</td>
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

	</div>

</div>
<!-- /page content -->
@endsection @push('scripts') @endpush