<!DOCTYPE html>
<html>
    <head>
        <title>Document</title>
    </head>
    <body>
        <h2>Gracias por utilizar el servicio de Pago Libre.</h2>
        Acabas de realizar una transferencia por la cantidad de: <h3>S/. {{$monto}} Nuevos Soles.</h3><br>
        Por el producto y/o servicio de: <h3>{{$content}}.</h3><br>

        Presentar el siguiente códigoQR al momento de Recibir su producto:<br><br>
        <!--<span>{!! $imagen !!}</span>-->
        <!--<span><img src="data:image/png;base64, {!! base64_encode($imagen) !!} "></span>-->
            
        <img src="{{asset('qrcodes/'.$imagen.'.png')}}">    

        <!--{!! QrCode::size(250)->generate('https://comparadordeventas.com/pagolibre/public/producto/20602566251'); !!}-->
    </body>
</html>
