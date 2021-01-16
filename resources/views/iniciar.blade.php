<html>
<head>
    <title>Pago Libre</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	@if ($_SERVER['SERVER_NAME'] == "localhost")
		<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
		<link rel="stylesheet" href="{{url('/estilo/bootstrap4/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{url('/estilo/css/all.min.css')}}">
	@else
		<link rel="shortcut icon" href="https://comparadordeventas.com/pagolibre/public/favicon.ico">
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

<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong style='color:#28a745'><div id="idModalTitulo"></div></strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<div class="row">
		  <div class="col-md-12" >
	  		<strong><span id="idSpanProductoNombreExtenso"></span></strong>
		  </div>
		</div><br>
	  	<div class="row">
		  <div class="col-md-12" id="idContenidoModal"></div>
		</div>
      </div>
      <div class="modal-footer">
		<div class="container">
			<div class="row">
			<div class="col-xs-4"><button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button></div>
			<div class="col-xs-8 ml-auto"></div>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="idDivModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong style='color:#28a745'><div id="idModalTitulo">Disponemos de las siguientes salsas</div></strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
	  	<div class="row">
		  <div class="col-md-12" id="idCuerpoModal"></div>
		</div>
      </div>
      <div class="modal-footer">
		<div class="container">
			<div class="row">
			<div class="col-xs-4"><button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button></div>
			<div class="col-xs-8 ml-auto"></div>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>

<!-- Modal que muestra mensaje que el local está fuera del horario de atención -->
<div class="modal fade" id="idDivModalLocalSinAtencion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<div id="idDivTituloLocalSinAtencion"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
	  	<div class="row">
		  <div class="col-md-12" id="idCuerpoModalLocalSinAtenciion">
	  			<div id="idDivMensajeLocalSinAtencion"></div>
		  		<strong style='color:#28a745'>Si tuviera alguna consulta por favor comuníquese con nosotros al área de Soporte-Pagolibre al 993083387 </strong></div>
		</div>
      </div>
      <div class="modal-footer">
		<div class="container">
			<div class="row">
			<div class="col-xs-4"><button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button></div>
			<div class="col-xs-8 ml-auto"></div>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>

<!-- Modal que muestra mensaje que el local no tiene habilitado realizar delivery -->
<div class="modal fade" id="idDivModalLocalSinDeliveryHabilitado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<div id="idDivTituloLocalSinDeliveryHabilitado"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
	  	<div class="row">
		  <div class="col-md-12" id="idCuerpoModalLocalSinDeliveryHabilitado">
	  			<div id="idDivMensajeLocalSinDeliveryHabilitado"></div>
		  		<strong style='color:#28a745'>Si tuviera alguna consulta por favor comuníquese con nosotros al área de Soporte-Pagolibre al 993083387 </strong></div>
		</div>
      </div>
      <div class="modal-footer">
		<div class="container">
			<div class="row">
			<div class="col-xs-4"><button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button></div>
			<div class="col-xs-8 ml-auto"></div>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="idDivModalElegirSalsa" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong style='color:#28a745'><div id="idModalTitulo">Elegir sus cremas</div></strong></h5>
      </div>
      <div class="modal-body" >
	  	<div class="row">
		  <div class="col-md-12" id="idCuerpoModalElegirSalsa"></div>
		</div>
      </div>
      <div class="modal-footer">
		<div class="container">
			<div class="row">
			<div class="col-xs-8 "><button type="button" class="btn btn-primary" id="idBotonGrabarSalsa" data-dismiss="modal">Confirmar</button></div>
			<div class="col-xs-4 ml-auto"></div>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>

