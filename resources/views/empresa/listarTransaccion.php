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
