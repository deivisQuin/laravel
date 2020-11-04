$(document).ready(function() {
    $(document).on("click", ".claseTd",function(){
        let LLSPId = $(this).attr("id");
        let estadoIdNuevo = $(this).attr("estadoIdNuevo");

        let confirmar = confirm("¿Está seguro de modificar el estado del producto?");

        if (confirmar) {
            $.ajax({
                data: {"_token": $("meta[name='csrf-token']").attr("content"),
                        "estadoIdNuevo": estadoIdNuevo,
                        "LLSPId": LLSPId},
                type:"POST",
                dataType: "json",
                url: "modificarLocalLineaSublineaProducto",
                success: function(respuesta) {
                    location.reload();
                }
            })
        }
		
    });

});