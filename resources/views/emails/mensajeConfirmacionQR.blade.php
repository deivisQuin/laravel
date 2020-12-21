<!DOCTYPE html>
<html>
    <head>
        <title>Document</title>
    </head>
    <body>
        <table style="border-radius:20px; border: 1px solid black; background-color: #00f191">
            <tr>
                <td align="center"><h2>Gracias por utilizar el servicio de Pago Libre</h2></td>
            </tr>
            <tr>
                <td>Acabas de realizar una compra por la cantidad de: <h3>S/. {{$monto}} Nuevos Soles.</h3></td>
            </tr>
            <tr>
                <td>El número de Pedido realizado es: <h3>{{str_pad($transaccionId, 4, "0", STR_PAD_LEFT)}}</h3></td>
            </tr>
            <tr>
                <td><h1></h1><br></td>
            </tr>
            @if($oOrden->ordenDelivery == "S")
                <tr>
                    <td>Local de Despacho : <strong>{{$oLocalUbigeoDelivery->local->localNombre}}</strong></td>
                </tr>
                <tr>
                    <td>El pedido es para Delivery</td>
                </tr>
                <tr>
                    <td>Distrito de Entrega : <strong>{{$oLocalUbigeoDelivery->ubigeo->ubigeoNombre}}</strong></td>
                </tr>
                <tr>
                    <td><h1></h1><br></td>
                </tr>
                <tr>
                    <td>El teléfono de contacto que ha registrado es : <h3>{{$oOrden->ordenTelefono}}</h3></td>
                </tr>
            @else
                <tr>
                    <td><strong>El cliente recogerá su pedido en el local</strong></td>
                </tr>
                <tr>
                    <td>Local de Despacho : <strong>{{$localNombre}}</strong></td>
                </tr>
                <tr>
                    <td><h1></h1><br></td>
                </tr>
            @endif

            @if($oOrden->ordenComentario)
                <tr>
                    <td>Tendremos en cuenta lo siguiente: <h3>{{$oOrden->ordenComentario}}</h3></td>
                </tr>
            @endif
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>Su pedido es el siguiente:</td>
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
                <td><strong>Las salsas solicitados por usted son:</strong></td>
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
                                <td><?php echo $transaccionDescripcion; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
        <br>
        <strong>Cualquier consulta o si tuviera alguna observación por favor comuníquese con nosotros al área de Soporte-Pagolibre al 993083387</strong>
        <br><br>
        <img src="{{asset('qrcodes/'.$imagen.'.png')}}">
    </body>
</html>
