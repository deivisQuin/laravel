@if(!isset($aTransaccion))
    No hay Detalle de la transacción.
@else
    <table>
        <thead>
            <tr>
                <th></th>
                <th>Datos</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Detalle</strong></td>
                <td>{{$aTransaccion->transaccionDescripcion}}</td>
            </tr>
            <tr>
                <td><strong>Monto a Recibir</strong></td>
                <td>{{$aTransaccion->transaccionPasarelaMontoDepositar}}</td>
            </tr>
            <tr>
                <td><strong>Descuento</strong></td>
                <td>{{$aTransaccion->transaccionPasarelaComision}}</td>
            </tr>
            <tr>
                <td><strong>Monto Realizado</strong></td>
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