@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4><strong>Productos</strong></h4>
                </div>

                <div class="card-body">
                    <div class="col-sm-12 col-md-12 col-xl-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($aProducto as $producto) 
                                <?php 
                                    $claseBoton = ($producto->LLSPEstadoId == 1) ? "btn btn-primary" : "btn btn-danger";
                                    $nombreBoton = ($producto->LLSPEstadoId == 1) ? "ACTIVO" : "INACTIVO";
                                    $estadoIdNuevo = ($producto->LLSPEstadoId == 1) ? "2" : "1";
                                ?>
                                <tr>
                                    <td>{{$producto->productoNombre}}</td>
                                    <td class="claseTd" id="{{$producto->LLSPId}}" estadoIdNuevo="{{$estadoIdNuevo}}">
                                        <button class="{{$claseBoton}}">{{$nombreBoton}}</button></td>
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
