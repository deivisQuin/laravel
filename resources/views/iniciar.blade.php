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
	  		<div class="row">
			  	<div class="col-md-12  fixed-top">
				  <strong class="h2"><span class="badge badge-danger">Total S/.  </span><span id="idSpanMontoTotal" class="badge badge-danger"></span>
				  <button class="claseBotonEnviar btn btn-success"><i class="fas fa-credit-card"></i> PAGAR</button></strong>
				  
				  <input type="hidden" id="idHiddenMontoTotal" value="">
				  <input type="hidden" id="idHiddenDescripcion" value="">
				  
				</div>


			  <div class="col-md-8">
			  	<h2 class="panel-heading">Pago Libre</h2>
			  </div>
			  <div class="col-md-4">
	  			<!--<div class="mt-2">
				  <strong class="h2 mt-2"><span class="badge badge-danger">Total S/.  </span><span id="idSpanMontoTotal" class="badge badge-danger"></span></strong>
				  <button class="claseBotonEnviar btn btn-success"><i class="fas fa-credit-card"></i> PAGAR</button>
				  
				  <input type="hidden" id="idHiddenMontoTotal" value="">
				  <input type="hidden" id="idHiddenDescripcion" value="">
				  
				</div>-->
			  </div>

			</div>
			

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
		            <h4 style='color:#28a745'><strong>RUC: {{$aEmpresa->empresaRuc}}</strong></h4>
		        </div>
				<div class="form-group">
		            <h4 style='color:#28a745'><strong>Empresa: {{$aEmpresa->empresaNombre}}</strong></h4>
		        </div>
				<div class="form-group">
	  				<span style="color:#dc3545"><strong>* El Stock es referencial, cualquier consulta llamar al: {{$aEmpresa->empresaTelefono}}</strong></span>
				</div>

		        <div class="form-group">
		            <input type="hidden" name="empresaRuc" class="form-control required"  id="empresaRucId" value="{{$aEmpresa->empresaRuc}}">
		            <input type="hidden" name="empresaEmail" class="form-control required"  id="empresaEmailId" value="{{$aEmpresa->empresaEmail}}">
		        </div>

				<div class="row">
				<div class="col">
				
				<table class="table table-hover">
	  				<thead>
	  					<tr>
	  						<th>Producto</th>
							<th>Precio</th>
							<th>Cantidad</th>
							<th>Monto</th>
						</tr>
					</thead>
					<tbody>
					@foreach($aProducto as $producto)
	  					<tr>
	  						<td>
							  <span id="idSpanProductoNombre_{{$producto->producto->productoId}}">{{$producto->producto->productoNombre}}</span>
							  <input type="hidden" id="idHiddenProductoNombre_{{$producto->producto->productoId}}" value="">
							</td>
							<td>
								<span id="idSpanProductoPrecio_{{$producto->producto->productoId}}">{{$producto->producto->productoPrecio}}</span>
	  							<input type="hidden" id="idHiddenProductoPrecio_{{$producto->producto->productoId}}" value="">
							</td>
	  						<td>
								<select id="idSelectCantidad_{{$producto->producto->productoId}}" 
									idProducto="{{$producto->producto->productoId}}" class="claseSelectCantidad">
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
								</select>
							</td>
							<td align="right"><strong><span id="idSpanMonto_{{$producto->producto->productoId}}"></span></strong>
	  							<input type="hidden" id="idHiddenMonto_{{$producto->producto->productoId}}" class="claseHiddenMonto" value="">
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				</div>
				</div>

		        <div class="form-group">
		            <button class="btn btn-success form-control claseBotonEnviar" id="enviarId"><i class="fas fa-credit-card"></i> REALIZAR PAGO</button>
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

	$(".claseSelectCantidad").on("change", function(){
		let idProducto = $(this).attr("idProducto");
		let idSelectCantidad = $(this).attr("id");
		let cantidad =$("#"+idSelectCantidad).val();

		if(cantidad > 0) {
			$(this).addClass("badge badge-primary");
			//$("#idSpanProductoNombre_"+idProducto).addClass("badge badge-primary");

			$.ajax({
				data:{},
				url:"obtener/"+idProducto,
				type:"GET",
				dataType: "json",
				success:function(respuesta){
					let productoNombre = respuesta.productoNombre;
					let productoPrecio = respuesta.productoPrecio;
					let monto = productoPrecio * cantidad;

					$("#idSpanMonto_"+idProducto).text(monto.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
					$("#idHiddenMonto_"+idProducto).val(monto);
					$("#idHiddenProductoNombre_"+idProducto).val(productoNombre);
					$("#idHiddenProductoPrecio_"+idProducto).val(productoPrecio);

					//Cálculamos el Monto Total
					let montoTotal = 0;
					let texto = "";
					$(".claseHiddenMonto").each(function(index, element){
						let idMontoHidden = $(this).attr("id");
						
						if ($("#"+idMontoHidden).val()) {
							
							let cantidadDeCaracteres = idMontoHidden.length;
							let producto_id = idMontoHidden.substr(14);
							
							let producto_cantidad = $("#idSelectCantidad_"+producto_id).val();
							let producto_nombre = $("#idHiddenProductoNombre_"+producto_id).val();
							let producto_precio = $("#idHiddenProductoPrecio_"+producto_id).val();
							texto +="Cant: " + producto_cantidad + " Nombre: " + producto_nombre + " Precio: " + producto_precio + "---";

							let montoHidden = parseFloat($("#"+idMontoHidden).val());
							montoTotal = montoTotal + montoHidden;
						}

						$("#idSpanMontoTotal").text(montoTotal.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
						$("#idHiddenMontoTotal").val(montoTotal.toFixed(2));
					})

					$("#idHiddenDescripcion").val(texto);
				}
			});
			
		}else {
			$(this).removeClass("badge badge-primary");
			$("#idSpanProductoNombre_"+idProducto).removeClass("badge badge-primary");
			$("#idSpanMonto_"+idProducto).text("");
			$("#idHiddenMonto_"+idProducto).val("");
			
			//Cálculamos el Monto Total
			let montoTotal = 0;
			let texto = "";
			$(".claseHiddenMonto").each(function(index, element){
				let idMontoHidden = $(this).attr("id");
				
				if ($("#"+idMontoHidden).val()) {
					
					let cantidadDeCaracteres = idMontoHidden.length;
					let producto_id = idMontoHidden.substr(14);
					
					let producto_cantidad = $("#idSelectCantidad_"+producto_id).val();
					let producto_nombre = $("#idHiddenProductoNombre_"+producto_id).val();
					let producto_precio = $("#idHiddenProductoPrecio_"+producto_id).val();
					texto +="cant: " + producto_cantidad + "Nombre: " + producto_nombre + "precio: " + producto_precio +"---";

					let montoHidden = parseFloat($("#"+idMontoHidden).val());
					montoTotal = montoTotal + montoHidden;
				}

				$("#idSpanMontoTotal").text(montoTotal.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
				$("#idHiddenMontoTotal").val(montoTotal.toFixed(2));
			})

			$("#idHiddenDescripcion").val(texto);
		}
	})

  	//$("#enviarId").on("click", function(event){
	$(".claseBotonEnviar").on("click", function(event){
		$("#divMensajeError").hide();
		$("#montoError").hide();
		$("#descripcionError").hide();


		monto = $("#idHiddenMontoTotal").val();
//  		monto = $('#montoId').val();
        precio = monto * 100;
		precio = precio.toFixed(0);
		producto = $("#idHiddenDescripcion").val();
        //producto = $('#descripcionId').val();
        empresaEmail = $('#empresaEmailId').val();
        empresaRuc = $("#empresaRucId").val();
		event.preventDefault();
		
		//Se valida entrada del monto debe ser mayor a 5 soles, permitir 2 decimales y no negativos
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
			url: "validarFormularioCarrito",
			success:function(response){
				//No llegó a la validación
				if (response.mensajeError) {
					$("#divMensajeError").show();
					$("#divMensajeError").text(response.mensajeError);
				} else {
					iniciaCulqi();
					//console.log("inicia pago");
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
			title: "Monto: " + monto.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"),
			currency: 'PEN',
			description: "PAGO LIBRE",
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
				producto:"Varios", 
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

			if(typeof data.outcome !== "undefined"){tipoVenta = data.outcome.type;}else{tipoVenta = data.type};
/*
			if(typeof data.id !== "undefined"){transaccionPasarelaPedidoId = data.id;}else{transaccionPasarelaPedidoId = "NO TIENE"};
			if(typeof data.source !== "undefined"){transaccionPasarelaToken = data.source.id;}else{transaccionPasarelaToken = "NO TIENE"};
			if(typeof data.currency_code !== "undefined"){transaccionPasarelaMonedaCodigo = data.currency_code;}else{transaccionPasarelaMonedaCodigo = "NO TIENE"};
			if(typeof data.source !== "undefined"){transaccionPasarelaBancoNombre = data.source.iin.issuer.name;}else{transaccionPasarelaBancoNombre = "NO TIENE"};
			if(typeof data.source !== "undefined"){transaccionPasarelaBancoPaisNombre = data.source.iin.issuer.country;}else{transaccionPasarelaBancoPaisNombre = "NO TIENE"};
			if(typeof data.source !== "undefined"){transaccionPasarelaBancoPaisCodigo = data.source.iin.issuer.country_code;}else{transaccionPasarelaBancoPaisCodigo = "NO TIENE"};
			if(typeof data.source !== "undefined"){transaccionPasarelaTarjetaMarca = data.source.iin.card_brand;}else{transaccionPasarelaTarjetaMarca = "NO TIENE"};
			if(typeof data.source !== "undefined"){transaccionPasarelaTarjetaTipo = data.source.iin.card_type;}else{transaccionPasarelaTarjetaTipo = "NO TIENE"};
			if(typeof data.source !== "undefined"){transaccionPasarelaTarjetaCategoria = ("-" + data.source.iin.card_category);}else{transaccionPasarelaTarjetaCategoria = "NO TIENE"};
			if(typeof data.source !== "undefined"){transaccionPasarelaTarjetaNumero = data.source.card_number;}else{transaccionPasarelaTarjetaNumero = "NO TIENE"};
			if(typeof data.source !== "undefined"){transaccionPasarelaDispositivoIp = data.source.client.ip;}else{transaccionPasarelaDispositivoIp = "NO TIENE"};
			if(typeof data.authorization_code !== "undefined"){transaccionPasarelaCodigoAutorizacion = data.authorization_code;}else{transaccionPasarelaCodigoAutorizacion = "NO TIENE"};
			if(typeof data.reference_code !== "undefined"){transaccionPasarelaCodigoReferencia = data.reference_code;}else{transaccionPasarelaCodigoReferencia = "NO TIENE"};
			if(typeof tipoVenta !== "undefined"){transaccionPasarelaCodigoRespuesta = tipoVenta;}else{transaccionPasarelaCodigoRespuesta = "NO TIENE"};
			if(typeof data.fee_details !== "undefined"){transaccionPasarelaComision = data.fee_details.variable_fee.total;}else{transaccionPasarelaComision = "NO TIENE"};
			if(typeof data.total_fee_taxes !== "undefined"){transaccionPasarelaIgv = data.total_fee_taxes;}else{transaccionPasarelaIgv = "NO TIENE"};
			if(typeof data.transfer_amount !== "undefined"){transaccionPasarelaMontoDepositar = data.transfer_amount;}else{transaccionPasarelaMontoDepositar = "NO TIENE"};*/
			 
		 	//$tipoVenta = "venta_exitosa";
		 	if ( (typeof tipoVenta !== 'undefined') && (tipoVenta == "venta_exitosa")) {

				transaccionPasarelaPedidoId = (typeof data.id !== "undefined") ? data.id : "NO TIENE";
				transaccionPasarelaToken = (typeof data.source !== "undefined") ? data.source.id : "NO TIENE" ;
				transaccionPasarelaMonedaCodigo = (typeof data.currency_code !== "undefined") ? "-" + data.currency_code : "NO TIENE";
				transaccionPasarelaBancoNombre = (typeof data.source !== "undefined") ? "-" + data.source.iin.issuer.name : "NO TIENE";
				transaccionPasarelaBancoPaisNombre = (typeof data.source !== "undefined") ? "-" + data.source.iin.issuer.country : "NO TIENE";
				transaccionPasarelaBancoPaisCodigo = (typeof data.source !== "undefined") ? "-" + data.source.iin.issuer.country_code : "NO TIENE";
				transaccionPasarelaTarjetaMarca = (typeof data.source !== "undefined") ? "-" + data.source.iin.card_brand : "NO TIENE";
				transaccionPasarelaTarjetaTipo = (typeof data.source !== "undefined") ? "-" + data.source.iin.card_type : "NO TIENE";
				transaccionPasarelaTarjetaCategoria = (typeof data.source !== "undefined") ? "-" + data.source.iin.card_category : "NO TIENE";
				transaccionPasarelaTarjetaNumero = (typeof data.source !== "undefined") ? "-" + data.source.card_number : "NO TIENE";
				transaccionPasarelaDispositivoIp = (typeof data.source !== "undefined") ? data.source.client.ip : "NO TIENE";
				transaccionPasarelaCodigoAutorizacion = (typeof data.authorization_code !== "undefined") ? data.authorization_code : "NO TIENE";
				transaccionPasarelaCodigoReferencia = (typeof data.reference_code !== "undefined") ? "-" + data.reference_code : "NO TIENE";
				transaccionPasarelaCodigoRespuesta = (tipoVenta) ? tipoVenta : "NO TIENE";
				transaccionPasarelaComision = (typeof data.fee_details !== "undefined") ? data.fee_details.variable_fee.total : "NO TIENE";
				transaccionPasarelaIgv = (typeof data.total_fee_taxes !== "undefined") ? data.total_fee_taxes : "NO TIENE";
				transaccionPasarelaMontoDepositar = (typeof data.transfer_amount !== "undefined") ? data.transfer_amount : "NO TIENE";
				
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