<!DOCTYPE html>
<html>
<head>
<!--    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <title>Document</title>
</head>
<body>
hola el siguiente es el códigoQR:
<?php //echo $imagen;?>

    <div class="visible-print text-center">
        <!--{!! QrCode::size(100)->generate(Request::url()); !!}-->
        <p>Escanéame para volver a la página principal.</p>
        
    </div>
    
    
    <img src="{{asset('qrcodes/qrcode.svg')}}">
    <img src="{{asset('imagen/cargador_nuevo_sol.gif')}}">
    

    <!--{!! QrCode::size(250)->generate('www.google.com'); !!} -->
</body>
</html>