<div class="container panel panel-default">
	<div class="card">
		<div class="card-header">
	  		<div class="row">
			  	<div class="col-md-12  fixed-top">
				  <div class="row">
					<strong class="h2"><span class="badge badge-danger">Total S/.  </span><span id="idSpanMontoTotal" class="badge badge-danger"></span>
					<button id="idBotonPagarCabecera" class="claseBotonEnviar btn btn-success"><i class="fas fa-credit-card"></i><span class="badge badge-success h1">REALIZAR PAGO</span></button></strong>
					
					<input type="hidden" id="idHiddenPrecioTotal" value="">
					<input type="hidden" id="idHiddenDescripcion" value="">
					<input type="hidden" id="idHiddenSalsa" value="">
					<input type="hidden" id="idHiddenMontoTotal" value="">
					
				  </div>
				  <div class="row">
					<div id="idDivMensajeCabeceraError" class="col-md-12">
						<strong class="h5"><span class="badge badge-danger h2" id="idSpanMensajeCabeceraError"></span></strong>
					</div>
				  </div>
				</div>
			  <div class="col-md-8">
			  	<h2 class="panel-heading" style="color:#071619"><strong>Pago Libre</strong></h2>
			  </div>
			  <div class="col-md-4" align="right" style="position:relative;padding-bottom: 0px;bottom: 0px;top: 15px;">
	  			<div style="position:absolute; bottom:1px; right:10px;"><strong  style='color:#dc3545; '>Consultas al 993083387</strong>
				  </div>
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

			<form id="myForm" method="POST" action="validacionFormulario" style="font-size: calc(0.6em + 1vw)">
				<input type="hidden" id="idHiddenToken" name="_token" value="{{ csrf_token() }}">
				<br>
				<div class="form-group">
		            <h4 style='color:#28a745'><strong>{{$oEmpresa->empresaNombreComecial}}</strong></h4>
		        </div>
				<div class="form-group">
	  				<textarea name="nameComentario" id="idComentario" cols="30" rows="2" placeholder="¿Cual es tu nombre y dirección?" class="form-control"></textarea>
					  <div class="alert-message" id="comentarioError"></div>
				</div>
				<div class="form-group">
					<strong>Nuestras Cremas:</strong><br>
					<button type ="button" class="btn btn-primary" id="idBotonElegirSalsa">Elegir sus Cremas</button>
					<br>
				</div>
				<div class="form-group">
	  				<div class="row">
						<div class="col-sx-12 col-md-12 col-lg-3" {{$mostrarLocales}} >
							<select name="nameSelectLocal" id="idSelectLocal" class="form-control" style="font-size: calc(0.6em + 0.6vw)">
								<option value="0">Elegir Tu Local</option>
								@foreach($aLocal as $local)
									<option value="{{$local->localId}}" <?php if(count($aLocal)==1){?>selected="selected"<?php } ?>>{{$oEmpresa->empresaNombreComecial}} {{$local->localNombre}}</option>
								@endforeach
							</select>
							<div class="alert-message" id="localError"></div>
						</div>

	  					<div class="col-sx-12 col-md-12 col-lg-3">
							<select name="nameSelectDelivery" id="idSelectDelivery" class="form-control" style="font-size: calc(0.6em + 0.6vw)">
								<option value="1">Delivery</option>
								<option value="2">Recojo en Local</option>
							</select>  
						</div>
						<div class="col-sx-12 col-md-12 col-lg-3">
							<input type="text" id="idTelefonoDelivery" placeholder="Teléfono de Contacto" class="form-control" style="font-size: calc(0.6em + 0.6vw)">
							<div class="alert-message" id="telefonoError"></div>
						</div>
						<div class="col-sx-12 col-md-12 col-lg-3">
							<input type="hidden" id="idHiddenPrecioDelivery" value="">
							<div id="idDivLocalUbigeo">
								<select name="nameLocalUbigeo" id="idSelectLocalUbigeo" class="form-control" style="font-size: calc(0.6em + 0.6vw)">
									<option value="0">Distrito de Entrega</option>
									@foreach($aLocalUbigeoDelivery as $localUbigeo)
										<option value="{{$localUbigeo->LUId}}">{{$localUbigeo->ubigeo->ubigeoNombre}} : {{$localUbigeo->LUPrecioDelivery}}</option>
									@endforeach
								</select>
								<div class="alert-message" id="distritoError"></div>
							</div>
						</div>
					</div>
				</div>

		        <div class="form-group">
		            <input type="hidden" name="empresaRuc" class="form-control required"  id="empresaRucId" value="{{$oEmpresa->empresaRuc}}">
					<input type="hidden" name="empresaEmail" class="form-control required"  id="empresaEmailId" value="{{$oEmpresa->empresaEmail}}">
		        </div>

				<div class="row">
					<div class="col">
	  					<div id="idDivListadoProducto" class="form-group">
							<input type="hidden" name="indLocalAtendiendo" class="form-control required"  id="idIndLocalAtendiendo" value="{{$indLocalAtendiendo}}">
							<input type="hidden" name="localHoraApertura" class="form-control required"  id="idLocalHoraApertura" value="{{$local->localHoraApertura}}">
							<input type="hidden" name="localHoraCierre" class="form-control required"  id="idLocalHoraCierre" value="{{$local->localHoraCierre}}">
							<input type="hidden" name="localNombre" class="form-control required"  id="idLocalNombre" value="{{$local->localNombre}}">
							<input type="hidden" name="indLocalDeliveryHabilitado" class="form-control required"  id="idIndLocalDeliveryHabilitado" value="{{$indLocalDeliveryHabilitado}}">
							<table class="table table-hover" style="font-size: calc(0.6em + 0.6vw)">
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
										<td class="claseTdProducto" trProductoImagen="{{$producto->LLSPImagen}}" trProductoNombre="{{$producto->producto->productoNombre}}" 
											trProductoNombreExtenso="{{$producto->producto->productoNombreExtenso}}">
										<span id="idSpanProductoNombre_{{$producto->producto->productoId}}">{{$producto->producto->productoNombre}}</span>
										<input type="hidden" id="idHiddenProductoNombre_{{$producto->producto->productoId}}" value="">
										</td>
										<td class="claseTdProducto" trProductoImagen="{{$producto->LLSPImagen}}" trProductoNombre="{{$producto->producto->productoNombre}}" 
											trProductoNombreExtenso="{{$producto->producto->productoNombreExtenso}}">
											<span id="idSpanProductoPrecio_{{$producto->producto->productoId}}">{{$producto->LLSPPrecio}}</span>
											<input type="hidden" id="idHiddenProductoPrecio_{{$producto->producto->productoId}}" value="">
										</td>
										<td>
											<select id="idSelectCantidad_{{$producto->producto->productoId}}" 
												idProducto="{{$producto->producto->productoId}}" idSublineaId="{{$producto->LLSPSublineaId}}" class="claseSelectCantidad">
												<option value="0">0</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
											</select>
										</td>
										<td class="claseTdProducto" trProductoImagen="{{$producto->LLSPImagen}}" trProductoNombre="{{$producto->producto->productoNombre}}" 
											trProductoNombreExtenso="{{$producto->producto->productoNombreExtenso}}" align="right">
											<strong><span id="idSpanMonto_{{$producto->producto->productoId}}"></span></strong>
											<input type="hidden" id="idHiddenMonto_{{$producto->producto->productoId}}" class="claseHiddenMonto" value="">
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div> 
			</form>
			<div class="form-group">
				<button class="btn btn-success form-control claseBotonEnviar" id="enviarId"><i class="fas fa-credit-card"></i> REALIZAR PAGO</button>
			</div>
		</div>
	</div>
</div>

<script src="https://checkout.culqi.com/js/v3"></script>

@if ($_SERVER['SERVER_NAME'] == "localhost")
    <script src="{{url('js/jquery/jquery-3.0.0.min.js')}}"></script>
    <script src="{{url('estilo/bootstrap4/bootstrap.min.js')}}"></script>
	<script src="{{url('js/producto/iniciar.js?version=2')}}"></script>
@else
<script src="https://comparadordeventas.com/pagolibre/public/js/jquery/jquery-3.0.0.min.js"></script>
<script src="https://comparadordeventas.com/pagolibre/public/estilo/bootstrap4/bootstrap.min.js"></script>
<script src="https://comparadordeventas.com/pagolibre/public/js/producto/iniciar.js?version=2"></script>
@endif

</body>
</html>