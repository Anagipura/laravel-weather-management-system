<div class="table-container">
    <table class="user-table" id="userTable">
        <thead>
            <tr>
                <td>User ID</td>
                <td>User name</td>
                <td>Email</td>
                <td>Role</td>
                <td>Status</td>
                <td>Joined</td>
                <td>Actions</td>
            </tr>
        </thead>

        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                @if($user->is_admin == 1 || $user->is_admin == TRUE) {
                    <td>admin</td>
                }@else
                    <td>user</td>
                @endif
                <td>
                    <span class="badge"
                        {{$user->status == 'active' ? 'badge-success' : ''}}
                        {{$user->status == 'blocked' ? 'badge-danger' : ''}}>
                        {{ ucfirst($user->status) }}
                    </span>
                </td>
                <td>{{$user->created_at->diffForHumans()}}</td>
                <td>
                    <div class="action-container">
                        <form action="#" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn-delete">Delete</button>
                        </form>
                        <form method="POST" action="{{ route('admin.users.toggleUser', $user->id) }}">
                            @csrf
                            @method('PATCH')

                            <button class="btn-toggle">
                                {{ $user->status == 'active' ? 'Block' : 'Activate' }}
                            </button>
                        </form>
                    </div>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
