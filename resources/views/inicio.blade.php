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

			<div id="modal" class="modal fade border border-success" role="dialog" data-keyboard="false" data-backdrop="static">
			  <div class="modal-dialog">
			    <!-- Contenido del modal -->
			    <div class="modal-content" align="center">
			      <div class="loading"><img src="{{url('imagen/cargador_nuevo_sol.gif')}}" alt="loading" width="200" height="200"/><br/>
				  	<h4 style="color: green"><strong>Un momento por favor, estamos procesando su pago...</strong></h4>
				  </div>
			    </div>
			  </div>
			</div>

			<div class="alert alert-danger" id="divMensajeError" style="display:none">
				
			</div>

			<form id="myForm"><br>
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
		            <input type="number" step="any" name="monto" class="form-control" placeholder="Registrar el Monto" id="montoId">
		            <div class="alert-message" id="montoError"></div>
		        </div>
		        
		        <div class="form-group">
		            <strong>Servicio</strong>
		            <textarea class="form-control" name="descripcion" placeholder="Ingresar el servicio" id="descripcionId"></textarea>
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

  	$("#enviarId").on("click", function(event){
  		monto = $('#montoId').val();
        precio = monto * 100;
        producto = $('#descripcionId').val();
        empresaEmail = $('#empresaEmailId').val();
        empresaRuc = $("#empresaRucId").val();

        if (monto && producto) {
        	//Validamos datos desde el servidor
        	validarDatos(monto, producto, empresaEmail, empresaRuc);

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
		    event.preventDefault();
		/*			    
		    $token = "ggtbfrjjbhgrffr"; //Este valor lo obtenemos desde el modal de culqi desde: culqi.token
		    clienteEmail = "deivis.quin@hotmail.com";//Este dato lo obtengo desde el modal de culqui desde: culqi.email
		    //enviarDatos(empresaEmail, empresaRuc, precio, producto, token, clienteEmail);

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
			console.log("Datos ingresados incorrecto desde el front");
			$("#descripcionId").val().length < 5 ? $("#descripcionError").text("Debe de tener mas de 5 caracteres") : $("#descripcionError").text("");
			$("#montoId").val().length < 1 ? $("#montoError").text("Debe registrar un monto") : $("#montoError").text("");

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
		})
		.done(function( data, textStatus, jqXHR ) {
			if (data.mensajeError) {
				$("#divMensajeError").show();
				$("#divMensajeError").text(data.mensajeError);
			}
		})
		.fail(function( jqXHR, textStatus, errorThrown ) {
			mensajeError = "";
			if(jqXHR.responseJSON.errors.descripcion){
				mensajeError += jqXHR.responseJSON.errors.descripcion;
			}
			if (jqXHR.responseJSON.errors.monto) {
				mensajeError += '\n' + jqXHR.responseJSON.errors.monto;
			}
			$("#divMensajeError").show();
			$("#divMensajeError").text(mensajeError);
			console.log(mensajeError);
		})
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
				console.log("se hizo el regisyto");
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
		 	console.log(data.outcome.type);
		 	tipoVenta = data.outcome.type;
		 	transaccionPasarelaPedidoId = data.id;
		 	transaccionPasarelaToken = data.source.id;
		 	//transaccionPasarelaToken = token;
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
		 	transaccionPasarelaMontoDepositar = data.transfer_amount;

		 	//$tipoVenta = "venta_exitosa";
		 	if (tipoVenta == "venta_exitosa") {
		 		console.log( "La solicitud se ha completado correctamente." );

			    registrarDatos(empresaEmail, empresaRuc, monto, producto, clienteEmail, transaccionPasarelaPedidoId, transaccionPasarelaToken, transaccionPasarelaMonedaCodigo, transaccionPasarelaBancoNombre, transaccionPasarelaBancoPaisNombre, transaccionPasarelaBancoPaisCodigo, transaccionPasarelaTarjetaMarca, transaccionPasarelaTarjetaTipo, transaccionPasarelaTarjetaCategoria, transaccionPasarelaTarjetaNumero, transaccionPasarelaDispositivoIp, transaccionPasarelaCodigoAutorizacion, transaccionPasarelaCodigoReferencia, transaccionPasarelaCodigoRespuesta, transaccionPasarelaComision, transaccionPasarelaIgv, transaccionPasarelaMontoDepositar);

		         $('#contenedor_de_cargador').fadeIn(1000).html("Se realizó con éxito la transferencia");
		         $('#modal').modal('hide');

		 	} else {
		 		console.log( "No se realizó la transacción." );
		         $('#contenedor_de_cargador').fadeIn(1000).html("No se realizó la transacción.");
		         $('#modal').modal('hide');
		 	}
		})
		.fail(function( jqXHR, textStatus, errorThrown ) {
		    console.log( "La solicitud a fallado: " +  textStatus);
         	$('#contenedor_de_cargador').fadeIn(1000).html("No se realizó la transacción.");
         	$('#modal').modal('hide');

         	if (document.domain == "localhost") {
                $(window).attr('location','http://localhost/pagolibre/laravel/public/tarjetaNoProcede');
			} else {
				$(window).attr('location','https://comparadordeventas.com/pagolibre/public/tarjetaNoProcede');
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