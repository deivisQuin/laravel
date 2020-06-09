<html>
<head>
    <title>Pago Libre</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

	@if ($_SERVER['SERVER_NAME'] == "localhost")
		<link rel="stylesheet" href="{{url('estilo/bootstrap4/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{url('estilo/css/all.min.css')}}">
	@else
		<link rel="stylesheet" href="https://comparadordeventas.com/pagolibre/public/estilo/bootstrap4/bootstrap.min.css">
		<link rel="stylesheet" href="https://comparadordeventas.com/pagolibre/public/estilo/css/all.min.css">
	@endif
</head>
<body>
	<div class="container panel panel-default">	
		<br>
		<div class="container">
			<div class="card">
				<div class="card-header">
					<h3>Estados de Cliente y Comercio</h3>
				</div>
				@if(isset($aTransaccion))
				<div class="card-body">
					<div class="form-group">
						<label for = "Password"><strong>Cliente:</strong></label>
						{{$aTransaccion->transaccionClienteEstado == 1 ? "Pendiente de Recepción" : "Producto o Servicio Recibido "}}
						@if($aTransaccion->transaccionClienteEstado == 1)
							<i class="fas fa-clock"></i>
						@else
							<i class="fas fa-thumbs-up"></i>
						@endif
					</div><br>
					<div class="form-group">
						<label for = "Password"><strong>Comercio:</strong></label>
						{{$aTransaccion->transaccionComercioEstado == 1 ? "Pendiente de Entrega" : "Producto o Servicio Entregado" }}
						@if($aTransaccion->transaccionComercioEstado == 1)
							<i class="fas fa-shipping-fast"></i>
						@else
							<i class="fas fa-check"></i>
						@endif
					</div>
				</div>
				@endif
			</div>
		</div>
		<br>
		<div class="container">
			<div class="card">
				<div class="card-body" style="color:green">
					@if($aTransaccion->transaccionComercioEstado == 2 && $aTransaccion->transaccionClienteEstado == 2)
						<h2><strong>Felicidades transacción concluida con éxito.</strong></h2>
						@else
							<h3><strong>Aun no se concluye la transacción...</strong><br>
							Para culminar faltaría que:</h3>
							@if($aTransaccion->transaccionTipo == 1 && $aTransaccion->transaccionClienteEstado == 1)
								<h3>El Cliente registre en el sistema que ya Recibió el producto y/o Servicio</h3>
							@endif
							@if($aTransaccion->transaccionTipo == 2 && $aTransaccion->transaccionComercioEstado == 1)
								<h3>El Comercio registre en el sistema que ya entregó el producto y/o servicio.</h3>
							@endif
					@endif
				</div>
			</div>
		</div>
	</div>
</body>
</html>