<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table style="border-radius:20px; border: 1px solid black; background-color: #00f191">
		<tr>
			<td align="center"><h2>Pago Libre te anuncia:</h2></td>
		</tr>
		<tr>
			<td>Acaban de realizar una transferencia por la cantidad de: <h3>S/. {{$monto}} Nuevos Soles.</h3></td>
		</tr>
		<tr>
			<td>El número de Pedido realizado es: <h3>{{str_pad($transaccionId, 4, "0", STR_PAD_LEFT)}}</h3></td>
		</tr>
		<tr>
			<td><h1></h1><br></td>
		</tr>
		@if($oOrden->ordenDelivery == "S")
			<tr>
				<td><strong>El cliente realizó un pedido por Delivery</strong></td>
			</tr>
			<tr>
				<td>Local de Despacho : <strong>{{$oLocalUbigeoDelivery->local->localNombre}}</strong></td>
			</tr>
			<tr>
				<td>Distrito de Entrega : <strong>{{$oLocalUbigeoDelivery->ubigeo->ubigeoNombre}}</strong></td>
			</tr>
			<tr>
				<td><h1></h1><br></td>
			</tr>
			<tr>
				<td>El teléfono de contacto es : <h3>{{$oOrden->ordenTelefono}}</h3></td>
			</tr>
		@else 
			<tr>
				<td><strong>El cliente recogerá su pedido en el local de {{$localNombre}}</strong></td>
			</tr>
			<tr>
				<td><h1></h1><br></td>
			</tr>
		@endif
		
		@if($oOrden->ordenComentario)
			<tr>
				<td>Tener en cuenta lo siguiente: <h3>{{$oOrden->ordenComentario}}</h3></td>
			</tr>
		@endif
		<tr>
			<td></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td>El cliente ha solicitado lo siguiente:</td>
		</tr>
		<tr>
			<td>
				<table style="background-color: pink; border: 1px solid black;">
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
							<td align="right">{{$pedidoDetalle->ODCantidad}}</td>
							
						</tr>
					@endforeach
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td><h1></h1><br></td>
		</tr>
		<tr>
			<td><strong>Las salsas solicitados por el cliente son:</strong></td>
		</tr>
		<tr>
			<td>
				<table style="background-color: pink; border: 1px solid black;">
					<thead>
						<tr>
							<th>Producto:</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $transaccionDescripcion;?>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</table>
	<br>
	Al momento de realizar la entrega del pedido escanea el código QR enviado al correo de tu cliente.<br><br>

</body>
</html>