<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- Incluyendo Culqi Checkout -->
	<script src="https://checkout.culqi.com/js/v3"></script>
	<script type="text/javascript" src="js/jquery-3.0.0.min.js"></script>
</body>
</head>
<body>
	<!--
	4111111111111111
	132
	09/20
	aaaaa@hotmail.com


	Visa	4111111111111111	09/2025	123	Venta exitosa
	Master Card	5111 1111 1111 1118	06/2025	039	Venta exitosa
	American Express	3712 1212 1212 122	11/2025	2841	Venta exitosa
	Diners Club	360012 1212 1210	04/2025	964	Venta exitosa


	-->
	PRODUCTO 1
	<input type="button" id="buyButton" name="" value="COMPRAR" data-producto="Curso de PHP avanzado" data-precio="500">
	<script>
		//Culqi.publicKey = 'pk_test_NqL58Uwpn6Qus7Qi';
		Culqi.publicKey = 'pk_test_4838227e3d8eadce';

		var producto = "";
		var precio = "";

		$('#buyButton').on('click', function(e) {
			producto = $(this).attr('data-producto');
			precio = $(this).attr('data-precio');

			Culqi.settings({
				title: producto,
				currency: 'PEN',
				description: producto,
				amount: precio
			});

		    // Abre el formulario con la configuración en Culqi.settings
		    Culqi.open();
		    e.preventDefault();
		});

		function culqi() {
			if (Culqi.token) { // ¡Objeto Token creado exitosamente!
				var token = Culqi.token.id;

				var email = Culqi.token.email;
				//alert('Se ha creado un token:' + token);
				//En esta linea de codigo debemos enviar el "Culqi.token.id"
				//hacia tu servidor con Ajax

				var data = {
								producto:producto, 
								precio:precio, 
								token:token, 
								email:email
							};
				
				var url = "proceso.php";

				$.post(url, data, function(resp){
					alert(resp);
				})
			} else { // ¡Hubo algún problema!
				// Mostramos JSON de objeto error en consola
				console.log(Culqi.error);
				alert(Culqi.error.user_message);
			}
		};



	</script>

</body>
</html>