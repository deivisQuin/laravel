@extends('layouts.app')

@section('content')

<?php 
    $montoDepositarAcumulado = 0;
    $comisionAcumulado = 0;
    $montoAcumulado = 0;
?>

<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong style='color:#28a745'>Detalle del Pedido</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="idContenidoModal">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                </div>

                <div class="card-body">
                    <div class="col-sm-12 col-md-12 col-xl-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Num Pedido</th>
                                    <th>Monto Realizado</th>
                                    <th>Entregado</th>
                                    <th>Contraseña</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($aTransaccion as $venta) 
                                <?php 
                                    $colorEstado = ($venta->transaccionEstadoId == 2) ? "red": "green";
                                    $colorComercioEstado = ($venta->transaccionComercioEstado == 1) ? "red": "blue";
                                    $colorClienteEstado = ($venta->transaccionClienteEstado == 1) ? "red": "blue";
                                    $montoDepositarAcumulado += $venta->transaccionPasarelaMontoDepositar;
                                    $comisionAcumulado += $venta->transaccionPasarelaComision;
                                    $montoAcumulado += $venta->transaccionMonto;
                                ?>
                                <tr class="claseTr" id="{{$venta->transaccionId}}">
                                    <td>{{$venta->transaccionFechaCrea}}</td>
                                    <td>{{str_pad($venta->transaccionId, 4, "0", STR_PAD_LEFT)}}</td>
                                    <td>{{$venta->transaccionMonto}}</td>
                                    <td><span style="color:<?php echo $colorComercioEstado;?>"><strong>{{($venta->transaccionComercioEstado == 1) ? "PENDIENTE" : "OK" }}</strong></span></td>
                                    <td>{{$venta->transaccionComercioPassword}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th>{{number_format($montoDepositarAcumulado,2,".","")}}</th>
                                    <th>{{number_format($montoAcumulado,2,".","")}}</th>
                                </tr>
                            </tfoot>
                        </table>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    @if ($_SERVER['SERVER_NAME'] == "localhost")
        <script src="{{url('js/empresa/listarTransaccion.js')}}"></script>
    @else
        <script src="https://comparadordeventas.com/pagolibre/public/js/empresa/listarTransaccion.js"></script>
    @endif
@endsection
