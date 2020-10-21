<!DOCTYPE html>
<html>
    <head>
        <title>Document</title>
    </head>
    <body>
        <h2>Gracias por utilizar el servicio de Pago Libre.</h2>
        Acabas de realizar una transferencia por la cantidad de: <h3>S/. {{$monto}} Nuevos Soles.</h3><br>
        El número de Pedido realizado es: <h3>{{str_pad($transaccionId, 4, "0", STR_PAD_LEFT)}}</h3><br>
        El teléfono de contacto que ha registrado es : <h3>{{$oOrden->ordenTelefono}}</h3><br>
	
        @if($oOrden->ordenDelivery == "S")
            El pedido es para Delivery. <br>	
        @endif

        @if($oOrden->ordenComentario)
            Tendremos en cuenta lo siguiente: <h3>{{$oOrden->ordenComentario}}</h3> <br>	
        @endif

        Por el producto y/o servicio de: <br><b>
        <table class="table table-hover">
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
                    <td>{{$pedidoDetalle->ODCantidad}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <br>
        Presentar el siguiente códigoQR al momento de Recibir su producto:<br><br>
        <!--<span>{!! $imagen !!}</span>-->
        <!--<span><img src="data:image/png;base64, {!! base64_encode($imagen) !!} "></span>-->
            
        <img src="{{asset('qrcodes/'.$imagen.'.png')}}">    

        <!--{!! QrCode::size(250)->generate('https://comparadordeventas.com/pagolibre/public/producto/20602566251'); !!}-->
    </body>
</html>
