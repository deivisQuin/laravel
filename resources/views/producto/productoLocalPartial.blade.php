<input type="hidden" name="indLocalAtendiendo" class="form-control required"  id="idIndLocalAtendiendo" value="{{$indLocalAtendiendo}}">
<input type="hidden" name="localHoraApertura" class="form-control required"  id="idLocalHoraApertura" value="{{$local->localHoraApertura}}">
<input type="hidden" name="localHoraCierre" class="form-control required"  id="idLocalHoraCierre" value="{{$local->localHoraCierre}}">
<input type="hidden" name="localNombre" class="form-control required"  id="idLocalNombre" value="{{$local->localNombre}}">
<table class="table table-hover" style="font-size: calc(0.6em + 0.6vw)">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Monto</th>
        </tr>
    </thead>
    <tbody>
    @foreach($aProducto as $producto)
        <tr>
            <td class="claseTdProducto" trProductoImagen="{{$producto->LLSPImagen}}" trProductoNombre="{{$producto->producto->productoNombre}}" 
                trProductoObservacion= "{{$producto->producto->productoObservacion}}">
            <span id="idSpanProductoNombre_{{$producto->producto->productoId}}">{{$producto->producto->productoNombre}}</span>
            <input type="hidden" id="idHiddenProductoNombre_{{$producto->producto->productoId}}" value="">
            </td>
            <td class="claseTdProducto" trProductoImagen="{{$producto->LLSPImagen}}" trProductoNombre="{{$producto->producto->productoNombre}}" 
                trProductoObservacion= "{{$producto->producto->productoObservacion}}">
                <span id="idSpanProductoPrecio_{{$producto->producto->productoId}}">{{$producto->LLSPPrecio}}</span>
                <input type="hidden" id="idHiddenProductoPrecio_{{$producto->producto->productoId}}" value="">
            </td>
            <td>
                <select id="idSelectCantidad_{{$producto->producto->productoId}}" 
                    idProducto="{{$producto->producto->productoId}}" idSublineaId="{{$producto->LLSPSublineaId}}" class="claseSelectCantidad">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </td>
            <td class="claseTdProducto" trProductoImagen="{{$producto->LLSPImagen}}" trProductoNombre="{{$producto->producto->productoNombre}}"
                trProductoObservacion= "{{$producto->producto->productoObservacion}}" align="right">
                <strong><span id="idSpanMonto_{{$producto->producto->productoId}}"></span></strong>
                <input type="hidden" id="idHiddenMonto_{{$producto->producto->productoId}}" class="claseHiddenMonto" value="">
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<script>
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
                        var datos = {};

                        $.ajax({
                            data: datos,
                            type: "GET",
                            dataType: "json",
                            url:"listarProductoSalsa/" + idProducto + "/" + cantidad + "/" + localId,
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
</script>