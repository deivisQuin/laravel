@extends('layouts.app')

@section('content')

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
                                    <th>Salsa</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($aSalsa as $salsa) 
                                <?php 
                                    $claseBoton = ($salsa->salsaEstadoId == 1) ? "btn btn-primary" : "btn btn-danger";
                                    $estadoIdNuevo = ($salsa->salsaEstadoId == 1) ? "2" : "1";
                                ?>
                                <tr>
                                    <td>{{$salsa->salsaNombre}}</td>
                                    <td class="claseTd" id="{{$salsa->salsaId}}" estadoIdNuevo="{{$estadoIdNuevo}}">
                                        <button class="{{$claseBoton}}">{{$salsa->estado->estadoNombre}}</button></td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
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
        <script src="{{url('js/producto/listarProducto.js')}}"></script>
    @else
        <script src="https://comparadordeventas.com/pagolibre/public/js/producto/listarProducto.js"></script>
    @endif
@endsection
