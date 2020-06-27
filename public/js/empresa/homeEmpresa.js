$(document).ready(function() {
	$("#idSelectEmpresa").on("change", function(){
		
		empresaId = $(this).val();
		$.ajax({
		    data: {"empresaId" : empresaId, "_token": $("meta[name='csrf-token']").attr("content")},
		    type: "POST",
		    dataType: "html",
		    url: "transaccion/ventasEmpresa",
		    success:function(response){
				$("#divVentasEmpresa").html(response);
			},
			error: function(response) {//Si hubo algún problema en el servidor o no pasó la validación
				console.log("error");
			}
		})
	})

});