@extends('layouts.blank') @push('stylesheets')
<!-- Example -->
<!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush @section('main_container')

<!-- page content -->
<div class="right_col" role="main">

	<div class="page-title">
		<div class="title_left">
			<h3>Assuntos</h3>
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
					<h2>Novo Assunto </h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<br>
					<form method="post" action="{{route('subjects_store')}}" data-parsley-validate="" class="form-horizontal form-label-left"
					 novalidate="">
						{{csrf_field()}}
						<div class="form-group {!! $errors->has('subject') ? 'has-error' : '' !!}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Titulo <span class="required">*</span>
                      </label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="subject" autofocus value="{{old('subject')}}" name="subject" required="required" class="form-control col-md-7 col-xs-12">								{!! $errors->first('subject', '
								<p class="help-block">:message</p>') !!}
							</div>
						</div>

						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<button class="btn btn-primary" type="button">Cancelar</button>
								<button type="submit" class="btn btn-success">Salvar</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>


</div>
<!-- /page content -->
@endsection