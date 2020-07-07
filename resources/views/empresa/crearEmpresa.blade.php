@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Crear Empresas</div>

                <div class="card-body">
                    
                @if ($_SERVER['SERVER_NAME'] == "localhost")
                    <form method="POST" action="">
                    <?php $urlListado = "listar";?>
                @else
                    <form action="https://comparadordeventas.com/pagolibre/public/empresa/grabar" method="POST">
                        <?php $urlListado = "https://comparadordeventas.com/pagolibre/public/empresa/listar";?>
                @endif
                        <a href="{{$urlListado}}" class="btn btn-success mb-3">Listado</a>
                        @csrf

                        <div class = "row mb-3">
                            <div class="col-sx-12 col-md-12 col-lg-2">
                                <label class="input-group-text" for="idRucEmpresa">Ruc:</label>
                            </div>
                            <div class="col-sx-12 col-md-12 col-lg-10">
                                <input type="number" name = "nameEmpresaRuc" class="form-control" minlength = "11" maxlength = "11">
                            </div>
                        </div>
                        
                        <div class = "row mb-3">
                            <div class="col-sx-12 col-md-12 col-lg-2">
                                <label class="input-group-text" for="idRucEmpresa">Razón Social:</label>
                            </div>
                            <div class="col-sx-12 col-md-12 col-lg-10">
                                <input type="text" name = "nameEmpresaRazonSocial" class="form-control" minlength = "1" maxlength = "50">
                            </div>
                        </div>

                        <div class = "row mb-3">
                            <div class="col-sx-12 col-md-12 col-lg-2">
                                <label class="input-group-text" for="idEmpresaNombre">Nombre:</label>
                            </div>
                            <div class="col-sx-12 col-md-12 col-lg-10">
                                <input type="text" name = "nameEmpresaNombre" class="form-control" minlength = "1" maxlength = "50">
                            </div>
                        </div>

                        <div class = "row mb-3">
                            <div class="col-sx-12 col-md-12 col-lg-2">
                                <label class="input-group-text" for="idEmpresaNombreComecial">Nombre Comercial:</label>
                            </div>
                            <div class="col-sx-12 col-md-12 col-lg-10">
                                <input type="text" name = "nameEmpresaNombreComecial" class="form-control" minlength = "1" maxlength = "50">
                            </div>
                        </div>

                        <div class = "row mb-3">
                            <div class="col-sx-12 col-md-12 col-lg-2">
                                <label class="input-group-text" for="idEmpresaNumeroCuenta">Num de Cuenta:</label>
                            </div>
                            <div class="col-sx-12 col-md-12 col-lg-10">
                                <input type="text" name = "nameEmpresaNumeroCuenta" class="form-control" minlength = "1" maxlength = "50">
                            </div>
                        </div>

                        <div class = "row mb-3">
                            <div class="col-sx-12 col-md-12 col-lg-2">
                                <label class="input-group-text" for="idEmpresaTelefono">Teléfono:</label>
                            </div>
                            <div class="col-sx-12 col-md-12 col-lg-10">
                                <input type="text" name = "nameEmpresaTelefono" class="form-control" minlength = "1" maxlength = "50">
                            </div>
                        </div>

                        <div class = "row mb-3">
                            <div class="col-sx-12 col-md-12 col-lg-2">
                                <label class="input-group-text" for="idEmpresaDireccion">Dirección:</label>
                            </div>
                            <div class="col-sx-12 col-md-12 col-lg-10">
                                <input type="text" name = "nameEmpresaDireccion" class="form-control" minlength = "1" maxlength = "50">
                            </div>
                        </div>

                        <div class = "row mb-3">
                            <div class="col-sx-12 col-md-12 col-lg-2">
                                <label class="input-group-text" for="idEmpresaRepresentante">Representante:</label>
                            </div>
                            <div class="col-sx-12 col-md-12 col-lg-10">
                                <input type="text" name = "nameEmpresaRepresentante" class="form-control" minlength = "1" maxlength = "50">
                            </div>
                        </div>

                        <div class = "row mb-3">
                            <div class="col-sx-12 col-md-12 col-lg-2">
                                <label class="input-group-text" for="idEmpresaRepresentante">Estado:</label>
                            </div>
                            <div class="col-sx-12 col-md-12 col-lg-10">
                                <input type="text" name = "nameEmpresaRepresentante" class="form-control" minlength = "1" maxlength = "50">
                            </div>
                        </div>
                        <div class = "row mb-3">
                            <div class="col-sx-12 col-md-12 col-lg-2">
                                <label class="input-group-text" for="idEmpresaEstadoId">Año:</label>
                            </div>
                            <div class="col-sx-12  col-md-12 col-lg-2">
                                <select name = "selectEmpresaEstadoId" class="custom-select">
                                    <option value = "1">Activo</option>
                                    <option value = "2">Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class = "row">
                            <button type="submit">Guardar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
