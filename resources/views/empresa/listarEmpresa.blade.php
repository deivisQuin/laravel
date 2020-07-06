@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Listado de Empresas</div>

                <div class="card-body">
                @if ($_SERVER['SERVER_NAME'] == "localhost")
                    <form method="POST" action="{{ route('password.update') }}">
                @else
                    <form action="https://comparadordeventas.com/pagolibre/public/password/reset" method="POST">
                @endif

                        <div class="col-sm-12 col-md-12 col-xl-12">
                        @if(!isset($aEmpresa))
                            No hay Empresas registrado
                            @else
                            <?php $num = 1;?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Num</th>
                                        <th>RUC</th>
                                        <th>Razón Social</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($aEmpresa as $empresa) 
                                    <?php $colorEstado = ($empresa->empresaEstadoId == 1) ? "red": "green";?>
                                    <tr>
                                        <td>{{$num++}}</td>
                                        <td>{{$empresa->empresaRuc}}</td>
                                        <td>{{$empresa->empresaRazonSocial}}</td>
                                        
                                        <td><span style="color:<?php echo $colorEstado;?>"><strong>{{$empresa->estado->estadoNombre}}</strong></span></td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
                        @endif
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
