$(document).ready(function() {
	$("#idSelectEmpresa, #idAnio, #idMes, #idDia").on("change", function(){
		empresaId = $("#idSelectEmpresa").val();
		idAnio = $("#idAnio option:selected").val();
		idMes = $("#idMes option:selected").val()
		mesFormato = (idMes < 10) ? "0" + idMes : idMes;
		idDia = $("#idDia option:selected").val();
		diaFormato = (idDia < 10) ? "0" + idDia : idDia;
	
		fechaTransaccion = idAnio + "-" + mesFormato + "-" + diaFormato;

		$.ajax({
		    data: {"empresaId" : empresaId, "transaccionFechaCrea" : fechaTransaccion,  "_token": $("meta[name='csrf-token']").attr("content")},
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