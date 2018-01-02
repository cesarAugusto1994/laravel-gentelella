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
					<h2>Novo Assunto </h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<br>
					<form method="post" action="{{route('subjects_store')}}" data-parsley-validate="" class="form-horizontal form-label-left"
					 novalidate="">
						{{csrf_field()}}
						<div class="form-group {!! $errors->has('subject') ? 'has-error' : '' !!}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Titulo
                      </label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="subject" autofocus value="{{old('subject')}}" name="subject" required="required" class="form-control col-md-7 col-xs-12">								{!! $errors->first('subject', '
								<p class="help-block">:message</p>') !!}
							</div>
						</div>

						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<a href="{{route('subjects')}}" class="btn btn-primary" type="button">Cancelar</a>
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