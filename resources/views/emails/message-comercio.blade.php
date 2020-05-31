<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h2>Paso 1.</h2>
	Se te envía una dirección web para que ingreses y modifiques el estado a {{ $enviarCorreoTipo == 2 ? " Entregado " : " Recibido " }} al momento de 
	{{ $enviarCorreoTipo == 2 ? " dar " : " recepcionar " }} el Producto y/o Servicio {{ $enviarCorreoTipo == 2 ? " al cliente. " : " del comercio. " }} <br><br>
	
	<?php 
		if($enviarCorreoTipo == 2) {
			$tipoComercioCliente = 1;
		} else {
			$tipoComercioCliente = 2;	
		}
	?>

	<a href='http://localhost/laravelPrueba/public/nuevoEstado/{{$transaccionId}}/{{$transaccionComercioClientePasswordLink}}/{{$tipoComercioCliente}}'><strong>Dar Click en la siguiente Página</strong></a>
	
	<h2>Paso 2</h2> 
	Utilizarás el siguiente password antes de hacer click en el botón {{ $enviarCorreoTipo == 2 ? " Entregado " : " Recibido " }}<br>
	Password: <strong>{{ $transaccionComercioClientePassword }}</strong>

	<h3>Paso 3</h3>
	Una vez que el 

	{{ $enviarCorreoTipo == 2 ? " Cliente haya aceptado el Producto y/o Servicio deberas de " : " Comercio haya entregado el Producto y/o Servicio deberas de " }}
	 
	recarga la página para que puedas visualizar el estado de
	{{ $enviarCorreoTipo == 2 ? " Recibido por el Cliente. " : " Entregado por el Comercio. " }} <br><br>

	Esperamos pronto volver a atenderte por nuestro canal de Pago Libre.<br><br>

</body>
</html>