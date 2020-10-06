<!DOCTYPE html>
<html>
<head>
<!--    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <title>Document</title>
</head>
<body>
hola el siguiente es el códigoQR:
<!--<span>{!! $imagen !!}</span>-->
<!--<span><img src="data:image/png;base64, {!! base64_encode($imagen) !!} "></span>-->

    <div class="visible-print text-center">
        <!--{!! QrCode::size(100)->generate(Request::url()); !!}-->
        <p>Escanéame para volver a la página principal.</p>
        
    </div>
    
    
    <!--<img src="{{asset('qrcodes/qrcode.svg')}}" alt = "Si no se visualiza el codigo QR descargalo desde:">-->
    
    <!--<img src="{{asset('imagen/cargador_nuevo_sol.gif')}}">-->
    <img src="{{asset('qrcodes/qrcode.png')}}">
    

    <!--{!! QrCode::size(250)->generate('www.google.com'); !!} -->
</body>
</html>
