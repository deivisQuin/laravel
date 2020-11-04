$(document).ready(function() {
	$("#idSelectEmpresa").on("change", function(){
		let empresaId = $("#idSelectEmpresa").val();

		if (empresaId > 0) {
			$.ajax({
				data: {},
				type: "GET",
				dataType: "json",
				url: "listarLocal/" + empresaId,
				success:function(respuesta){
					if (respuesta.length > 0) {
						for (let i = 0; i < respuesta.length; i++) {
							$("#idSelectLocal").prepend('<option value = "'+respuesta[i].localId+'">'+respuesta[i].localNombre+'</option>');
						}
					}
				},
				error: function(response) {//Si hubo algún problema en el servidor o no pasó la validación
					console.log("error");
				}
			})	
		}
	})

	$("#idSelectLocal, #idAnio, #idMes, #idDia").on("change", function(){
		let localId = $("#idSelectLocal").val();
		let idAnio = $("#idAnio option:selected").val();
		let idMes = $("#idMes option:selected").val()
		let mesFormato = (idMes < 10) ? "0" + idMes : idMes;
		let idDia = $("#idDia option:selected").val();
		let diaFormato = (idDia < 10) ? "0" + idDia : idDia;
	
		let fechaTransaccion = idAnio + "-" + mesFormato + "-" + diaFormato;

		$.ajax({
		    data: {"localId" : localId, "transaccionFechaCrea" : fechaTransaccion,  "_token": $("meta[name='csrf-token']").attr("content")},
		    type: "POST",
		    dataType: "json",
			//url: "transaccion/ventasEmpresa",
			url: "listarTransaccion",
		    success:function(response){
				$("#divVentasEmpresa").html(response);
			},
			error: function(response) {//Si hubo algún problema en el servidor o no pasó la validación
				console.log("error");
			}
		})
	})

	$(document).on("click", ".pagination a",function(e){
		e.preventDefault();

		let empresaId = $("#idSelectEmpresa").val();
		let idAnio = $("#idAnio option:selected").val();
		let idMes = $("#idMes option:selected").val()
		let mesFormato = (idMes < 10) ? "0" + idMes : idMes;
		let idDia = $("#idDia option:selected").val();
		let diaFormato = (idDia < 10) ? "0" + idDia : idDia;
	
		let fechaTransaccion = idAnio + "-" + mesFormato + "-" + diaFormato;

		let page = $(this).attr("href").split("page=")[1];

		$.ajax({
		    data: {"page": page, "empresaId" : empresaId, "transaccionFechaCrea" : fechaTransaccion,  "_token": $("meta[name='csrf-token']").attr("content")},
		    type: "POST",
		    dataType: "json",
		    url: "transaccion/ventasEmpresa",
		    success:function(response){
				$("#divVentasEmpresa").html(response);
			},
			error: function(response) {//Si hubo algún problema en el servidor o no pasó la validación
				console.log("error");
			}
		}) 
	})

    $(document).on("click", ".claseTr",function(){
		let transaccionId = $(this).attr("id");

		$.ajax({
			data: { "_token": $("meta[name='csrf-token']").attr("content")},
			type:"POST",
			dataType: "json",
			url: "transaccion/" + transaccionId + "/ver",
			success: function(respuesta) {
				$("#idContenidoModal").html(respuesta);
				$("#miModal").modal("show");
			}
		})
    })

});

