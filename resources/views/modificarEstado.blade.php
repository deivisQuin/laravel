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
		{{$mostrarMensajeComercio = false}}
		{{$mostrarMensajeCliente = false}}
		@if($aTransaccion->transaccionTipo == 1 && $aTransaccion->transaccionComercioEstado == 2)
			<?php $mostrarMensajeComercio = true; ?>
			@elseif($aTransaccion->transaccionTipo == 2 && $aTransaccion->transaccionClienteEstado == 2)
				<?php $mostrarMensajeCliente = true; ?>
				@else
					<div class="container panel panel-default">
						<div class="card">
							<div class="card-header">
								<h3>PAGO LIBRE</h3>
							
								<h4>{{$aTransaccion->transaccionTipo == 1 ? "Comercio" : "Cliente" }}</h4>
								
								@if($aTransaccion->transaccionTipo == 2) 
									@if($aTransaccion->transaccionComercioEstado == 2)
									<br><strong>(El Comercio indica que ya le entregó el producto y/o Servicio, por lo tanto 
											ya puede registrar su contraseña e informar que ya recibió su pedido)</strong>
										@else
										<br><strong>(Antes de registrar su Contraseña y Cambiar el estado a "Producto Recibido" el comercio deberá de haberle 
													entregado el producto y/o servicio)</strong>
									@endif
								@endif
								
							</div>
							<div class="class-body">
							@if ($_SERVER['SERVER_NAME'] == "localhost")
								<form action="{{url('nuevoEstado')}}" method="post">
							@else
								<form action="https://comparadordeventas.com/pagolibre/public/nuevoEstado" method="post">
							@endif
									@csrf
									<div class="form-group">
										<br>
										<label for = "Password"><strong>Password del {{$aTransaccion->transaccionTipo == 1 ? "Comercio" : "Cliente" }}:</strong></label>
										<input type="password" name="contrasena" id="contrasenaId" class="form-control" placeholder="Ingrese Contraseña">
										<input type="hidden" name="transaccionTipo" value="{{$aTransaccion->transaccionTipo}}">
										<input type="hidden" name="transaccionId" value="{{$aTransaccion->transaccionId}}">
										<input type="hidden" name="transaccionCienteComercioPasswordLink" 
												value="{{ $aTransaccion->transaccionTipo == 1 ? $aTransaccion->transaccionComercioPasswordLink : $aTransaccion->transaccionClientePasswordLink }}">
									</div><br>
									<div class="form-group">
										<div class="text-center">
											@if($aTransaccion->transaccionTipo == 2 && $aTransaccion->transaccionComercioEstado == 1)
												@else
													<button type="submit" disabled class="btn btn-primary" onclick="return confirm('¿Seguro que desea modificar de estado?');" 
														id = "botonId">{{$aTransaccion->transaccionTipo == 1 ? "Producto Entregado" : "Producto Recibido" }}</button>
											@endif
											<!--<button type="submit" disabled {{ ($aTransaccion->transaccionTipo == 2 && $aTransaccion->transaccionComercioEstado == 1) ? "disabled" : ""}} class="btn btn-primary" onclick="return confirm('¿Seguro que desea modificar de estado?');" id = "botonId">{{$aTransaccion->transaccionTipo == 1 ? "Entregado" : "Recibido" }}</button>-->
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
	<br>
	@if($mostrarMensajeComercio || $mostrarMensajeCliente)
	<div class="container">
		<div class="card">
			<div class="card-body" style="color:green">
				<h3><strong>Aun no se concluye la transacción...</strong><br>
				Para culminar faltaría que:</h3>
				@if($aTransaccion->transaccionComercioEstado == 1)
					<h3>El Comercio registre en el sistema que ya entregó el producto y/o servicio.</h3>
					@else
						<h3>El Cliente registre en el sistema que ya Recibió el producto y/o Servicio</h3>
				@endif
			</div>
		</div>
	</div>
	@endif

	@if ($_SERVER['SERVER_NAME'] == "localhost")
		<script src="{{url('js/jquery/jquery-3.0.0.min.js')}}"></script>
	@else
		<script src="https://comparadordeventas.com/pagolibre/public/js/jquery/jquery-3.0.0.min.js"></script>
	@endif

	<script type="text/javascript">
		//validaciones desde el front
		$("#contrasenaId").keyup(function(){
			if ($(this).val().length > 0) {
				$("#botonId").prop("disabled", false);
			} else {
				$("#botonId").prop("disabled", true);
			}
		})
	</script>
</body>
</html>