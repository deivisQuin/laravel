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
                <td><strong style='color:#28a745'>Detalle</strong></td>
                <td>{{$aTransaccion->transaccionDescripcion}}</td>
            </tr>
            <tr>
                <td><strong style='color:#28a745'>Monto a Recibir</strong></td>
                <td>{{$aTransaccion->transaccionPasarelaMontoDepositar}}</td>
            </tr>
            <tr>
                <td><strong style='color:#28a745'>Descuento</strong></td>
                <td>{{$aTransaccion->transaccionMonto - $aTransaccion->transaccionPasarelaMontoDepositar}}</td>
            </tr>
            <tr>
                <td><strong style='color:#28a745'>Monto Realizado</strong></td>
                <td>{{$aTransaccion->transaccionMonto}}</td>
            </tr>
            
        </tbody>
        <tfoot>
            <tr>
                <td></td>
            </tr>
        </tfoot>
    </table>
@endif