<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
    <?php 
		if($enviarCorreoTipo == 2) {
			$tipoComercioCliente = 1;
		} else {
			$tipoComercioCliente = 2;	
		}
	?>

    Estos son los pasos a seguir para Confirmar {{ ($tipoComercioCliente == 1) ? "la Entrega del" : "el Recibimiento de tu"}} Pedido.<br>
    <h2>Paso 1</h2>
    La contraseña para usar en el siguiente link es la siguiente:   <h3><strong>{{ $transaccionComercioClientePassword }}</strong></h3>

    <h2>Paso 2</h2>
    link de acceso: 

	@if ($_SERVER['SERVER_NAME'] == "localhost")
		<a href='http://localhost/laravelPrueba/public/nuevoEstado/{{$transaccionId}}/{{$transaccionComercioClientePasswordLink}}/{{$tipoComercioCliente}}'><	strong>Dar Click en la siguiente Página</strong></a>
	@else
		<a href='https://comparadordeventas.com/pagolibre/public/nuevoEstado/{{$transaccionId}}/{{$transaccionComercioClientePasswordLink}}/{{$tipoComercioCliente}}'><strong>Dar Click en la siguiente Página</strong></a>
	@endif

    <br><br>
    Esperamos pronto volver a atenderte por nuestro canal de Pago Libre.<br><br>

</body>
</html>