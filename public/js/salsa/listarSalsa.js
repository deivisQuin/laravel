$(document).ready(function() {
    $(document).on("click", ".claseTd",function(){
        let salsaId = $(this).attr("id");
        let estadoIdNuevo = $(this).attr("estadoIdNuevo");

        let confirmar = confirm("¿Está seguro de modificar el estado de la Salsa?");

        if (confirmar) {
            $.ajax({
                data: {"_token": $("meta[name='csrf-token']").attr("content"),
                        "estadoIdNuevo": estadoIdNuevo,
                        "salsaId": salsaId},
                type:"POST",
                dataType: "json",
                url: "modificarSalsa",
                success: function(respuesta) {
                    location.reload();
                }
            })
        }
		
    });

});