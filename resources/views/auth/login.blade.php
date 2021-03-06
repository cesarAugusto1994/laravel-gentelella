<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Controle Ativos! | Login</title>

    <!-- Bootstrap -->
    <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset("css/font-awesome.min.css") }}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset("css/gentelella.min.css") }}" rel="stylesheet">

</head>

<body class="login">
<div>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
				{!! BootForm::open(['url' => url('/login'), 'method' => 'post']) !!}

				<h1>Login</h1>

        @foreach ($errors->all() as $error)

        <div class="alert alert-danger">{{ $error }}</div>

        @endforeach

				{!! BootForm::email('email', 'E-mail', old('email'), ['placeholder' => 'E-mail', 'afterInput' => '<span>test</span>'] ) !!}

				{!! BootForm::password('password', 'Senha', ['placeholder' => 'Senha']) !!}

				<div>
					{!! BootForm::submit('Entrar', ['class' => 'btn btn-default submit col-md-9']) !!}
					<!--<a class="reset_pass" href="{{  url('/password/reset') }}">Esqueceu sua senha?</a>-->
				</div>

				<div class="clearfix"></div>

				<div class="separator">

					<!--<p class="change_link">New to site?
						<a href="{{ url('/register') }}" class="to_register"> Create Account </a>
					</p>-->

					<div class="clearfix"></div>
					<br />

					<div>
						<h1><i class="fa fa-cogs"></i> Controle de Ativos!</h1>
						<p>©2018 Todos direitos reservados. </p>
					</div>
				</div>
				{!! BootForm::close() !!}
            </section>
        </div>
    </div>
</div>
</body>
</html>
