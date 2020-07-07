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
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$aEmpresa->links()}}
@endif