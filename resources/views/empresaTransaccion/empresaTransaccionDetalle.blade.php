@if(!isset($aTransaccion))
    No hay Detalle de la transacción.
@else
    <table style="font-size: calc(0.6em + 0.3vw)">
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
                <td colspan="2">
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
                </td>
            </tr>
            <tr>
                <td><strong style='color:#28a745'>Salsas</strong></td>
                <td style="background:#00f191"><?php echo $aTransaccion->transaccionDescripcion;?></td>
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
                <td><strong style='color:#28a745'>Comentario</strong></td>
                <td><textarea rows="4" cols="30">{{$aTransaccion->orden->ordenComentario}}</textarea></td>
            </tr>
            <tr>
                <td><strong style='color:#28a745'>Monto a Recibir</strong></td>
                <td align="right"><strong>{{$aTransaccion->transaccionComercioMontoDepositar}}</strong></td>
            </tr>
        </tbody>
        <tfoot>
            <?php if ($aTransaccion->transaccionComercioEstado == 1) { ?>
            <tr>
                <th><button type="button" class="btn btn-primary claseEntregarPedido" id="idBotonEntregarPedido_{{$aTransaccion->transaccionId}}" >Pedido Entregado</button></th>
                
            </tr>
            <?php } ?>
        </tfoot>
    </table>
@endif