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
                trProductoIngrediente= "{{$producto->producto->productoIngrediente}}">
            <span id="idSpanProductoNombre_{{$producto->producto->productoId}}">{{$producto->producto->productoNombre}}</span>
            <input type="hidden" id="idHiddenProductoNombre_{{$producto->producto->productoId}}" value="">
            </td>
            <td class="claseTdProducto" trProductoImagen="{{$producto->LLSPImagen}}" trProductoNombre="{{$producto->producto->productoNombre}}" 
                trProductoIngrediente= "{{$producto->producto->productoIngrediente}}">
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
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
            </td>
            <td class="claseTdProducto" trProductoImagen="{{$producto->LLSPImagen}}" trProductoNombre="{{$producto->producto->productoNombre}}"
                trProductoIngrediente="{{$producto->producto->productoIngrediente}}" align="right">
                <strong><span id="idSpanMonto_{{$producto->producto->productoId}}"></span></strong>
                <input type="hidden" id="idHiddenMonto_{{$producto->producto->productoId}}" class="claseHiddenMonto" value="">
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@if ($_SERVER['SERVER_NAME'] == "localhost")
	<script src="{{url('js/producto/productoLocalPartial.js?version=1')}}"></script>
@else
    <script src="https://comparadordeventas.com/pagolibre/public/js/producto/productoLocalPartial.js?version=2"></script>
@endif