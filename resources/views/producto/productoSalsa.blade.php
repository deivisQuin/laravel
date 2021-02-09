@foreach($aProducto as $producto)
    <?php $imagen = $producto['productoImagen'];?>
    @for($j = ($numElementosEncontrados + 1); $j <= $producto['productoCantidad']; $j++)
        <table id="{{$producto['productoId']}}_{{$j}}" class="table table-hover table_{{$producto['productoId']}}" style="font-size: calc(0.5em + 0.5vw)">
            <thead>
                <tr>
                    <th tyle="width:5%">Cant.</th>
                    <th tyle="width:60%">Producto</th>
                    <th tyle="width:35%">Salsas</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width:5%">1</td>
                    <td style="width:60%">
                    @if ($_SERVER['SERVER_NAME'] == "localhost")
                        <img src="{{url('/imagen/' . $empresaRuc . '/' . $imagen. '')}}" width="100" height="100">
                    @else
                        <img src="https://comparadordeventas.com/pagolibre/public/imagen/{{$empresaRuc}}/{{$imagen}}" width="100" height="100">
                    @endif
                    <br>
                    <strong>{{$producto['productoNombre']}}</strong>
                    <br>
                        
                        <div><?php echo $producto['productoIngrediente']; ?></div>
                    </td>
                    <td style="width:35%">
                        <input type="checkbox" class="checkElegirSalsa" id="{{$producto['productoId']}}_{{$j}}_0" name="Sin_Cremas" 
                                check_productoNombre="{{$producto['productoNombre']}}" check_productoId="{{$producto['productoId']}}" check_salsaNombre="Sin Cremas" 
                                check_orden="{{$j}}" value="Bike" checked>
                            <label for="salsa" style="color:blue"><strong>Sin Cremas</strong></label><br>

                        @foreach($aSalsa as $salsa)
                            <input type="checkbox" class="checkElegirSalsa claseCheck_{{$producto['productoId']}}_{{$j}}" id="{{$producto['productoId']}}_{{$j}}_{{$salsa['salsaId']}}" name="{{$salsa['salsaNombre']}}" 
                                check_productoNombre="{{$producto['productoNombre']}}" check_productoId="{{$producto['productoId']}}" check_salsaNombre="{{$salsa['salsaNombre']}}" 
                                check_orden="{{$j}}" value="Bike">
                            <label for="salsa"><strong>{{$salsa['salsaNombre']}}</strong></label><br>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
    @endfor
@endforeach

@if ($_SERVER['SERVER_NAME'] == "localhost")
	<script src="{{url('js/producto/productoSalsa.js?version=2')}}"></script>
@else
    <script src="https://comparadordeventas.com/pagolibre/public/js/producto/productoSalsa.js?version=2"></script>
@endif