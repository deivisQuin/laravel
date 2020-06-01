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
	@if(isset($aTransaccion))
		@if($aTransaccion->transaccionTipo == 1 && $aTransaccion->transaccionComercioEstado == 2)
			@elseif($aTransaccion->transaccionTipo == 2 && $aTransaccion->transaccionClienteEstado == 2)
				@else
					<div class="container panel panel-default">
						<div class="card">
							<div class="card-header">
								<h3>PAGO LIBRE</h3>
							
								<h4>{{$aTransaccion->transaccionTipo == 1 ? "Comercio" : "Cliente" }}</h4>
								
								@if($aTransaccion->transaccionTipo == 2) <br><strong>(Antes de Cambiar el estado a "Recibido" el comercio deberá de haberte entregado el producto y/o servicio)</strong>
								@endif
								
							</div>
							<div class="class-body">
								<form action="{{url('nuevoEstado')}}" method="post">
									@csrf
									<div class="form-group">
										<br>
										<label for = "Password"><strong>Password del {{$aTransaccion->transaccionTipo == 1 ? "Comercio" : "Cliente" }}:</strong></label>
										<input type="password" name="contrasena" class="form-control" placeholder="Ingrese Contraseña">
										<input type="hidden" name="transaccionTipo" value="{{$aTransaccion->transaccionTipo}}">
										<input type="hidden" name="transaccionId" value="{{$aTransaccion->transaccionId}}">
										<input type="hidden" name="transaccionCienteComercioPasswordLink" 
												value="{{ $aTransaccion->transaccionTipo == 1 ? $aTransaccion->transaccionComercioPasswordLink : $aTransaccion->transaccionClientePasswordLink }}">
									</div><br>
									<div class="form-group">
										<div class="text-center">	
											<button type="submit" {{ ($aTransaccion->transaccionTipo == 2 && $aTransaccion->transaccionComercioEstado == 1) ? "disabled" : ""}} class="btn btn-primary" onclick="return confirm('¿Seguro que desea modificar de estado?');" id = "botonId">{{$aTransaccion->transaccionTipo == 1 ? "Entregado" : "Recibido" }}</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
		@endif
	@endif
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
</body>
</html>
