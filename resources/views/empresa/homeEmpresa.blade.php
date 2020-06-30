@extends('layouts.app')

@section('content')
<?php
$fechaActual = getdate();
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <form name="formularioEmpresa" method="POST" action="transaccion/ventasEmpresa">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-sx-12 col-md-12 col-lg-2">
                                <label class="input-group-text" for="idSelectEmpresa">Empresa:</label>
                            </div>
                            <div class="col-sx-12 col-md-12 col-lg-10">
                                <select name = "selectEmpresa" id = "idSelectEmpresa" class="custom-select">
                                    <option value = "">Seleccione Empresa</option>
                                    @foreach($aEmpresa as $empresa)
                                        <option value = "{{$empresa->empresaId}}">{{$empresa->empresaNombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                            
                        <div class="row">
                            <div class="col-sx-12 col-md-12 col-lg-2">
                                <label class="input-group-text" for="idAnio">Año:</label>
                            </div>
                            <div class="col-sx-12  col-md-12 col-lg-2">
                                <select name = "selectAnio" id = "idAnio" class="custom-select">
                                    <option value = "2020" <?php echo ($fechaActual["year"] == "2020") ? "selected" : "" ;?>>2020</option>
                                    <option value = "2021" <?php echo ($fechaActual["year"] == "2021") ? "selected" : "" ;?>>2021</option>
                                </select>
                            </div>
                        

                        
                            <div class="col-sx-12 col-md-12 col-lg-2">
                                <label class="input-group-text" for="idMes">Mes:</label>
                            </div>
                            <div class="col-sx-12  col-md-12 col-lg-2">
                                <select name = "selectMes" id = "idMes" class="custom-select">
                                    <option value = "1" <?php echo ($fechaActual["mon"] == "1") ? "selected" : "" ;?>>Enero</option>
                                    <option value = "2" <?php echo ($fechaActual["mon"] == "2") ? "selected" : "" ;?>>Febrero</option>
                                    <option value = "3" <?php echo ($fechaActual["mon"] == "3") ? "selected" : "" ;?>>Marzo</option>
                                    <option value = "4" <?php echo ($fechaActual["mon"] == "4") ? "selected" : "" ;?>>Abril</option>
                                    <option value = "5" <?php echo ($fechaActual["mon"] == "5") ? "selected" : "" ;?>>Mayo</option>
                                    <option value = "6" <?php echo ($fechaActual["mon"] == "6") ? "selected" : "" ;?>>Junio</option>
                                    <option value = "7" <?php echo ($fechaActual["mon"] == "7") ? "selected" : "" ;?>>Julio</option>
                                    <option value = "8" <?php echo ($fechaActual["mon"] == "8") ? "selected" : "" ;?>>Agosto</option>
                                    <option value = "9" <?php echo ($fechaActual["mon"] == "9") ? "selected" : "" ;?>>Setiembre</option>
                                    <option value = "10" <?php echo ($fechaActual["mon"] == "10") ? "selected" : "" ;?>>Octubre</option>
                                    <option value = "11" <?php echo ($fechaActual["mon"] == "11") ? "selected" : "" ;?>>Noviembre</option>
                                    <option value = "12" <?php echo ($fechaActual["mon"] == "12") ? "selected" : "" ;?>>Diciembre</option>
                                </select>
                            </div>
                        

                        
                            <div class="col-sx-12  col-md-12 col-lg-2">
                                <label class="input-group-text" for="idDia">Día:</label>
                            </div>
                            <div class="col-sx-12  col-md-12 col-lg-2">
                                <select name = "selectDia" id = "idDia" class="custom-select">
                                    @for($i = 1; $i <= 31; $i++)
                                        <option value = "<?php echo $i;?>" <?php echo ($fechaActual["mday"] == $i) ? "selected" : "" ;?>><?php echo $i;?></option>
                                    @endfor
                                </select>
                            </div>
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
