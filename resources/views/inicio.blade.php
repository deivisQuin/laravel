<html>
<head>
    <title>Pago Libre</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if ($_SERVER['SERVER_NAME'] == "localhost")
		<link rel="stylesheet" href="{{url('/estilo/bootstrap4/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{url('/estilo/css/all.min.css')}}">
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

			<div id="modal" class="modal fade border border-success" role="dialog" data-keyboard="false" data-backdrop="static">
			  <div class="modal-dialog">
			    <!-- Contenido del modal -->
			    <div class="modal-content" align="center">
			      <div class="loading">
				  	@if ($_SERVER['SERVER_NAME'] == "localhost")
				  		<img src="{{url('imagen/cargador_nuevo_sol.gif')}}" alt="loading" width="200" height="200"/><br/>
				  	@else
					  <img src="https://comparadordeventas.com/pagolibre/public/imagen/cargador_nuevo_sol.gif" alt="loading" width="200" height="200"/><br/>
					@endif
					  <h4 style="color: green"><strong>Un momento por favor, estamos procesando su pago...</strong></h4>
				  </div>
			    </div>
			  </div>
			</div>

			<div class="alert alert-danger" id="divMensajeError" style="display:none">
				
			</div>

			<form id="myForm" method="POST" action="validacionFormulario">
				@csrf
				<br>
				<div class="form-group">
		            <h4 style='color:green'><strong>RUC: {{$aEmpresa->empresaRuc}}</strong></h4>
		        </div>
				<div class="form-group">
		            <h4 style='color:green'><strong>Empresa: {{$aEmpresa->empresaNombre}}</strong></h4>
		        </div>

		        <div class="form-group">
		            <input type="hidden" name="empresaRuc" class="form-control required"  id="empresaRucId" value="{{$aEmpresa->empresaRuc}}">
		            <input type="hidden" name="empresaEmail" class="form-control required"  id="empresaEmailId" value="{{$aEmpresa->empresaEmail}}">
		        </div>
		     
		        <div class="form-group">
		            <strong>Monto en soles</strong>
		            <input type="number" step=".01" name="monto" class="form-control" placeholder="Registrar el Monto" id="montoId" min="5" max="5000" required>
					<div class="alert-message" id="montoError"></div>
		        </div>
		        
		        <div class="form-group">
		            <strong>Servicio</strong>
		            <textarea class="form-control" name="descripcion" placeholder="Ingresar el servicio" id="descripcionId" maxlength="250" minlength="5" required></textarea>
		            <div class="alert-message" id="descripcionError"></div>
		        </div>

		        <div class="form-group">
		            <button class="btn btn-success form-control" id="enviarId"><i class="fas fa-credit-card"></i> REALIZAR PAGO</button>
		        </div>
		    </form>
		</div>
	</div>
</div>

<script src="https://checkout.culqi.com/js/v3"></script>

@if ($_SERVER['SERVER_NAME'] == "localhost")
    <script src="{{url('js/jquery/jquery-3.0.0.min.js')}}"></script>
    <script src="{{url('estilo/bootstrap4/bootstrap.min.js')}}"></script>
@else
<script src="https://comparadordeventas.com/pagolibre/public/js/jquery/jquery-3.0.0.min.js"></script>
<script src="https://comparadordeventas.com/pagolibre/public/estilo/bootstrap4/bootstrap.min.js"></script>
@endif


