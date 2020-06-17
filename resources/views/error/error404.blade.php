<!DOCTYPE html>
<html>
<head>
	<title>No existe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	@if ($_SERVER['SERVER_NAME'] == "localhost")
		<link rel="stylesheet" href="{{url('/estilo/bootstrap4/bootstrap.min.css')}}">
	@else
		<link rel="stylesheet" href="https://comparadordeventas.com/pagolibre/public/estilo/bootstrap4/bootstrap.min.css">
	@endif
</head>
<body>
	<br>
	<div class="container panel panel-default">
		<div class="card">
			<div class="card-header">
				<h3>Ups... Lamentamos informarte</h3>
			</div>
			<div class="card-body">

				<strong style="color:green">La página a la cual deseas ingresar no existe</strong>, por tanto:<br><br>
				<strong>1.- Volver a intentarlo</strong><br><br>
				<strong>2.- Si el problema persiste informar a Pago Libre-Soporte  captura la imagen y enviar a soporte@pagolibre.com</strong><br><br><br>
				Que tengas un buen día. 				
			</div>
		</div>
	</div>

</body>
</html>