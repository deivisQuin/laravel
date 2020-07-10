@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Listado de Empresas</div>

                <div class="card-body">
                    
                @if ($_SERVER['SERVER_NAME'] == "localhost")
                    <!--<form method="POST" action="{{ route('password.update') }}">-->
                    <?php $urlCrearEmpresa = "crear";?>
                    <?php $urlEditarEmpresa = "editar";?>
                @else
                    <!--<form action="https://comparadordeventas.com/pagolibre/public/password/reset" method="POST">-->
                        <?php $urlCrearEmpresa = "https://comparadordeventas.com/pagolibre/public/empresa/crear";?>
                        <?php $urlEditarEmpresa = "https://comparadordeventas.com/pagolibre/public/empresa/edit";?>
                @endif
                        <a href="{{$urlCrearEmpresa}}" class="btn btn-success mb-3">Crear Empresa</a>
                        <div id = "idDivListadoEmpresa" class = "col-sm-12 col-md-12 col-xl-12">
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
                                    <?php $colorEstado = ($empresa->empresaEstadoId == 1) ? "green": "red";?>
                                    <tr>
                                        <td>{{$num++}}</td>
                                        <td>{{$empresa->empresaRuc}}</td>
                                        <td>{{$empresa->empresaRazonSocial}}</td>
                                        <td><span style="color:<?php echo $colorEstado;?>"><strong>{{$empresa->estado->estadoNombre}}</strong></span></td>
                                        
                                        <td>
                                        <a href="{{$empresa->empresaId}}/{{$urlEditarEmpresa}}" class="btn btn-primary"> Editar</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$aEmpresa->links()}}
                        @endif
                        </div>

                    <!--</form>-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    @if ($_SERVER['SERVER_NAME'] == "localhost")
        <script src="{{url('js/empresa/listarEmpresa.js')}}"></script>
    @else
        <script src="https://comparadordeventas.com/pagolibre/public/js/empresa/listarEmpresa.js"></script>
    @endif
@endsection