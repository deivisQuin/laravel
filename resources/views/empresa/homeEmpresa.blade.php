@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <form name="formularioEmpresa" method="POST" action="transaccion/ventasEmpresa">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="idSelectEmpresa">Empresa:</label>
                            </div>
                            <select name = "selectEmpresa" id = "idSelectEmpresa" class="custom-select">
                                <option value = "">Seleccione Empresa</option>
                                @foreach($aEmpresa as $empresa)
                                    <option value = "{{$empresa->empresaId}}">{{$empresa->empresaNombre}}</option>
                                @endforeach
                            </select>
                        </div>
                            
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="idAnio">Año:</label>
                            </div>
                            <select name = "selectAnio" id = "idAnio" class="custom-select">
                                <option value = "2020">2020</option>
                                <option value = "2021">2021</option>
                            </select>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="idMes">Mes:</label>
                            </div>
                            <select name = "selectMes" id = "idMes" class="custom-select">
                                <option value = "1">Enero</option>
                                <option value = "2">Febrero</option>
                                <option value = "3">Marzo</option>
                                <option value = "4">Abril</option>
                                <option value = "5">Mayo</option>
                                <option value = "6">Junio</option>
                                <option value = "7">Julio</option>
                                <option value = "8">Agosto</option>
                                <option value = "9">Setiembre</option>
                                <option value = "10">Octubre</option>
                                <option value = "11">Noviembre</option>
                                <option value = "12">Diciembre</option>
                            </select>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="idDia">Día:</label>
                            </div>
                            <select name = "selectDia" id = "idDia" class="custom-select">
                                @for($i = 1; $i <= 31; $i++)
                                    <option value = "<?php echo $i;?>"><?php echo $i;?></option>
                                @endfor
                            </select>
                        </div>

                    </form>
                    
                </div>

                <div class="card-body">
                    <div id="divVentasEmpresa">
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    @if ($_SERVER['SERVER_NAME'] == "localhost")
        <script src="{{url('js/empresa/homeEmpresa.js')}}"></script>
    @else
        <script src="https://comparadordeventas.com/pagolibre/public/js/empresa/homeEmpresa.js"></script>
    @endif
@endsection
