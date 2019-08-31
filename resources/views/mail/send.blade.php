<!DOCTYPE html>
<html>
<head>
	<title>Restablecimiento de contraseña</title>
	<link rel="stylesheet" href={{ asset('css/app.css')}} />
</head>
<body>
	<div class="container">
		<p>¡Hola! {{ $datos['nombre'] }} {{ $datos['ap_paterno'] }} {{ $datos['ap_materno'] }}.</p>
		<p>Está recibiendo este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta</p>
		<form method="GET" action="{{ route('resetform', ['token' => $datos['token']]) }}">
			{{ csrf_field() }}
		 	<button class="btn btn-primary">Restablecimiento de contraseña</button>
		</form>
		 <br>
		 <p>Si no solicitó restablecer la contraseña, no es necesario realizar ninguna otra acción.</p>
		 <p>¡Saludos!</p>
		 <p>TecNM -  ITTepic</p>
	</div>
</body>
</html>