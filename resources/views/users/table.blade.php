<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->type}}</td>
            <td>
                <a href="{{route('users.edit',$user->id)}}" type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float">
                    <i class="material-icons">edit</i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div style="text-align:center;">
    {{ $users->links() }}
</div>