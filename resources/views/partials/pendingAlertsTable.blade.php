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
        @foreach($pending_alerts as $pending_alert)
            <tr>
                <td>{{ $pending_alert->id }}</td>
                <td>{{ $pending_alert->title }}</td>
                <td>{{$pending_alert->title}}</td>
                <td>{{$pending_alertlert->message}}</td>
                <!-- Colored Type -->
                <td>
                        <span class="badge
                            {{ $pending_alert->type == 'warning' ? 'badge-warning' : '' }}
                            {{ $pending_alert->type == 'critical' ? 'badge-danger' : '' }}
                            {{ $pending_alert->type == 'info' ? 'badge-info' : '' }}">
                            {{ ucfirst($pending_alert->type) }}
                        </span>
                </td>

                <td>{{ $pending_alert->location }}</td>
                <td>
                    <span class="badge">
                        {{ $pending_alert->severity == 'high' ? 'badge-warning' : '' }}
                        {{ $pending_alert->severity == 'medium' ? 'badge-danger' : '' }}
                        {{ $pending_alert->severity == 'low' ? 'badge-info' : '' }}">
                        {{ ucfirst($pending_alert->severity) }}
                    </span>
                </td>
                <td>{{$pending_alert->risk_score}}</td>
                <td>{{ $pending_alert->created_at->diffForHumans() }}</td>
                <td>{{$pending_alert->status}}</td>
                <td>
                    <form method="POST" action="{{ route('admin.alerts.pending_alert_delete', $pending_alert->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete">Delete</button>
                    </form>
                </td>
                <td>
                    <form method="POST" action="{{}}">
                        @csrf
                        @method('APPROVE')
                        <button class="btn-success">Approve</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
