<!DOCTYPE html>
<html>
<head>
	<title>Tarjeta No Procede</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	@if ($_SERVER['SERVER_NAME'] == "localhost")
		<link rel="stylesheet" href="{{url('estilo/bootstrap4/bootstrap.min.css')}}">
		@else
			<link rel="stylesheet" href="https://comparadordeventas.com/pagolibre/public/estilo/bootstrap4/bootstrap.min.css">
	@endif
</head>
<body>
	<br>
	<div class="container panel panel-default">
		<div class="card">
			<div class="card-header">
				<h3>Ups... transaccion fallida.</h3>
			</div>
			<div class="card-body">
				@if($mensajeUsuario)
					{{$mensajeUsuario}}
					<br><br>
					@else
						Lamentamos informarle que su tarjeta no procede, le recomendamos realizar lo siguiente:<br>
						<strong>1.-</strong> Revisar los datos ingresados.<br>
						<strong>2.-</strong> Consultar con su banco.<br><br>
				@endif

				<a href="{{ url()->previous() }}"><strong>Regresar</strong></a><br><br>
				Que tenga un buen día. 				
			</div>
		</div>
	</div>

</body>
</html>