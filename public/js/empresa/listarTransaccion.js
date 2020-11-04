$(document).ready(function() {
    $(document).on("click", ".claseTr",function(){
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

});