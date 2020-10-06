Culqi.publicKey = 'pk_test_4838227e3d8eadce';

var producto = "";
var precio = "";
var empresaEmail = "";
var empresaRuc = "";
var delivery = 1;
var telefonoDelivery = "";
var _token = "";

$("#idTelefonoDelivery").hide();
$("#montoError").hide();
$("#idDivMensajeCabeceraError").hide();

$("#idSelectDelivery").on("change", function(){
    valorDelivery = $(this).val();
    if (valorDelivery == 2) {
        $("#idTelefonoDelivery").show();
    } else {
        $("#idTelefonoDelivery").hide();
    }

});

$(".claseSelectCantidad").on("change", function(){
    let idProducto = $(this).attr("idProducto");
    let idSelectCantidad = $(this).attr("id");
    let cantidad =$("#"+idSelectCantidad).val();

    if(cantidad > 0) {
        $(this).addClass("badge badge-primary");
        //$("#idSpanProductoNombre_"+idProducto).addClass("badge badge-primary");

        $.ajax({
            data:{},
            url:"obtener/"+idProducto,
            type:"GET",
            dataType: "json",
            success:function(respuesta){
                let productoNombre = respuesta.productoNombre;
                let productoPrecio = respuesta.productoPrecio;
                let monto = productoPrecio * cantidad;

                $("#idSpanMonto_"+idProducto).text(monto.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
                $("#idHiddenMonto_"+idProducto).val(monto);
                $("#idHiddenProductoNombre_"+idProducto).val(productoNombre);
                $("#idHiddenProductoPrecio_"+idProducto).val(productoPrecio);

                //Cálculamos el Monto Total
                let montoTotal = 0;
                let texto = "";
                $(".claseHiddenMonto").each(function(index, element){
                    let idMontoHidden = $(this).attr("id");
                    
                    if ($("#"+idMontoHidden).val()) {
                        
                        let cantidadDeCaracteres = idMontoHidden.length;
                        let producto_id = idMontoHidden.substr(14);
                        
                        let producto_cantidad = $("#idSelectCantidad_"+producto_id).val();
                        let producto_nombre = $("#idHiddenProductoNombre_"+producto_id).val();
                        let producto_precio = $("#idHiddenProductoPrecio_"+producto_id).val();
                        texto +="Cant: " + producto_cantidad + " Nombre: " + producto_nombre + " Precio: " + producto_precio + "---";

                        let montoHidden = parseFloat($("#"+idMontoHidden).val());
                        montoTotal = montoTotal + montoHidden;
                    }

                    $("#idSpanMontoTotal").text(montoTotal.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
                    $("#idHiddenMontoTotal").val(montoTotal.toFixed(2));
                })

                $("#idHiddenDescripcion").val(texto);
            }
        });
        
    }else {
        $(this).removeClass("badge badge-primary");
        $("#idSpanProductoNombre_"+idProducto).removeClass("badge badge-primary");
        $("#idSpanMonto_"+idProducto).text("");
        $("#idHiddenMonto_"+idProducto).val("");
        
        //Cálculamos el Monto Total
        let montoTotal = 0;
        let texto = "";
        $(".claseHiddenMonto").each(function(index, element){
            let idMontoHidden = $(this).attr("id");
            
            if ($("#"+idMontoHidden).val()) {
                
                let cantidadDeCaracteres = idMontoHidden.length;
                let producto_id = idMontoHidden.substr(14);
                
                let producto_cantidad = $("#idSelectCantidad_"+producto_id).val();
                let producto_nombre = $("#idHiddenProductoNombre_"+producto_id).val();
                let producto_precio = $("#idHiddenProductoPrecio_"+producto_id).val();
                texto +="cant: " + producto_cantidad + "Nombre: " + producto_nombre + "precio: " + producto_precio +"---";

                let montoHidden = parseFloat($("#"+idMontoHidden).val());
                montoTotal = montoTotal + montoHidden;
            }

            $("#idSpanMontoTotal").text(montoTotal.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
            $("#idHiddenMontoTotal").val(montoTotal.toFixed(2));
        })

        $("#idHiddenDescripcion").val(texto);
    }
})

//$("#enviarId").on("click", function(event){
$(".claseBotonEnviar").on("click", function(event){
    $("#divMensajeError").hide();
    $("#telefonoError").hide();
    $("#idDivMensajeCabeceraError").hide();


    monto = $("#idHiddenMontoTotal").val();
//  		monto = $('#montoId').val();
    precio = monto * 100;
    precio = precio.toFixed(0);
    producto = $("#idHiddenDescripcion").val();
    //producto = $('#descripcionId').val();
    empresaEmail = $('#empresaEmailId').val();
    empresaRuc = $("#empresaRucId").val();
    delivery = $("#idSelectDelivery").val();
    telefonoDelivery = $("#idTelefonoDelivery").val();
    _token = $("#idHiddenToken").val();
    
    event.preventDefault();

    //Se valida entrada del monto debe ser mayor a 5 soles, permitir 2 decimales y no negativos
    if ((monto >= 5) && (monto <= 5000) && (producto.length >= 5) && (producto.length <= 250)) {
        if(delivery == 2) {
            mensajeTelefonoError = "* Debe Registrar un número de telefono de contacto";
            $("#idSpanMensajeCabeceraError").text(mensajeTelefonoError);
            $("#telefonoError").text(mensajeTelefonoError);
            $("#idDivMensajeCabeceraError").show();
            $("#telefonoError").show();
            
            return false;
        }

        //Validamos datos desde el servidor
        validarDatos(monto, producto, empresaEmail, empresaRuc);

        /*
        $token = "ggtbfrjjbhgrffr"; //Este valor lo obtenemos desde el modal de culqi desde: culqi.token
        clienteEmail = "jgalarza123456789@gmail.com";//Este dato lo obtengo desde el modal de culqui desde: culqi.email
        transaccionPasarelaPedidoId = "chr_test_Q0vyMmLw8yGyUl7v";
        transaccionPasarelaToken = "tkn_test_yla14jhxmnJnDBGE";
        transaccionPasarelaMonedaCodigo = "PEN";
        transaccionPasarelaBancoNombre = "BBVA";
        transaccionPasarelaBancoPaisNombre = "PERU";
        transaccionPasarelaBancoPaisCodigo = "PE";
        transaccionPasarelaTarjetaMarca = "Visa";
        transaccionPasarelaTarjetaTipo = "crédito";
        transaccionPasarelaTarjetaCategoria = "clásica";
        transaccionPasarelaTarjetaNumero = "411111******1111";
        transaccionPasarelaDispositivoIp = "181.176.97.94";
        transaccionPasarelaCodigoAutorizacion = "u9TJeX";
        transaccionPasarelaCodigoReferencia = "M2oW0m5O8p";
        transaccionPasarelaCodigoRespuesta = "venta_exitosa";
        transaccionPasarelaComision = "0.042";
        transaccionPasarelaIgv = "4536";
        transaccionPasarelaMontoDepositar = "570264";*/

        registrarDatos(empresaEmail, empresaRuc, monto, producto, clienteEmail, transaccionPasarelaPedidoId, transaccionPasarelaToken, 
                transaccionPasarelaMonedaCodigo, transaccionPasarelaBancoNombre, transaccionPasarelaBancoPaisNombre, 
                transaccionPasarelaBancoPaisCodigo, transaccionPasarelaTarjetaMarca, transaccionPasarelaTarjetaTipo, 
                transaccionPasarelaTarjetaCategoria, transaccionPasarelaTarjetaNumero, transaccionPasarelaDispositivoIp, 
                transaccionPasarelaCodigoAutorizacion, transaccionPasarelaCodigoReferencia, transaccionPasarelaCodigoRespuesta, 
                transaccionPasarelaComision, transaccionPasarelaIgv, transaccionPasarelaMontoDepositar);
        event.preventDefault();

    } else {
        //Validar campos por parte del front
        
        mensajeError = "* Debe Seleccionar un producto";
        $("#idSpanMensajeCabeceraError").text(mensajeError);
        $("#idDivMensajeCabeceraError").show();
        
        event.preventDefault();
    }
});

//Se validan datos de parte del servidor
function validarDatos(monto, producto, empresaEmail, empresaRuc){
    var datos = {
            producto:producto, 
            monto:monto, 
            empresaEmail:empresaEmail,
            //"_token": "{{ csrf_token() }}",
            "_token":_token,
            empresaRuc: empresaRuc,
        };

    $.ajax({
        data: datos,
        type: "POST",
        dataType: "json",
        url: "validarFormularioCarrito",
        success:function(response){
            //No llegó a la validación
            if (response.mensajeError) {
                $("#divMensajeError").text(response.mensajeError);
                $("#idDivMensajeCabeceraError").text(response.mensajeError);
                $("#divMensajeError").show();
                $("#idDivMensajeCabeceraError").show();
                
            } else {
                iniciaCulqi();
                console.log("inicia pago");
            }
        },
        error: function(response) {//Si hubo algún problema en el servidor o no pasó la validación
            if (response.responseJSON) {
                mensajeError = "";
                if (response.responseJSON.errors.producto) {
                    mensajeError += response.responseJSON.errors.producto + ". ";
                }
                if (response.responseJSON.errors.monto) {
                    mensajeError += '\n' + response.responseJSON.errors.monto + ". ";
                }
            }

            $("#divMensajeError").show();
            
            if (mensajeError) {
                $("#divMensajeError").text(mensajeError);
            } else {
                $("#divMensajeError").text("Los datos enviados al formulario no son los correctos");
            }
        }
    })
}

function iniciaCulqi(){console.log("metodo inicia culqi");
    Culqi.options({
        lang: 'auto',
        modal: true,
        installments: false,
        customButton: 'Pagar',
        style: {
            maincolor: 'green',
            buttontext: 'white',
            maintext: 'green',
            desctext: 'purple'
        }
    });
        
    Culqi.settings({
        title: "Monto: " + monto.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"),
        currency: 'PEN',
        description: "PAGO LIBRE",
        amount: precio
    });

    // Abre el formulario con la configuración en Culqi.settings
    Culqi.open();
    //event.preventDefault();
}

//Se registran los datos al servidor 
function registrarDatos(empresaEmail, empresaRuc, monto, descripcion, clienteEmail, transaccionPasarelaPedidoId, transaccionPasarelaToken, 
                transaccionPasarelaMonedaCodigo, transaccionPasarelaBancoNombre, transaccionPasarelaBancoPaisNombre, transaccionPasarelaBancoPaisCodigo, 
                transaccionPasarelaTarjetaMarca, transaccionPasarelaTarjetaTipo, transaccionPasarelaTarjetaCategoria, transaccionPasarelaTarjetaNumero, 
                transaccionPasarelaDispositivoIp, transaccionPasarelaCodigoAutorizacion, transaccionPasarelaCodigoReferencia, transaccionPasarelaCodigoRespuesta, 
                transaccionPasarelaComision, transaccionPasarelaIgv, transaccionPasarelaMontoDepositar){
    data = {
            "_token":_token,
            empresaEmail:empresaEmail,
            clienteEmail:clienteEmail,
            //clienteEmail:"jgalarza123456789@gmail.com",
            monto:monto,
            descripcion:descripcion,
            delivery:delivery,
            enviarCorreoTipo:"1",
            empresaRuc:empresaRuc,
            transaccionPasarelaPedidoId:transaccionPasarelaPedidoId,
            transaccionPasarelaToken:transaccionPasarelaToken,
            transaccionPasarelaMonedaCodigo:transaccionPasarelaMonedaCodigo,
            transaccionPasarelaBancoNombre:transaccionPasarelaBancoNombre,
            transaccionPasarelaBancoPaisNombre:transaccionPasarelaBancoPaisNombre,
            transaccionPasarelaBancoPaisCodigo:transaccionPasarelaBancoPaisCodigo,
            transaccionPasarelaTarjetaMarca:transaccionPasarelaTarjetaMarca,
            transaccionPasarelaTarjetaTipo:transaccionPasarelaTarjetaTipo,
            transaccionPasarelaTarjetaCategoria:transaccionPasarelaTarjetaCategoria,
            transaccionPasarelaTarjetaNumero:transaccionPasarelaTarjetaNumero,
            transaccionPasarelaDispositivoIp:transaccionPasarelaDispositivoIp,
            transaccionPasarelaCodigoAutorizacion:transaccionPasarelaCodigoAutorizacion,
            transaccionPasarelaCodigoReferencia:transaccionPasarelaCodigoReferencia,
            transaccionPasarelaCodigoRespuesta:transaccionPasarelaCodigoRespuesta,
            transaccionPasarelaComision:transaccionPasarelaComision,
            transaccionPasarelaIgv:transaccionPasarelaIgv,
            transaccionPasarelaMontoDepositar:transaccionPasarelaMontoDepositar,
        }

    $.ajax({
        url: "transaccion",
        type: "POST",
        data: data,
        success:function(response){
            $('#modal').modal('hide');//console.log("se registró la transferencia y se envió el correo");
            /*if (document.domain == "localhost") {
                $(window).attr('location','http://localhost/pagolibre/laravel/public/gracias');
            } else {
                $(window).attr('location','https://comparadordeventas.com/pagolibre/public/gracias');
            }*/
        },
        error: function(response) {
            console.log("error");
        }
    });
}

function enviarDatos(empresaEmail, empresaRuc, precio, producto, token, clienteEmail){
    var data = {
            producto:"Varios", 
            precio:precio, 
            token:token, 
            email:clienteEmail
        };

    //se bloquean los campos de ingreso
    $('#enviarId').attr("disabled", true);
    $('#idBotonPagarCabecera').attr("disabled", true);
    
    var url = "";

    if (document.domain == "localhost") {
        url = "http://localhost/pagolibre/laravel/public/culqi/proceso.php";
    } else {
        url = "/pagolibre/public/culqi/proceso.php";
    }

    $.ajax({
        // En data puedes utilizar un objeto JSON, un array o un query string
        data: data,
        type: "POST",
        dataType: "json",
        url: url,
    })
    .done(function( data, textStatus, jqXHR ) {
        if(typeof data.outcome !== "undefined"){tipoVenta = data.outcome.type;}else{tipoVenta = data.type};      
        //$tipoVenta = "venta_exitosa";
        if ( (typeof tipoVenta !== 'undefined') && (tipoVenta == "venta_exitosa")) {

            transaccionPasarelaPedidoId = (typeof data.id !== "undefined") ? data.id : "NO TIENE";
            transaccionPasarelaToken = (typeof data.source !== "undefined") ? data.source.id : "NO TIENE" ;
            transaccionPasarelaMonedaCodigo = (typeof data.currency_code !== "undefined") ? "-" + data.currency_code : "NO TIENE";
            transaccionPasarelaBancoNombre = (typeof data.source !== "undefined") ? "-" + data.source.iin.issuer.name : "NO TIENE";
            transaccionPasarelaBancoPaisNombre = (typeof data.source !== "undefined") ? "-" + data.source.iin.issuer.country : "NO TIENE";
            transaccionPasarelaBancoPaisCodigo = (typeof data.source !== "undefined") ? "-" + data.source.iin.issuer.country_code : "NO TIENE";
            transaccionPasarelaTarjetaMarca = (typeof data.source !== "undefined") ? "-" + data.source.iin.card_brand : "NO TIENE";
            transaccionPasarelaTarjetaTipo = (typeof data.source !== "undefined") ? "-" + data.source.iin.card_type : "NO TIENE";
            transaccionPasarelaTarjetaCategoria = (typeof data.source !== "undefined") ? "-" + data.source.iin.card_category : "NO TIENE";
            transaccionPasarelaTarjetaNumero = (typeof data.source !== "undefined") ? "-" + data.source.card_number : "NO TIENE";
            transaccionPasarelaDispositivoIp = (typeof data.source !== "undefined") ? data.source.client.ip : "NO TIENE";
            transaccionPasarelaCodigoAutorizacion = (typeof data.authorization_code !== "undefined") ? data.authorization_code : "NO TIENE";
            transaccionPasarelaCodigoReferencia = (typeof data.reference_code !== "undefined") ? "-" + data.reference_code : "NO TIENE";
            transaccionPasarelaCodigoRespuesta = (tipoVenta) ? tipoVenta : "NO TIENE";
            transaccionPasarelaComision = (typeof data.fee_details !== "undefined") ? data.fee_details.variable_fee.total : "NO TIENE";
            transaccionPasarelaIgv = (typeof data.total_fee_taxes !== "undefined") ? data.total_fee_taxes : "NO TIENE";
            transaccionPasarelaMontoDepositar = (typeof data.transfer_amount !== "undefined") ? data.transfer_amount : "NO TIENE";
            
            registrarDatos(empresaEmail, empresaRuc, monto, producto, clienteEmail, transaccionPasarelaPedidoId, transaccionPasarelaToken, 
                    transaccionPasarelaMonedaCodigo, transaccionPasarelaBancoNombre, transaccionPasarelaBancoPaisNombre, transaccionPasarelaBancoPaisCodigo, 
                    transaccionPasarelaTarjetaMarca, transaccionPasarelaTarjetaTipo, transaccionPasarelaTarjetaCategoria, transaccionPasarelaTarjetaNumero, 
                    transaccionPasarelaDispositivoIp, transaccionPasarelaCodigoAutorizacion, transaccionPasarelaCodigoReferencia, transaccionPasarelaCodigoRespuesta, 
                    transaccionPasarelaComision, transaccionPasarelaIgv, transaccionPasarelaMontoDepositar);

            $('#contenedor_de_cargador').fadeIn(1000).html("Se realizó con éxito la transferencia");
        } else {
                $('#contenedor_de_cargador').fadeIn(1000).html("No se realizó la transacción.");
                $('#modal').modal('hide');

            mensajeRespuestaUsuario = data.user_message.replace(/[^a-zA-Z ]/g, "");

            if (document.domain == "localhost") {
                $(window).attr('location','http://localhost/pagolibre/laravel/public/tarjetaNoProcede/' + mensajeRespuestaUsuario);
            } else {
                $(window).attr('location','https://comparadordeventas.com/pagolibre/public/tarjetaNoProcede/' + mensajeRespuestaUsuario);
            }
        }
    })
    .fail(function( jqXHR, textStatus, errorThrown ) {
        $('#contenedor_de_cargador').fadeIn(1000).html("No se realizó la transacción.");
        $('#modal').modal('hide');
        mensajeUsuario = null;
        if (document.domain == "localhost") {
            $(window).attr('location','http://localhost/pagolibre/laravel/public/tarjetaNoProcede/' + mensajeUsuario);
        } else {
            $(window).attr('location','https://comparadordeventas.com/pagolibre/public/tarjetaNoProcede/' + mensajeUsuario);
        }
    });
}

function culqi() {
    $("#modal").modal("show");

    if (Culqi.token) {
        // ¡Objeto Token creado exitosamente!
        var token = Culqi.token.id;
        var clienteEmail = Culqi.token.email;

        enviarDatos(empresaEmail, empresaRuc, precio, producto, token, clienteEmail);	
    }
}
