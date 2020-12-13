//Culqi.publicKey = 'pk_test_4838227e3d8eadce'; //panel de integración
Culqi.publicKey = 'pk_live_L62EXjQFQFTCPtRk'; // Panel administrativo

var producto         = "";
var precio           = "";
var empresaEmail     = "";
var empresaRuc       = "";
var delivery         = 1;
var telefonoDelivery = "";
var _token           = "";

$("#idTelefonoDelivery").show();
$("#idDivLocalUbigeo").show();
$("#montoError").hide();
$("#idDivMensajeCabeceraError").hide();

$("#idSelectDelivery").on("change", function(){
    valorDelivery = $(this).val();
    if (valorDelivery == 1) {
        $("#idTelefonoDelivery").show();
        $("#idDivLocalUbigeo").show();
    } else {
        $("#idTelefonoDelivery").val("");
        $("#idSelectLocalUbigeo").val(0);

        $("#idHiddenPrecioDelivery").val(0);

        let montoTotal = $("#idHiddenPrecioTotal").val();
    
        if (montoTotal < 1) {
            montoTotal = 0.00;
        }
    
        montoTotal = parseFloat(montoTotal);

        $("#idSpanMontoTotal").text(montoTotal.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        $("#idHiddenMontoTotal").val(montoTotal.toFixed(2));

        $("#idTelefonoDelivery").hide();
        $("#telefonoError").text("");
        $("#idDivLocalUbigeo").hide();
        $("#distritoError").text("");
    }
});

$("#idSelectLocal").on("change", function() {
    localId = $(this).val();

    $.ajax({
        data: {},
        type: "GET",
        dataType: "json",
        url: "listarProductoLocal/" + localId,
        success:function(respuesta){
            $("#idDivListadoProducto").html(respuesta);
            listarLocalUbigeo(localId);
            limpiar();
        }
    })
})

function limpiar() {
    $("#idSpanMontoTotal").text("");
    $("#idHiddenMontoTotal").val("");
    $("#idHiddenPrecioTotal").val("");
    $("#idHiddenDescripcion").val("");
    $("#idHiddenPrecioDelivery").val("");
    $("#idSpanMensajeCabeceraError").val("");
    $("#idDivMensajeCabeceraError").hide();
    $("#localError").val("");
    $("#localError").hide();
    $("#distritoError").val("");
    $("#distritoError").hide();
}

function listarLocalUbigeo(localId) {
    $.ajax({
        data: {},
        type: "GET",
        dataType: "json",
        url: "listarLocalUbigeoDelivery/" + localId,
        success:function(respuesta){
            let selectLocalUbigeo = "<select><option value = '0'>Distrito de Entrega</option>";

            for (var localUbigeoDelivery in respuesta){
                selectLocalUbigeo += "<option value = '" + respuesta[localUbigeoDelivery]["LUId"] + "'>" + respuesta[localUbigeoDelivery]["ubigeoNombre"] + " : " + respuesta[localUbigeoDelivery]["LUPrecioDelivery"] + "</option>";
            }

            selectLocalUbigeo += "</select>";

            $("#idSelectLocalUbigeo").html(selectLocalUbigeo);
        }
    })
}

$("#idBotonSalsa").on("click", function() {
    $("#idSpanMensajeCabeceraError").text("");
    $("#idDivMensajeCabeceraError").hide();
    $("#localError").hide();

    let localId = $("#idSelectLocal").val();

    if (localId == 0) {
        mensajeLocalError = "* Antes de elegir el producto Debe Elegir un Local";

        $("#idSpanMensajeCabeceraError").text(mensajeLocalError);
        $("#idDivMensajeCabeceraError").show();

        $("#localError").html("<strong>Elegir el Local</strong>");
        $("#localError").show();
        return false;
    }

    $.ajax({
        data:{},
        url:"listarSalsa/" + localId,
        type:"GET",
        dataType: "json",
        success:function(respuesta){
            let listarSalsas = "<ul>"; 
            
            for(let i = 0; i < respuesta.length; i++) {
                let salsaDescripcion =(respuesta[i]["salsaEstadoId"] != 1) ? 
                    respuesta[i]["salsaNombre"] + "___" + "<input type='text' size='5' disabled='disabled' value='[Agotado]' class='alert-message'/>"
                    : "<strong>" + respuesta[i]["salsaNombre"] + "</strong>";
                listarSalsas +="<li>" + salsaDescripcion + "</li>";
            }

            listarSalsas += "</ul>";
                    
            $('#idCuerpoModal').html(listarSalsas);

            $("#idDivModal").modal("show");
        }
    })
})

$(document).on("click", ".claseTdProducto",function(){
    let productoNombre = $(this).attr("trProductoNombre");
    let productoImagen = $(this).attr("trProductoImagen");
    let empresaRuc = $("#empresaRucId").val();

    $("#idModalTitulo").text(productoNombre);

    var image = new Image();
    var src = "";
    
    if (document.domain == "localhost") {
        src = 'http://localhost/pagolibre/laravel/public/imagen/' + empresaRuc + '/' + productoImagen;
    } else {
        src = 'https://comparadordeventas.com/pagolibre/public/imagen/' + empresaRuc + '/' + productoImagen;
    }

    image.src = src;

    image.onload = function() {
        image.width = 300 ;
    }

    $('#idContenidoModal').html(image);

    $("#miModal").modal("show");
})

$(".claseSelectCantidad").on("change", function(){
    $("#idSpanMensajeCabeceraError").text("");
    $("#idDivMensajeCabeceraError").show();
    $("#localError").hide();

    let idProducto = $(this).attr("idProducto");
    let idSelectCantidad = $(this).attr("id");
    let cantidad =$("#"+idSelectCantidad).val();
    let localId = $("#idSelectLocal").val();
    let precioDelivery = $("#idHiddenPrecioDelivery").val();

    if (localId == 0) {
        $("#"+idSelectCantidad).val("0");

        mensajeLocalError = "* Antes de elegir el producto Debe Elegir un Local";

        $("#idSpanMensajeCabeceraError").text(mensajeLocalError);
        $("#idDivMensajeCabeceraError").show();

        $("#localError").html("<strong>Elegir el Local</strong>");
        $("#localError").show();

        return false;
    }

    if (!precioDelivery) {
        precioDelivery = 0.00;
    }

    precioDelivery = parseFloat(precioDelivery);
    
    if(cantidad > 0) {
        $(this).addClass("badge badge-primary");

        $.ajax({
            data:{},
            url:"obtener/" + idProducto + "/" + localId,
            type:"GET",
            dataType: "json",
            success:function(respuesta){
                let productoNombre = respuesta.productoNombre;
                let productoPrecio = respuesta.LLSPPrecio;
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
                        let producto_id = idMontoHidden.substr(14);
                        let producto_cantidad = $("#idSelectCantidad_"+producto_id).val();
                        let producto_nombre = $("#idHiddenProductoNombre_"+producto_id).val();
                        let producto_precio = $("#idHiddenProductoPrecio_"+producto_id).val();
                        let montoHidden = parseFloat($("#"+idMontoHidden).val());

                        texto +="Cant: " + producto_cantidad + " Nombre: " + producto_nombre + " Precio: " + producto_precio + "---";
                        montoTotal = montoTotal + montoHidden;
                    }

                    $("#idHiddenPrecioTotal").val(montoTotal.toFixed(2));
                    
                    let montoFinal = montoTotal + precioDelivery;

                    $("#idSpanMontoTotal").text(montoFinal.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
                    $("#idHiddenMontoTotal").val(montoFinal.toFixed(2));
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
                let producto_id = idMontoHidden.substr(14);
                let producto_cantidad = $("#idSelectCantidad_"+producto_id).val();
                let producto_nombre = $("#idHiddenProductoNombre_"+producto_id).val();
                let producto_precio = $("#idHiddenProductoPrecio_"+producto_id).val();
                let montoHidden = parseFloat($("#"+idMontoHidden).val());

                texto +="cant: " + producto_cantidad + "Nombre: " + producto_nombre + "precio: " + producto_precio +"---";
                montoTotal = montoTotal + montoHidden;
            }

            $("#idHiddenPrecioTotal").val(montoTotal.toFixed(2));

            let montoFinal = montoTotal + precioDelivery;

            $("#idSpanMontoTotal").text(montoFinal.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
            $("#idHiddenMontoTotal").val(montoFinal.toFixed(2));
        })

        $("#idHiddenDescripcion").val(texto);
    }
});

$("#idSelectLocalUbigeo").on("change", function(){
    $("#idSpanMensajeCabeceraError").val("");
    $("#idDivMensajeCabeceraError").hide();
    $("#distritoError").val("");
    $("#distritoError").hide();

    let localUbigeoId = $(this).val();
    
    let montoTotal = $("#idHiddenPrecioTotal").val();
    
    if (montoTotal < 1) {
        montoTotal = 0.00;
    }

    montoTotal = parseFloat(montoTotal);

    if (localUbigeoId > 0) {
        $.ajax({
            data:{},
            url:"obtenerLocalUbigeoDelivery/"+localUbigeoId,
            type:"GET",
            dataType: "json",
            success:function(respuesta){
                let precioDelivery = respuesta.oLocalUbigeo.LUPrecioDelivery;
                $("#idHiddenPrecioDelivery").val(precioDelivery);
    
                let montoFinal = montoTotal + parseFloat(precioDelivery);
                $("#idSpanMontoTotal").text(montoFinal.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
                $("#idHiddenMontoTotal").val(montoFinal.toFixed(2));
            }
        });
    } else {
        $("#idSpanMontoTotal").text(montoTotal.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        $("#idHiddenMontoTotal").val(montoTotal.toFixed(2));
    }
});

$(".claseBotonEnviar").on("click", function(event){
    $("#divMensajeError").hide();
    $("#telefonoError").hide();
    $("#distritoError").hide();
    $("#comentarioError").hide();
    $("#idDivMensajeCabeceraError").hide();

    monto = $("#idHiddenMontoTotal").val();
    precio = monto * 100;
    precio = precio.toFixed(0);
    producto = $("#idHiddenDescripcion").val();
    empresaEmail = $('#empresaEmailId').val();
    empresaRuc = $("#empresaRucId").val();
    delivery = $("#idSelectDelivery").val();
    telefonoDelivery = $("#idTelefonoDelivery").val();
    empresaUbigeoId = $("#idSelectLocalUbigeo").val();
    _token = $("#idHiddenToken").val();
    comentario = $("#idComentario").val();
    indLocalAtendiendo = $("#idIndLocalAtendiendo").val();

    if (indLocalAtendiendo === "0") {
        let localHoraApertura = $("#idLocalHoraApertura").val();
        let localHoraCierre = $("#idLocalHoraCierre").val();
        let localNombre = $("#idLocalNombre").val();

        let tituloMensajeLocalSinAtencion = "<strong style='color:#28a745'><p>Local " + localNombre + " Anuncia lo siguiente:</p></strong>";

        let mensajeLocalSinAtencion = "<strong><p>Lo sentimos pero en estos momentos el local " + localNombre + 
            " está fuera de su horario de atención. El horario de atencion de este local es de: " + localHoraApertura.substring(0, 5) + " a: " + localHoraCierre.substring(0, 5) +
            ". Esperamos pronto volver a atenderlo</p></strong>";

        $("#idDivTituloLocalSinAtencion").html(tituloMensajeLocalSinAtencion);
        $("#idDivMensajeLocalSinAtencion").html(mensajeLocalSinAtencion);

        $("#idDivModalLocalSinAtencion").modal("show");
        return false;
    }
    
    //Se valida entrada del monto debe ser mayor a 5 soles, permitir 2 decimales y no negativos
    if ((monto >= 5) && (monto <= 5000) && (producto.length >= 5) && (producto.length <= 250)) {
        if(delivery == 1) {
            if (telefonoDelivery.length < 6) {
                mensajeTelefonoError = "* Debe Registrar un número de telefono de contacto";
                
                $("#idSpanMensajeCabeceraError").text(mensajeTelefonoError);
                $("#telefonoError").html("<strong>Registrar tu teléfono</strong>");
                $("#idDivMensajeCabeceraError").show();
                $("#telefonoError").show();
                
                return false;
            }
            if (empresaUbigeoId == undefined || empresaUbigeoId < 1) {
                mensajeDistritoError = "* Debe Registrar el Distrito de Entrega del pedido";
                
                $("#idSpanMensajeCabeceraError").text(mensajeDistritoError);
                $("#distritoError").html("<strong>Elegir Distrito de Entrega</strong>");
                $("#idDivMensajeCabeceraError").show();
                $("#distritoError").show();
                
                return false;
            }
        } else {
            $("#idTelefonoDelivery").val("");
            $("#idSelectLocalUbigeo").val(0);
        }

        if (comentario.length < 2) {
            mensajeComentarioError = "Por favor registrar su nombre, dirección y especifica tu pedido";
            $("#idSpanMensajeCabeceraError").text(mensajeComentarioError);
            $("#comentarioError").text(mensajeComentarioError);
            $("#comentarioError").html("<strong>Registrar Nombre, dirección e indicar las cremas</strong>");
            $("#idDivMensajeCabeceraError").show();
            $("#comentarioError").show();

            return false;
        }

        //Validamos datos desde el servidor
        validarDatos(monto, producto, empresaEmail, empresaRuc);
        //Inicio de pruebas sin mostrar modal de pagp
        //generarOrden("variableDePrueba");
        //Fin de pruebas sin mostrar modal de pago
        
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

function generarOrden(data){
    let i = 0;
    var aProducto = {};
    $(".claseSelectCantidad").each(function(){
        let idSelectCantidad = $(this).attr("id");
        let productoId = $(this).attr("idProducto");
        let cantidad = $("#"+idSelectCantidad+"").val();
        
        if (cantidad > 0) {
            aProducto[i] = {};
            aProducto[i]["id"] = productoId;
            aProducto[i]["cantidad"] = cantidad;
            i++;
        }
    })

    registrarOrden(aProducto, data);
}

function registrarOrden(aProducto, data){
    let deliveryId = $("#idSelectDelivery").val();
    let telefonoDelivery = $("#idTelefonoDelivery").val();
    let localUbigeoId = $("#idSelectLocalUbigeo").val();
    let delivery = (deliveryId == 1) ? "S" : "N";
    let comentario = $("#idComentario").val();
    let localId = $("#idSelectLocal").val();

    productos = JSON.stringify(aProducto);
    var datos = {
        aProducto: productos, 
        delivery: delivery, 
        telefonoDelivery: telefonoDelivery,
        "_token": _token,
        localUbigeoId: localUbigeoId,
        comentario: comentario,
    };

    $.ajax({
        data: datos,
        type: "POST",
        dataType: "json",
        url: "registrarOrden",
        success:function(respuesta){
            ordenId = respuesta.mensaje;
            /* 
            // Inicio de realizar pruebas 
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
            transaccionPasarelaMontoDepositar = "570264";

            registrarDatos(empresaEmail, localId, monto, producto, clienteEmail, transaccionPasarelaPedidoId, transaccionPasarelaToken, 
                transaccionPasarelaMonedaCodigo, transaccionPasarelaBancoNombre, transaccionPasarelaBancoPaisNombre, 
                transaccionPasarelaBancoPaisCodigo, transaccionPasarelaTarjetaMarca, transaccionPasarelaTarjetaTipo, 
                transaccionPasarelaTarjetaCategoria, transaccionPasarelaTarjetaNumero, transaccionPasarelaDispositivoIp, 
                transaccionPasarelaCodigoAutorizacion, transaccionPasarelaCodigoReferencia, transaccionPasarelaCodigoRespuesta, 
                transaccionPasarelaComision, transaccionPasarelaIgv, transaccionPasarelaMontoDepositar, ordenId);
            
            //Fin de realizar pruebas
            */

            //Inicio de envío de datos sin hacer pruebas
            if(typeof data.outcome !== "undefined"){tipoVenta = data.outcome.type;}else{tipoVenta = data.type};

            clienteEmail = data.email;

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

                registrarDatos(empresaEmail, localId, monto, producto, clienteEmail, transaccionPasarelaPedidoId, transaccionPasarelaToken, 
                    transaccionPasarelaMonedaCodigo, transaccionPasarelaBancoNombre, transaccionPasarelaBancoPaisNombre, transaccionPasarelaBancoPaisCodigo, 
                    transaccionPasarelaTarjetaMarca, transaccionPasarelaTarjetaTipo, transaccionPasarelaTarjetaCategoria, transaccionPasarelaTarjetaNumero, 
                    transaccionPasarelaDispositivoIp, transaccionPasarelaCodigoAutorizacion, transaccionPasarelaCodigoReferencia, transaccionPasarelaCodigoRespuesta, 
                    transaccionPasarelaComision, transaccionPasarelaIgv, transaccionPasarelaMontoDepositar, ordenId);

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
            //Fin de envio de datos sin hacer pruebas

        }
    });
}

function iniciaCulqi(){
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
}

//Se registran los datos al servidor 
function registrarDatos(empresaEmail, localId, monto, descripcion, clienteEmail, transaccionPasarelaPedidoId, transaccionPasarelaToken, 
    transaccionPasarelaMonedaCodigo, transaccionPasarelaBancoNombre, transaccionPasarelaBancoPaisNombre, transaccionPasarelaBancoPaisCodigo, 
    transaccionPasarelaTarjetaMarca, transaccionPasarelaTarjetaTipo, transaccionPasarelaTarjetaCategoria, transaccionPasarelaTarjetaNumero, 
    transaccionPasarelaDispositivoIp, transaccionPasarelaCodigoAutorizacion, transaccionPasarelaCodigoReferencia, transaccionPasarelaCodigoRespuesta, 
    transaccionPasarelaComision, transaccionPasarelaIgv, transaccionPasarelaMontoDepositar, ordenId){
    
    let transaccionPasarelaComisionFija = 108;
    let transaccionPasarelaComisionFijaIgv = (transaccionPasarelaComisionFija * 0.18);
    let porcentaje = ((monto * 7) - (transaccionPasarelaComision + transaccionPasarelaIgv));
    let transaccionComisionComercio = (130 - (transaccionPasarelaComisionFija + transaccionPasarelaComisionFijaIgv)) + porcentaje;
    let transaccionComercioMontoDepositar = transaccionPasarelaMontoDepositar - transaccionPasarelaComisionFija - 
            transaccionPasarelaComisionFijaIgv - transaccionComisionComercio;

    data = {
            "_token":_token,
            empresaEmail:empresaEmail,
            clienteEmail:clienteEmail,
            //clienteEmail:"jgalarza123456789@gmail.com",
            monto:monto,
            descripcion:descripcion,
            delivery:delivery,
            enviarCorreoTipo:"1",
            //empresaRuc:empresaRuc,
            localId:localId,
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
            transaccionPasarelaComisionFija:transaccionPasarelaComisionFija,
            transaccionPasarelaComisionFijaIgv: transaccionPasarelaComisionFijaIgv,
            transaccionPasarelaMontoDepositar:transaccionPasarelaMontoDepositar,
            transaccionComisionComercio:transaccionComisionComercio,
            transaccionComercioMontoDepositar:transaccionComercioMontoDepositar,
            ordenId:ordenId
        }

    $.ajax({
        url: "transaccion",
        type: "POST",
        data: data,
        success:function(response){
            $('#modal').modal('hide');

            if (document.domain == "localhost") {
                $(window).attr('location','http://localhost/pagolibre/laravel/public/gracias');
            } else {
                $(window).attr('location','https://comparadordeventas.com/pagolibre/public/gracias');
            }
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
        generarOrden(data);
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
