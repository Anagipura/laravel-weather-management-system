<x-app-layout>
    <div class="admin-container">

        <!-- Header -->
        <div class="admin-header">
            <h1>Admin Dashboard</h1>

            <div class="admin-actions">
                <a href="{{ route('admin.alerts.create') }}" class="createAlert">+ Create Alert</a>
                <a href="{{ route('admin.risk.create') }}" class="createAlert">+ Add Risk Level</a>
                <a href="#" class="createAlert">Manage Donations</a>
                <a href="#" class="createAlert">User Management</a>
                <a href="#" class="createAlert">Resource Management</a>

            </div>
        </div>

        <!-- Cards Row -->
        <div class="stats-cards">
            <div class="stat-card">
                <h3>Total Alerts</h3>
                <p>{{ $alerts->count() }}</p>
            </div>

            <div class="stat-card">
                <h3>Risk Levels</h3>
                <p>{{ $riskLevels->count() }}</p>
            </div>
        </div>

        <!-- Tables -->
        <div class="table-side-by-side">

            <!-- Alerts -->
            <div class="table-container">
                <div class="table-container">
                    <h2>Alerts</h2>
                    <table class="createAlertTable">
                        <thead class="tableRow">
                        <tr>
                            <th>Alert ID</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Location</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($alerts as $alert)
                            <tr>
                                <td>{{ $alert->id }}</td>
                                <td>{{ $alert->title }}</td>
                                <td>{{ $alert->type }}</td>
                                <td>{{ $alert->location }}</td>
                                <td>{{ $alert->created_at }}</td>
                                <td>
                                    <form method="POST" action="{{ route('admin.alerts.delete', $alert->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="del">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Risk Levels -->
            <div class="table-container">
                <div class="table-container">
                    <h2>Risk Levels</h2>
                    <table class="riskLevelTable">
                        <thead class="tableRow">
                        <tr>
                            <th>Country</th>
                            <th>Risk Level</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($riskLevels as $risk)
                            <tr>
                                <td>{{ $risk->country }}</td>
                                <td>{{ $risk->risklevel }}</td>
                                <td>{{ $risk->description }}</td>
                                <td>{{ $risk->created_at->diffForHumans() }}</td>
                                <td>
                                    <form method="POST" action="{{ route('admin.risk.delete', $risk->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="del">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
    <style>
        .admin-container {
            padding: 30px;
        }

        /* Header */
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .admin-header h1 {
            font-size: 28px;
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .admin-actions {
            display: flex;
            gap: 10px;
        }

        /* Stats Cards */
        .stats-cards {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            flex: 1;
            padding: 20px;
            border-radius: 15px;
            background: var(--card-bg);
            box-shadow: var(--card-shadow);
            border: 1px solid var(--card-border);
        }

        .stat-card h3 {
            font-size: 14px;
            color: var(--text-secondary);
        }

        .stat-card p {
            font-size: 24px;
            font-weight: bold;
            color: var(--text-primary);
        }

        /* Table container spacing */
        .table-container {
            padding: 15px;
        }

        /* Risk level colors
        .low-risk {
            color: green;
            font-weight: 600;
        }

        .medium-risk {
            color: orange;
            font-weight: 600;
        }

        .high-risk {
            color: red;
            font-weight: 600;
        }
        .crateAlertContainer {
            margin: 30px;
        }
        */
        h2 {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            font-size: 24px;
            font-weight: 600;
            color: #1a1a2e;
            margin-bottom: 20px;
            margin-top: 0;
        }

        /* Create Alert Button */
        .createAlert {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 24px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .createAlert:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
            background: linear-gradient(135deg, #5a67d8 0%, #6b46a0 100%);
        }

        /* Tables */
        .createAlertTable, .riskLevelTable {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-family: inherit;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .tableRow {
            background: #f8f9fa;
            border-bottom: 2px solid #e9ecef;
        }

        .tableRow th {
            padding: 16px 20px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            color: #495057;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .createAlertTable td, .riskLevelTable td {
            padding: 16px 20px;
            font-size: 14px;
            color: #212529;
        }

        .createAlertTable tbody tr:hover, .riskLevelTable tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* Delete Button */
        .del {
            background: #dc3545;
            color: white;
            border: none;
            padding: 6px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .del:hover {
            background: #c82333;
            transform: scale(1.02);
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
        }

        .del:active {
            transform: scale(0.98);
        }

        /* Flex container for side-by-side layout */
        .table-side-by-side {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .table-side-by-side .table-container {
            flex: 1 1 45%;
            min-width: 300px;
        }

        @media (max-width: 768px) {
            .table-side-by-side {
                flex-direction: column;
            }

            h2 {
                font-size: 20px;
            }

            .createAlert {
                padding: 8px 20px;
                font-size: 13px;
            }
        }
    </style>
</x-app-layout>

