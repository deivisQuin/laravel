<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h2>Pago Libre te anuncia:</h2>
	Acaban de realizar una transferencia por la cantidad de: <h3>S/. {{$monto}} Nuevos Soles.</h3><br>
	El número de Pedido realizado es: <h3>{{str_pad($transaccionId, 4, "0", STR_PAD_LEFT)}}</h3><br>
	Por el producto y/o servicio de: <br><br>
	<table class="table table-dark">
		<thead>
			<tr>
				<th>Producto</th>
				<th>Cantidad</th>
			</tr>
		</thead>
		<tbody>
		@foreach($content as $pedidoDetalle)
			<tr>
				<td>{{$pedidoDetalle->productoNombre}}</td>
				<td align="rigth">{{$pedidoDetalle->ODCantidad}}</td>
				
			</tr>
		@endforeach
		</tbody>
	</table>
	<br>
	Al momento de realizar la entrega del pedido escanea el código QR enviado al correo de tu cliente.<br><br>

</body>
</html>