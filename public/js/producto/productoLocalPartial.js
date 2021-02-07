$(".claseSelectCantidad").on("change", function(){
    $("#idSpanMensajeCabeceraError").text("");
    $("#idDivMensajeCabeceraError").show();
    $("#localError").hide();

    let idProducto = $(this).attr("idProducto");
    let idSelectCantidad = $(this).attr("id");
    let idSublineaId = $(this).attr("idSublineaId");
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

                if (idSublineaId == 1) {
                    //Se obtiene la cantidad anterior del mismo producto en el modal ya registrado
                    //Recorremos la clase table_IdProducto del modal idDivModalElegirSalsa
                    let numElementosEncontrados = 0;

                    $(".table_" + idProducto + "").each(function(){
                        numElementosEncontrados++;
                    });

                    var datos = {};

                    $.ajax({
                        data: datos,
                        type: "GET",
                        dataType: "json",
                        url:"listarProductoSalsa/" + idProducto + "/" + cantidad + "/" + localId + "/" + numElementosEncontrados,
                        success:function(respuesta){
                            $("#idCuerpoModalElegirSalsa").append(respuesta);

                            if (idSublineaId == 1) {
                                $("#idDivModalElegirSalsa").modal("show");
                            }
                        }
                    });
                }
            }
        });
        
    }else {
        $(this).removeClass("badge badge-primary");
        $("#idSpanProductoNombre_" + idProducto).removeClass("badge badge-primary");
        $("#idSpanMonto_" + idProducto).text("");
        $("#idHiddenMonto_" + idProducto).val("");
        
        //Cálculamos el Monto Total
        let montoTotal = 0;
        let texto = "";
        $(".claseHiddenMonto").each(function(index, element){
            let idMontoHidden = $(this).attr("id");
            
            if ($("#"+idMontoHidden).val()) {
                let producto_id = idMontoHidden.substr(14);
                let producto_cantidad = $("#idSelectCantidad_" + producto_id).val();
                let producto_nombre = $("#idHiddenProductoNombre_" + producto_id).val();
                let producto_precio = $("#idHiddenProductoPrecio_" + producto_id).val();
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

        if (idSublineaId == 1) {
            for (j = 1; j <= 8; j++) {
                $("#" + idProducto + "_" + j + "").remove();
            }

            $("#idHiddenSalsa").val("");
        }
    }
});