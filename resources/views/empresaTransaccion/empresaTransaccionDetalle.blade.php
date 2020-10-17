@if(!isset($aTransaccion))
    No hay Detalle de la transacción.
@else
    <table>
        <thead>
            <tr>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong style='color:#28a745'>Número de Pedido</strong></td>
                <td>{{str_pad($aTransaccion->transaccionOrdenId, 4, "0", STR_PAD_LEFT)}}</td>
            </tr>
            <tr>
                <td><strong style='color:#28a745'>Monto a Recibir</strong></td>
                <td align="right">{{$aTransaccion->transaccionPasarelaMontoDepositar}}</td>
            </tr>
            <tr>
                <td><strong style='color:#28a745'>Descuento</strong></td>
                <td align="right">{{$aTransaccion->transaccionMonto - $aTransaccion->transaccionPasarelaMontoDepositar}}</td>
            </tr>
            <tr>
                <td><strong style='color:#28a745'>Monto Realizado</strong></td>
                <td align="right">{{$aTransaccion->transaccionMonto}}</td>
            </tr>
            
            <tr>
                <td><strong style='color:#28a745'>Teléfono</strong></td>
                <td>{{$aTransaccion->orden->ordenTelefono}}</td>
            </tr>
            <tr>
                <td><strong style='color:#28a745'>Delivery</strong></td>
                <td>{{($aTransaccion->orden->ordenDelivery=="S") ? "SI" : "NO"}}</td>
            </tr>
            <tr>
                <div>
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        @foreach($aTransaccion->orden->orden_detalles as $detalle)
                        <tr>
                            <td>{{$detalle->producto->productoNombre}}</td>
                            <td align="right">{{$detalle->ODCantidad}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </tr>
            <tr>
                <td><strong style='color:#28a745'>Comentario</strong></td>
                <td>{{$aTransaccion->orden->ordenComentario}}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
            </tr>
        </tfoot>
    </table>
@endif