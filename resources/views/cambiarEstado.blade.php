<html>
<head>
    <title>Pago Libre</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{url('estilo/bootstrap4/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('estilo/css/all.min.css')}}">
</head>
<body>

	<div class="container panel panel-default">
		<div class="card">
			<div class="card-header">
				<h3>PAGO LIBRE</h3>
			</div>
			<div class="class-body">
				<form action="{{url('cambiarEstado/' . $aTransaccion->transaccionId)}}" method="post">
					{{method_field('PATCH')}}
					@csrf
					<div class="form-group">
						<label for = "Password"><strong>Password:</strong></label>
						<input type="password" name="contrasena" id="contrasenaId" class="form-control">
						<input type="hidden" name="nuevoEstado" id="nuevoEstadoId" value="2">
					</div><br>
					<div class="form-group">
						<button type="submit" class="btn btn-primary" id = "botonId">Cambiar Estado</button>
					</div>
				</form>
			</div>
		</div>
	</div>
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
	<script src="{{url('js/jquery/jquery-3.0.0.min.js')}}"></script>
	<script type="text/javascript">
	</script>
</body>
