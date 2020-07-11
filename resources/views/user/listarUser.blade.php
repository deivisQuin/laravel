@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Listado de Usuarios</div>

                <div class="card-body">
                    
                @if ($_SERVER['SERVER_NAME'] == "localhost")
                    <?php $urlCrearUser = url('register')?>
                    <?php $urlEditarUser = "editar";?>
                @else
                        <?php $urlCrearUser = "https://comparadordeventas.com/pagolibre/public/register";?>
                        <?php $urlEditarUser = "https://comparadordeventas.com/pagolibre/public/user/edit";?>
                @endif
                        <a href="{{$urlCrearUser}}" class="btn btn-success mb-3">Crear Usuario</a>
                        <div id = "idDivListadoUser" class = "col-sm-12 col-md-12 col-xl-12">
                        @if(!isset($aUser))
                            No hay Usuarios registrados
                            @else
                            <?php $num = 1;?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Num</th>
                                        <th>Identificador</th>
                                        <th>Email</th>
                                        <th>Rol</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($aUser as $user)
                                    <tr>
                                        <td>{{$num++}}</td>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->usersRolId}}</td>
                                        <!--
                                        <td>
                                        <a href="{{$user->id}}/{{$urlEditarUser}}" class="btn btn-primary"> Editar</a>
                                        </td>-->
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$aUser->links()}}
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
        <script src="{{url('js/user/listarUser.js')}}"></script>
    @else
        <script src="https://comparadordeventas.com/pagolibre/public/js/user/listarUser.js"></script>
    @endif
@endsection