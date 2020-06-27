<?php 
    $montoDepositarAcumulado = 0;
    $comisionAcumulado = 0;
    $montoAcumulado = 0;
?>
        
        <div class="col-sm-12 col-md-12 col-xl-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Monto A Recibir</th>
                        <th>Descuento</th>
                        <th>Monto Realizado</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($aTransaccion as $venta) 
                    <?php 
                        $colorEstado = ($venta->transaccionEstadoId == 1) ? "red": "green";
                        $montoDepositarAcumulado += $venta->transaccionPasarelaMontoDepositar;
                        $comisionAcumulado += $venta->transaccionPasarelaComision;
                        $montoAcumulado += $venta->transaccionMonto;
                    ?>
                    <tr>
                        <td>{{$venta->transaccionFechaCrea}}</td>
                        <td>{{$venta->transaccionPasarelaMontoDepositar}}</td>
                        <td>{{$venta->transaccionPasarelaComision}}</td>
                        <td>{{$venta->transaccionMonto}}</td>
                        <td><span style="color:<?php echo $colorEstado;?>"><strong>{{$venta->estado->estadoNombre}}</strong></span></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total</th>
                        <th>{{number_format($montoDepositarAcumulado,2,".","")}}</th>
                        <th>{{number_format($comisionAcumulado,2,".","")}}</th>
                        <th>{{number_format($montoAcumulado,2,".","")}}</th>
                    </tr>
                </tfoot>
                
            </table>
        </div>
