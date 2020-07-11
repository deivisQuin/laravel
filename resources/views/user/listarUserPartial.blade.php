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
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$aUser->links()}}
@endif