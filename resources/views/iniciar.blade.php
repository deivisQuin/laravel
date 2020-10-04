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
				  <button id="idBotonPagarCabecera" class="claseBotonEnviar btn btn-success"><i class="fas fa-credit-card"></i> PAGAR</button></strong>
				  
				  <input type="hidden" id="idHiddenMontoTotal" value="">
				  <input type="hidden" id="idHiddenDescripcion" value="">
				  <br>
				</div>
				<br><br>
				<div id="idDivMensajeCabeceraError" class="col-md-12  fixed-top"><br><br>
					<strong class="h6"><span class="badge badge-danger h2" id="idSpanMensajeCabeceraError"></span></strong>
				</div>


			  <div class="col-md-8">
			  	<h2 class="panel-heading"><strong>Pago Libre</strong></h2>
			  </div>
			  <div class="col-md-4">
	  			
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
				<!--@csrf-->
				<input type="hidden" id="idHiddenToken" name="_token" value="{{ csrf_token() }}">
				<br>
				<div class="form-group">
		            <h4 style='color:#28a745'><strong>RUC: {{$aEmpresa->empresaRuc}}</strong></h4>
		        </div>
				<div class="form-group">
		            <h4 style='color:#28a745'><strong>Empresa: {{$aEmpresa->empresaRazonSocial}}</strong></h4>
		        </div>
				<div class="form-group">
	  				<label for=""><strong>Dile a {{$aEmpresa->empresaNombre}}</strong></label>
	  				<textarea name="nameComentario" id="idComentario" cols="30" rows="2" placeholder="Dime Algo..."></textarea>
				</div>
				<div class="form-group">
	  				<span style="color:#dc3545"><strong>* El Stock es referencial, cualquier consulta llamar al: {{$aEmpresa->empresaTelefono}}</strong></span>
				</div>
				<div class="form-group">
	  				<div class="row">
	  					<div class="col-sx-12 col-md-12 col-lg-6">
							<select name="nameSelectDelivery" id="idSelectDelivery">
								<option value="1">No Delivery</option>
								<option value="2">Delivery</option>
							</select>  
						</div>
						<div class="col-sx-12 col-md-12 col-lg-6">
							<input type="text" id="idTelefonoDelivery" placeholder="Teléfono">
							<div class="alert-message" id="telefonoError"></div>
						</div>
					</div>
	  				
					
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

<!--<script src="https://checkout.culqi.com/js/v3"></script>-->

@if ($_SERVER['SERVER_NAME'] == "localhost")
    <script src="{{url('js/jquery/jquery-3.0.0.min.js')}}"></script>
    <script src="{{url('estilo/bootstrap4/bootstrap.min.js')}}"></script>
	<script src="{{url('js/producto/iniciar.js')}}"></script>
@else
<script src="https://comparadordeventas.com/pagolibre/public/js/jquery/jquery-3.0.0.min.js"></script>
<script src="https://comparadordeventas.com/pagolibre/public/estilo/bootstrap4/bootstrap.min.js"></script>
<script src="https://comparadordeventas.com/pagolibre/public/js/producto/iniciar.js"></script>
@endif


<script type="text/javascript">

</script>

</body>
</html>