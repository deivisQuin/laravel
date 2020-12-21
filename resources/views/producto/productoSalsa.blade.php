@foreach($aProducto as $producto)
    <?php $imagen = $producto['productoImagen'];?>
    @for($j = 1; $j <= $producto['productoCantidad']; $j++)
        <table id="{{$producto['productoId']}}_{{$j}}" class="table table-hover" style="font-size: calc(0.5em + 0.5vw)">
            <thead>
                <tr>
                    <th>Cant.</th>
                    <th>Producto</th>
                    <th>Salsas</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                    @if ($_SERVER['SERVER_NAME'] == "localhost")
                        <img src="{{url('/imagen/' . $empresaRuc . '/' . $imagen. '')}}" width="100" height="100">
                    @else
                        <img src="https://comparadordeventas.com/pagolibre/public/imagen/" . $empresaRuc . "/" . $imagen >
                    @endif
                    <br>
                    <strong>{{$producto['productoNombre']}}</strong>
                    </td>
                    <td>
                        @foreach($aSalsa as $salsa)
                            <input type="checkbox" class="checkElegirSalsa" id="{{$producto['productoId']}}_{{$j}}_{{$salsa['salsaId']}}" name="{{$salsa['salsaNombre']}}" 
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