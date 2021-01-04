$(document).ready(function() {
	var time = new Date().getTime();
	$(document.body).bind("mousemove keypress", function(e) {
			time = new Date().getTime();
	});

	//método que actualiza la página
	function refresh() {
		if ($("#idIndModalEnUso").val() == 0) {
			if(new Date().getTime() - time >= 180000) 
				window.location.reload(true);
			else 
				setTimeout(refresh, 300000);
		}

		setTimeout(refresh, 300000);
	}

	//cada 5 minutos llama al método refresh para actualizar la página
	setTimeout(refresh, 300000);
	
	//Muestra el modal del detalle del pedido del cliente
    $(document).on("click", ".claseTr",function(){
		$("#idIndModalEnUso").val("1");
		let transaccionId = $(this).attr("id");

		$.ajax({
			data: {"_token": $("meta[name='csrf-token']").attr("content")},
			type:"POST",
			dataType: "json",
			url: "transaccion/" + transaccionId + "/ver",
			success: function(respuesta) {
				$("#idContenidoModal").html(respuesta);
				$("#miModal").modal("show");
			}
		})
	});
	
	//Se activa el indicador para evitar que la pagina se actualice
	$(document).on("click", ".claseActivarIndicadorModal",function() {
		$("#idIndModalEnUso").val("0");
	});

	//Se actualiza el estado de entrega al cliente
	$(document).on("click", ".claseEntregarPedido",function(){
		if(confirm("Esta seguro que desea cambiar al estado ENTREGADO AL CLIENTE?")) {
			idBoton = this.id;
			transaccionId = idBoton.substring(22, idBoton.length);
			console.log(transaccionId);

			$.ajax({
				data: {
						"_token": $("meta[name='csrf-token']").attr("content"),
						transaccionTipo: 3,
						contrasena: "defecto",
						transaccionCienteComercioPasswordLink: "defecto",
						transaccionId: transaccionId
					},
				type:"POST",
				dataType: "json",
				url: "nuevoEstado",
				success: function(respuesta) {
					window.location.reload(true);
				}
			})
		}

	})
});