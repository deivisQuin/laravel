@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><strong>{{isset($aEmpresa) ? "Editar Empresa" : "Crear Empresa" }}</strong></div>

                <div class="card-body">
                @if(Session::has("success"))
                    <div class="alert alert-success">
                        {{Session::get("success")}}
                    </div>
                @endif

                @if ($errors->any())
                    <!--<div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>-->
                @endif
                    
                @if ($_SERVER['SERVER_NAME'] == "localhost")
                     <?php  $urlListado = url('empresa/listar') ?>
                    @if(isset($aEmpresa))
                        <form method="POST" action="{{url('/empresa/' . $aEmpresa['empresaId'])}}">
                        @else
                            <form method="POST" action="{{url('empresa/')}}">
                    @endif
                @else
                    <?php $urlListado = "https://comparadordeventas.com/pagolibre/public/empresa/listar";?>
                    @if(isset($aEmpresa))
                        <form action="https://comparadordeventas.com/pagolibre/public/empresa/$aEmpresa['empresaId']" method="POST">
                        @else
                            <form action="https://comparadordeventas.com/pagolibre/public/empresa/" method="POST">
                    @endif
                @endif
                        <a href="{{$urlListado}}" class="btn btn-success mb-3">Listado</a>
                        
                        @csrf
                        @if(isset($aEmpresa))
                            {{method_field("PUT")}}
                        @endif

                        <div class = "row mb-3">
                            <div class="col-sx-12 col-md-12 col-lg-2">
                                <label class="input-group-text" for="forRucEmpresa">Ruc:</label>
                            </div>
                            <div class="col-sx-12 col-md-12 col-lg-10">
                                <input type="number" name = "empresaRuc" value="{{isset($aEmpresa) ? $aEmpresa['empresaRuc'] : old('empresaRuc')}}" class="form-control" minlength = "11" maxlength = "11">
                                {!! $errors->first("empresaRuc", "<small class='text-danger'>:message</small><br>")!!}
                            </div>                            
                                
                        </div>
                        
                        <div class = "row mb-3">
                            <div class="col-sx-12 col-md-12 col-lg-2">
                                <label class="input-group-text" for="forEmpresaRazonSocial">Razón Social:</label>
                            </div>
                            <div class="col-sx-12 col-md-12 col-lg-10">
                                <input type="text" name = "empresaRazonSocial" value="{{isset($aEmpresa) ? $aEmpresa['empresaRazonSocial'] : old('empresaRazonSocial')}}" class="form-control" minlength = "1" maxlength = "50">
                                {!! $errors->first("empresaRazonSocial", "<small class='text-danger'>:message</small><br>")!!}
                            </div>
                        </div>

                        <div class = "row mb-3">
                            <div class="col-sx-12 col-md-12 col-lg-2">
                                <label class="input-group-text" for="forEmpresaNombreComecial">Nombre Comercial:</label>
                            </div>
                            <div class="col-sx-12 col-md-12 col-lg-10">
                                <input type="text" name = "empresaNombreComecial" value="{{isset($aEmpresa) ? $aEmpresa['empresaNombreComecial'] : old('empresaNombreComecial')}}" class="form-control" minlength = "1" maxlength = "50">
                                {!! $errors->first("empresaNombreComecial", "<small class='text-danger'>:message</small><br>")!!}
                            </div>
                        </div>

                        <div class = "row mb-3">
                            <div class="col-sx-12 col-md-12 col-lg-2">
                                <label class="input-group-text" for="forEmpresaEmail">Email:</label>
                            </div>
                            <div class="col-sx-12 col-md-12 col-lg-10">
                                <input type="text" name = "empresaEmail" value="{{isset($aEmpresa) ? $aEmpresa['empresaEmail'] : old('empresaEmail')}}" class="form-control" minlength = "1" maxlength = "50">
                                {!! $errors->first("empresaEmail", "<small class='text-danger'>:message</small><br>")!!}
                            </div>
                        </div>

                        <div class = "row mb-3">
                            <div class="col-sx-12 col-md-12 col-lg-2">
                                <label class="input-group-text" for="forEmpresaNumeroCuenta">Num de Cuenta:</label>
                            </div>
                            <div class="col-sx-12 col-md-12 col-lg-10">
                                <input type="text" name = "empresaNumeroCuenta" value="{{isset($aEmpresa) ? $aEmpresa['empresaNumeroCuenta'] : old('empresaNumeroCuenta')}}" class="form-control" minlength = "10" maxlength = "50">
                                {!! $errors->first("empresaNumeroCuenta", "<small class='text-danger'>:message</small><br>")!!}
                            </div>
                        </div>

                        <div class = "row mb-3">
                            <div class="col-sx-12 col-md-12 col-lg-2">
                                <label class="input-group-text" for="forEmpresaTelefono">Teléfono:</label>
                            </div>
                            <div class="col-sx-12 col-md-12 col-lg-10">
                                <input type="text" name = "empresaTelefono" value="{{isset($aEmpresa) ? $aEmpresa['empresaTelefono'] : old('empresaTelefono')}}" class="form-control">
                            </div>
                        </div>

                        <div class = "row mb-3">
                            <div class="col-sx-12 col-md-12 col-lg-2">
                                <label class="input-group-text" for="idEmpresaDireccion">Dirección:</label>
                            </div>
                            <div class="col-sx-12 col-md-12 col-lg-10">
                                <input type="text" name = "empresaDireccion" value="{{isset($aEmpresa) ? $aEmpresa['empresaDireccion'] : old('empresaDireccion')}}" class="form-control" >
                            </div>
                        </div>

                        <div class = "row mb-3">
                            <div class="col-sx-12 col-md-12 col-lg-2">
                                <label class="input-group-text" for="forEmpresaRepresentante">Representante:</label>
                            </div>
                            <div class="col-sx-12 col-md-12 col-lg-10">
                                <input type="text" name = "empresaRepresentante" value="{{isset($aEmpresa) ? $aEmpresa['empresaRepresentante'] : old('empresaRepresentante')}}" class="form-control" minlength = "1" maxlength = "50">
                                {!! $errors->first("empresaRepresentante", "<small class='text-danger'>:message</small><br>")!!}
                            </div>
                        </div>

                        <div class = "row mb-3">
                            <div class="col-sx-12 col-md-12 col-lg-2">
                                <label class="input-group-text" for="forEmpresaUsersId">Usuario:</label>
                            </div>
                            <div class="col-sx-12 col-md-12 col-lg-10">
                                <input type="number" name = "empresaUsersId" value="{{isset($aEmpresa) ? $aEmpresa['empresaUsersId'] : old('empresaUsersId')}}" class="form-control" minlength = "1" maxlength = "10">
                                {!! $errors->first("empresaUsersId", "<small class='text-danger'>:message</small><br>")!!}
                            </div>
                        </div>

                        <div class = "row mb-3">
                            <div class="col-sx-12 col-md-12 col-lg-2">
                                <label class="input-group-text" for="forEmpresaEstadoId">Estado:</label>
                            </div>
                            <div class="col-sx-12  col-md-12 col-lg-2">
                                <select name = "empresaEstadoId" class="custom-select">
                                    <option value = "1" <?php echo (isset($aEmpresa) && ($aEmpresa['empresaEstadoId'] == 1)) ?  'selected' : '';?>>Activo</option>
                                    <option value = "2" <?php echo (isset($aEmpresa) && ($aEmpresa['empresaEstadoId'] == 2)) ?  'selected' : '';?>>Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class = "row">
                            <button type="submit" class="btn btn-primary">{{isset($aEmpresa) ? "Modificar" : "Guardar"}}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
