<html>
<head>
    <title>Pago Libre</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

	@if ($_SERVER['SERVER_NAME'] == "localhost")
		<link rel="stylesheet" href="{{url('estilo/bootstrap4/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{url('estilo/css/all.min.css')}}">
	@else
		<link rel="stylesheet" href="https://comparadordeventas.com/pagolibre/public/estilo/bootstrap4/bootstrap.min.css">
		<link rel="stylesheet" href="https://comparadordeventas.com/pagolibre/public/estilo/css/all.min.css">
	@endif
    <style>
      .alert-message {
        color: red;
      }
    </style>
</head>
<body>
<br>
<div class="container panel panel-default">
	<div class="card">
		<div class="card-header">
			<h2 class="panel-heading">Pago Libre</h2>		
		</div>
		<div class="class-body">
			<form id="myForm">
		        <div class="form-group">
		            <strong>Ingresar Correo del Comercio</strong>
		            <input type="text" name="email" class="form-control" placeholder="Ingresa Correo del Comercio" id="emailId">
		            <div class="alert-message" id="emailError"></div>
		        </div>
		        
		        <div class="form-group">
		            <strong>Ingresar tu Correo</strong>
		            <input type="text" name="email2" class="form-control" placeholder="Ingresa tu Correo" id="email2Id">
		            <div class="alert-message" id="email2Error"></div>
		        </div>
		     
		        <div class="form-group">
		            <strong>Monto en soles</strong>
		            <input type="text" name="subject" class="form-control" placeholder="Registrar el Monto" id="subjectId">
		            <div class="alert-message" id="subjectError"></div>
		        </div>
		        
		        <div class="form-group">
		            <strong>Servicio</strong>
		            <textarea class="form-control" name="content" placeholder="Ingresar el servicio" id="contentId"></textarea>
		            <div class="alert-message" id="aboutError"></div>
		        </div>

		        <div class="form-group">
		            <button class="btn btn-success form-control" id="enviarId"><i class="fas fa-credit-card"></i> REALIZAR PAGO</button>
		        </div>
		    </form>
		</div>
	</div>

     
  
</div>
<!--<script src="https://checkout.culqi.com/js/v3"></script>-->
<script src="../resources/js/jquery/jquery-3.0.0.min.js"></script>

<script type="text/javascript">
/*
    Culqi.publicKey = 'pk_test_4838227e3d8eadce';

	var producto = "";
	var precio = "";
	var monto = "";
*/
  	$("#enviarId").on("click", function(event){
/*
        monto = $('#subjectId').val();
        precio = monto * 100;
        producto = $('#contentId').val();


		Culqi.settings({
			title: producto,
			currency: 'PEN',
			description: producto,
			amount: precio
		});

	    // Abre el formulario con la configuración en Culqi.settings
	    Culqi.open();*/
	    event.preventDefault();


	    email = $('#emailId').val();
        email2 = $('#email2Id').val();
        subject = $('#subjectId').val();
        content = $('#contentId').val();


        $.ajax({
          url: "ajaxRequest",
          type:"POST",
          data:{
            "_token": "{{ csrf_token() }}",
            email:email,
            email2:email2,
            subject:subject,
            content:content,
            enviarCorreoTipo:"1",
          },
          success:function(response){
            if (document.domain == "localhost") {
				$(window).attr('location','http://localhost/pagolibre/laravel/public/gracias');
			} else {
				$(window).attr('location','https://comparadordeventas.com/pagolibre/public/gracias');
			}
          },

          error: function(response) {
              $('#emailError').text(response.responseJSON.errors.email);
              $('#email2Error').text(response.responseJSON.errors.email2);
              $('#subjectError').text(response.responseJSON.errors.subject);
              $('#contentError').text(response.responseJSON.errors.content);
           }

         });
		
     
    });

/*
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
			
			//var url = "proceso.php";
			var url = "/laravelPrueba/public/culqui/proceso.php";

			$.post(url, data, function(resp){
				//alert(resp);

				email = $('#emailId').val();
		        email2 = $('#email2Id').val();
		        //monto = $('#subjectId').val();
		        subject = $('#subjectId').val();
		        content = $('#contentId').val();


		        $.ajax({
		          url: "ajaxRequest",
		          type:"POST",
		          data:{
		            "_token": "{{ csrf_token() }}",
		            email:email,
		            email2:email2,
		            subject:subject,
		            content:content,
		            enviarCorreoTipo:"1",
		          },
		          success:function(response){
		            console.log(response);
		            $(window).attr('location','http://localhost/laravelPrueba/public/gracias');
		          },

		          error: function(response) {
		              $('#nameError').text(response.responseJSON.errors.name);
		              $('#emailError').text(response.responseJSON.errors.email);
		              $('#mobileNumberError').text(response.responseJSON.errors.mobile_number);
		              $('#aboutError').text(response.responseJSON.errors.about);
		           }

		         });
			})
		} else { // ¡Hubo algún problema!
			// Mostramos JSON de objeto error en consola
			console.log(Culqi.error);
			alert(Culqi.error.user_message);
		}
	};
*/

</script>

</body>
</html>