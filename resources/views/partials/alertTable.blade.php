<div class="table-container">
    <table class="alert-table" id="alertTable">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Type</th>
            <th>Location</th>
            <th>Created</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        @foreach($alerts as $alert)
            <tr>
                <td>{{ $alert->id }}</td>
                <td>{{ $alert->title }}</td>

                <!-- Colored Type -->
                <td>
                        <span class="badge
                            {{ $alert->type == 'warning' ? 'badge-warning' : '' }}
                            {{ $alert->type == 'critical' ? 'badge-danger' : '' }}
                            {{ $alert->type == 'info' ? 'badge-info' : '' }}">
                            {{ ucfirst($alert->type) }}
                        </span>
                </td>

                <td>{{ $alert->location }}</td>
                <td>{{ $alert->created_at->diffForHumans() }}</td>

                <td>
                    <form method="POST" action="{{ route('admin.alerts.delete', $alert->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