<script type="text/javascript">

    Culqi.publicKey = 'pk_test_4838227e3d8eadce';

	var producto = "";
	var precio = "";
	var empresaEmail = "";
	var empresaRuc = "";

	//Se valida entrada del monto debe ser mayor a 5 soles, permitir 2 decimales y no negativos
	$("#montoId").on("keypress", function(e){
		if((e.keyCode>=48 && e.keyCode<=57) || e.keyCode == 46){
			return true;
		}else{
			return false;
		}
	});

	$( "#montoId" ).blur(function() {
		this.value = parseFloat(this.value).toFixed(2);
	});

  	$("#enviarId").on("click", function(event){
		$("#divMensajeError").hide();
		$("#montoError").hide();
		$("#descripcionError").hide();

  		monto = $('#montoId').val();
        precio = monto * 100;
        producto = $('#descripcionId').val();
        empresaEmail = $('#empresaEmailId').val();
        empresaRuc = $("#empresaRucId").val();
		event.preventDefault();
        if ((monto >= 5) && (monto <= 5000) && (producto.length >= 5) && (producto.length <= 250)) {
        	//Validamos datos desde el servidor
        	validarDatos(monto, producto, empresaEmail, empresaRuc);

			/*
		    $token = "ggtbfrjjbhgrffr"; //Este valor lo obtenemos desde el modal de culqi desde: culqi.token
		    clienteEmail = "deivis.quin@hotmail.com";//Este dato lo obtengo desde el modal de culqui desde: culqi.email
			transaccionPasarelaPedidoId = "chr_test_Q0vyMmLw8yGyUl7v";
			transaccionPasarelaToken = "tkn_test_yla14jhxmnJnDBGE";
			transaccionPasarelaMonedaCodigo = "PEN";
			transaccionPasarelaBancoNombre = "BBVA";
			transaccionPasarelaBancoPaisNombre = "PERU";
			transaccionPasarelaBancoPaisCodigo = "PE";
			transaccionPasarelaTarjetaMarca = "Visa";
			transaccionPasarelaTarjetaTipo = "crédito";
			transaccionPasarelaTarjetaCategoria = "clásica";
			transaccionPasarelaTarjetaNumero = "411111******1111";
			transaccionPasarelaDispositivoIp = "181.176.97.94";
			transaccionPasarelaCodigoAutorizacion = "u9TJeX";
			transaccionPasarelaCodigoReferencia = "M2oW0m5O8p";
			transaccionPasarelaCodigoRespuesta = "venta_exitosa";
			transaccionPasarelaComision = "0.042";
			transaccionPasarelaIgv = "4536";
			transaccionPasarelaMontoDepositar = "570264";

		    registrarDatos(empresaEmail, empresaRuc, monto, producto, clienteEmail, transaccionPasarelaPedidoId, transaccionPasarelaToken, transaccionPasarelaMonedaCodigo, transaccionPasarelaBancoNombre, transaccionPasarelaBancoPaisNombre, transaccionPasarelaBancoPaisCodigo, transaccionPasarelaTarjetaMarca, transaccionPasarelaTarjetaTipo, transaccionPasarelaTarjetaCategoria, transaccionPasarelaTarjetaNumero, transaccionPasarelaDispositivoIp, transaccionPasarelaCodigoAutorizacion, transaccionPasarelaCodigoReferencia, transaccionPasarelaCodigoRespuesta, transaccionPasarelaComision, transaccionPasarelaIgv, transaccionPasarelaMontoDepositar);
		    event.preventDefault();
*/
        } else {
	  		//Validar campos por parte del front
			//console.log("Datos ingresados incorrecto desde el front");
			mensajeMontoError = "";
			mensajeDescripcionError = "";
			mensajeDescripcionError += $("#descripcionId").val().length < 5 ? " El Producto o Servicio debe tener mas de 5 caracteres." : "";
			mensajeDescripcionError += $("#descripcionId").val().length > 250 ? " El producto o Servicio debe tener menos de 250 caracteres." : "";
			mensajeMontoError += $("#montoId").val().length < 1 ? " Debe registrar un monto." : "";
			mensajeMontoError += (parseFloat(monto) < 5) ? " El monto debe superar la cifra de 5 soles." : "";
			mensajeMontoError += parseFloat(monto) > 5000 ? " El monto no debe superar la cifra de 5000 soles." : "";
			$("#montoError").show();
			$("#descripcionError").show();
			$("#montoError").text(mensajeMontoError);
			$("#descripcionError").text(mensajeDescripcionError);
			event.preventDefault();
        }
        
    });

  	//Se validan datos de parte del servidor
    function validarDatos(monto, producto, empresaEmail, empresaRuc){
    	var datos = {
				producto:producto, 
				monto:monto, 
				empresaEmail:empresaEmail,
				"_token": "{{ csrf_token() }}",
				empresaRuc: empresaRuc,
			};

    	$.ajax({
		    data: datos,
		    type: "POST",
		    dataType: "json",
		    url: "validarFormulario",
			success:function(response){
				//No llegó a la validación
				if (response.mensajeError) {
					$("#divMensajeError").show();
					$("#divMensajeError").text(response.mensajeError);
				} else {
					iniciaCulqi();
				}
			},
			error: function(response) {//Si hubo algún problema en el servidor o no pasó la validación
				if (response.responseJSON) {
					mensajeError = "";
					if (response.responseJSON.errors.producto) {
						mensajeError += response.responseJSON.errors.producto + ". ";
					}
					if (response.responseJSON.errors.monto) {
						mensajeError += '\n' + response.responseJSON.errors.monto + ". ";
					}
				}

				$("#divMensajeError").show();
				
				if (mensajeError) {
					$("#divMensajeError").text(mensajeError);
				} else {
					$("#divMensajeError").text("Los datos enviados al formulario no son los correctos");
				}
			}
		})
    }

	function iniciaCulqi(){
		Culqi.options({
			lang: 'auto',
			modal: true,
			installments: false,
			customButton: 'Pagar',
			style: {
				maincolor: 'green',
				buttontext: 'white',
				maintext: 'green',
				desctext: 'purple'
			}
		});
			
		Culqi.settings({
			title: producto,
			currency: 'PEN',
			description: producto,
			amount: precio
		});

		// Abre el formulario con la configuración en Culqi.settings
		Culqi.open();
		//event.preventDefault();
	}

    //Se registran los datos al servidor 
    function registrarDatos(empresaEmail, empresaRuc, monto, descripcion, clienteEmail, transaccionPasarelaPedidoId, transaccionPasarelaToken, transaccionPasarelaMonedaCodigo, transaccionPasarelaBancoNombre, transaccionPasarelaBancoPaisNombre, transaccionPasarelaBancoPaisCodigo, transaccionPasarelaTarjetaMarca, transaccionPasarelaTarjetaTipo, transaccionPasarelaTarjetaCategoria, transaccionPasarelaTarjetaNumero, transaccionPasarelaDispositivoIp, transaccionPasarelaCodigoAutorizacion, transaccionPasarelaCodigoReferencia, transaccionPasarelaCodigoRespuesta, transaccionPasarelaComision, transaccionPasarelaIgv, transaccionPasarelaMontoDepositar){
        data = {
				"_token": "{{ csrf_token() }}",
				empresaEmail:empresaEmail,
				clienteEmail:clienteEmail,
				monto:monto,
				descripcion:descripcion,
				enviarCorreoTipo:"1",
				empresaRuc:empresaRuc,
				transaccionPasarelaPedidoId:transaccionPasarelaPedidoId,
				transaccionPasarelaToken:transaccionPasarelaToken,
				transaccionPasarelaMonedaCodigo:transaccionPasarelaMonedaCodigo,
				transaccionPasarelaBancoNombre:transaccionPasarelaBancoNombre,
				transaccionPasarelaBancoPaisNombre:transaccionPasarelaBancoPaisNombre,
				transaccionPasarelaBancoPaisCodigo:transaccionPasarelaBancoPaisCodigo,
				transaccionPasarelaTarjetaMarca:transaccionPasarelaTarjetaMarca,
				transaccionPasarelaTarjetaTipo:transaccionPasarelaTarjetaTipo,
				transaccionPasarelaTarjetaCategoria:transaccionPasarelaTarjetaCategoria,
				transaccionPasarelaTarjetaNumero:transaccionPasarelaTarjetaNumero,
				transaccionPasarelaDispositivoIp:transaccionPasarelaDispositivoIp,
				transaccionPasarelaCodigoAutorizacion:transaccionPasarelaCodigoAutorizacion,
				transaccionPasarelaCodigoReferencia:transaccionPasarelaCodigoReferencia,
				transaccionPasarelaCodigoRespuesta:transaccionPasarelaCodigoRespuesta,
				transaccionPasarelaComision:transaccionPasarelaComision,
				transaccionPasarelaIgv:transaccionPasarelaIgv,
				transaccionPasarelaMontoDepositar:transaccionPasarelaMontoDepositar,
			}

		$.ajax({
			url: "transaccion",
			type: "POST",
			data: data,
			success:function(response){
				console.log("se hizo el registro");
				$('#modal').modal('hide');
				if (document.domain == "localhost") {
					$(window).attr('location','http://localhost/pagolibre/laravel/public/gracias');
				} else {
					$(window).attr('location','https://comparadordeventas.com/pagolibre/public/gracias');
				}
			},
			error: function(response) {
				console.log("error");
			}
		});
    }

    function enviarDatos(empresaEmail, empresaRuc, precio, producto, token, clienteEmail){
    	var data = {
				producto:producto, 
				precio:precio, 
				token:token, 
				email:clienteEmail
			};

		//se bloquean los campos de ingreso
		$('#enviarId').attr("disabled", true);
		$('#montoId').attr("disabled", true);
		$('#descripcionId').attr("disabled", true);

		var url = "";

		if (document.domain == "localhost") {
            url = "http://localhost/pagolibre/laravel/public/culqi/proceso.php";
		} else {
			url = "/pagolibre/public/culqi/proceso.php";
		}

		$.ajax({
		    // En data puedes utilizar un objeto JSON, un array o un query string
		    data: data,
		    type: "POST",
		    dataType: "json",
		    url: url,
		})


		.done(function( data, textStatus, jqXHR ) {
		 	//console.log(data.outcome.type);
		 	/*tipoVenta = data.outcome.type;
		 	transaccionPasarelaPedidoId = data.id;
		 	transaccionPasarelaToken = data.source.id;
		 	transaccionPasarelaMonedaCodigo = data.currency_code;
		 	transaccionPasarelaBancoNombre = data.source.iin.issuer.name;
		 	transaccionPasarelaBancoPaisNombre = data.source.iin.issuer.country;
		 	transaccionPasarelaBancoPaisCodigo = data.source.iin.issuer.country_code;
		 	transaccionPasarelaTarjetaMarca = data.source.iin.card_brand;
		 	transaccionPasarelaTarjetaTipo = data.source.iin.card_type;
		 	transaccionPasarelaTarjetaCategoria = data.source.iin.card_category;
		 	transaccionPasarelaTarjetaNumero = data.source.card_number;
		 	transaccionPasarelaDispositivoIp = data.source.client.ip;
		 	transaccionPasarelaCodigoAutorizacion = data.authorization_code;
		 	transaccionPasarelaCodigoReferencia = data.reference_code;
		 	transaccionPasarelaCodigoRespuesta = tipoVenta;
		 	transaccionPasarelaComision = data.fee_details.variable_fee.total;
		 	transaccionPasarelaIgv = data.total_fee_taxes;
		 	transaccionPasarelaMontoDepositar = data.transfer_amount;*/

			if(typeof data.outcome !== "undefined"){tipoVenta = data.outcome.type;}else{tipoVenta = data.type};
			if(typeof data.id !== "undefined"){transaccionPasarelaPedidoId = data.id;}else{transaccionPasarelaPedidoId = null};
			if(typeof data.source !== "undefined"){transaccionPasarelaToken = data.source.id;}else{transaccionPasarelaToken = null};
			if(typeof data.currency_code !== "undefined"){transaccionPasarelaMonedaCodigo = data.currency_code;}else{transaccionPasarelaMonedaCodigo = null};
			if(typeof data.source !== "undefined"){transaccionPasarelaBancoNombre = data.source.iin.issuer.name;}else{transaccionPasarelaBancoNombre = null};
			if(typeof data.source !== "undefined"){transaccionPasarelaBancoPaisNombre = data.source.iin.issuer.country;}else{transaccionPasarelaBancoPaisNombre = null};
			if(typeof data.source !== "undefined"){transaccionPasarelaBancoPaisCodigo = data.source.iin.issuer.country_code;}else{transaccionPasarelaBancoPaisCodigo = null};
			if(typeof data.source !== "undefined"){transaccionPasarelaTarjetaMarca = data.source.iin.card_brand;}else{transaccionPasarelaTarjetaMarca = null};
			if(typeof data.source !== "undefined"){transaccionPasarelaTarjetaTipo = data.source.iin.card_type;}else{transaccionPasarelaTarjetaTipo = null};
			if(typeof data.source !== "undefined"){transaccionPasarelaTarjetaCategoria = data.source.iin.card_category;}else{transaccionPasarelaTarjetaCategoria = null};
			if(typeof data.source !== "undefined"){transaccionPasarelaTarjetaNumero = data.source.card_number;}else{transaccionPasarelaTarjetaNumero = null};
			if(typeof data.source !== "undefined"){transaccionPasarelaDispositivoIp = data.source.client.ip;}else{transaccionPasarelaDispositivoIp = null};
			if(typeof data.authorization_code !== "undefined"){transaccionPasarelaCodigoAutorizacion = data.authorization_code;}else{transaccionPasarelaCodigoAutorizacion = null};
			if(typeof data.reference_code !== "undefined"){transaccionPasarelaCodigoReferencia = data.reference_code;}else{transaccionPasarelaCodigoReferencia = null};
			if(typeof tipoVenta !== "undefined"){transaccionPasarelaCodigoRespuesta = tipoVenta;}else{transaccionPasarelaCodigoRespuesta = null};
			if(typeof data.fee_details !== "undefined"){transaccionPasarelaComision = data.fee_details.variable_fee.total;}else{transaccionPasarelaComision = null};
			if(typeof data.total_fee_taxes !== "undefined"){transaccionPasarelaIgv = data.total_fee_taxes;}else{transaccionPasarelaIgv = null};
			if(typeof data.transfer_amount !== "undefined"){transaccionPasarelaMontoDepositar = data.transfer_amount;}else{transaccionPasarelaMontoDepositar = null};
			 
		 	//$tipoVenta = "venta_exitosa";
		 	if ( (typeof tipoVenta !== 'undefined') && (tipoVenta == "venta_exitosa")) {
			    registrarDatos(empresaEmail, empresaRuc, monto, producto, clienteEmail, transaccionPasarelaPedidoId, transaccionPasarelaToken, transaccionPasarelaMonedaCodigo, transaccionPasarelaBancoNombre, transaccionPasarelaBancoPaisNombre, transaccionPasarelaBancoPaisCodigo, transaccionPasarelaTarjetaMarca, transaccionPasarelaTarjetaTipo, transaccionPasarelaTarjetaCategoria, transaccionPasarelaTarjetaNumero, transaccionPasarelaDispositivoIp, transaccionPasarelaCodigoAutorizacion, transaccionPasarelaCodigoReferencia, transaccionPasarelaCodigoRespuesta, transaccionPasarelaComision, transaccionPasarelaIgv, transaccionPasarelaMontoDepositar);

		        $('#contenedor_de_cargador').fadeIn(1000).html("Se realizó con éxito la transferencia");
		 	} else {
		         $('#contenedor_de_cargador').fadeIn(1000).html("No se realizó la transacción.");
				 $('#modal').modal('hide');

				mensajeRespuestaUsuario = data.user_message.replace(/[^a-zA-Z ]/g, "");

				if (document.domain == "localhost") {
					$(window).attr('location','http://localhost/pagolibre/laravel/public/tarjetaNoProcede/' + mensajeRespuestaUsuario);
				} else {
					$(window).attr('location','https://comparadordeventas.com/pagolibre/public/tarjetaNoProcede/' + mensajeRespuestaUsuario);
				}
		 	}
		})
		.fail(function( jqXHR, textStatus, errorThrown ) {
		    console.log( "La solicitud a fallado: " +  textStatus);
         	$('#contenedor_de_cargador').fadeIn(1000).html("No se realizó la transacción.");
         	$('#modal').modal('hide');
			mensajeUsuario = null;
         	if (document.domain == "localhost") {
                $(window).attr('location','http://localhost/pagolibre/laravel/public/tarjetaNoProcede/' + mensajeUsuario);
			} else {
				$(window).attr('location','https://comparadordeventas.com/pagolibre/public/tarjetaNoProcede/' + mensajeUsuario);
			}
		});
    }

    function culqi() {
    	$("#modal").modal("show");

		if (Culqi.token) {
			// ¡Objeto Token creado exitosamente!
			var token = Culqi.token.id;
			var clienteEmail = Culqi.token.email;
	
			enviarDatos(empresaEmail, empresaRuc, precio, producto, token, clienteEmail);	
		}
    }

</script>

</body>
</html>