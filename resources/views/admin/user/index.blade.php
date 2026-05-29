<x-app-layout>
    <div class="container user-container">
        <div class="user-panel-header">
            <h2 class="panel-title">User Management</h2>

            <div class="panel-actions">
                <a href="#" class="btn-primary">+ Add User</a>
                <a href="#" class="btn-primary">Manage Admins</a>
                <a href="{{route('admin.alerts.index')}}" class="btn-primary"> <= back to Main Panel</a>            </div>
        </div>
        <div class="stats-grid">
            <div class="stat-card">
                <h4>Total Users</h4>
                <p>{{$users->count()}}</p>
            </div>

            <div class="stat-card">
                <h4>Active Users</h4>
                <p>{{$activeUsers->count()}}</p>
            </div>

            <div class="stat-card">
                <h4>Admins</h4>
                <p>{{$admins->count()}}</p>
            </div>

            <div class="stat-card">
                <h4>Blocked</h4>
                <p>{{$blockedUsers->count()}}</p>
            </div>
        </div>
        <div class="toolbar">

            <input type="text" placeholder="Search users..." class="search-input" id="searchUser"">

            <select class="filter-select" id="filterByRole">
                <option value="">All Roles</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>

            <select class="filter-select" id="filterByStatus">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="blocked">Blocked</option>
            </select>

            <button class="btn-refresh" id="refresh">⟳ Refresh</button>

        </div>
        <div class="user-table" id="userTable">
            @include('partials.userTable')
        </div>

    </div>

    <style>
        /* Header */
        .user-container {
            margin: 45px;
            padding: 20px;
        }

        .user-panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .panel-title {
            font-size: 26px;
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Buttons */
        .btn-primary {
            background: var(--primary-gradient);
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
        }

        .btn-secondary {
            background: #eee;
            padding: 10px 18px;
            border-radius: 8px;
        }

        /* Stats */
        .stats-grid {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-card {
            flex: 1;
            padding: 15px;
            background: white;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
        }

        /* Toolbar */
        .toolbar {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .search-input {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            width: 250px;
        }

        .filter-select {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        /* Table */
        .table-container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
        }

        .user-table th,
        .user-table td {
            padding: 15px;
        }

        .user-table tr:hover {
            background: #f9f9f9;
        }

        /* Badges */
        .badge {
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
        }
        .badge-success {
            color: green;
            font-weight: 600;
        }

        .badge-danger {
            color: orange;
            font-weight: 600;
        }

        .badge-admin { background: #e3f2fd; color: #0d47a1; }
        .badge-active { background: #d4edda; color: #155724; }

        /* Actions */
        .actions button {
            margin-right: 5px;
            padding: 5px 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-edit { background: #ffc107; }
        .btn-delete { background: #dc3545; color: white; }
        .btn-block { background: #6c757d; color: white; }

        .user-table {
            margin-top: 13px;
        }
    </style>
    <script>
        function fetchdata() {
            let search = document.getElementById("searchUser").value;
            let role = document.getElementById("filterByRole").value;
            let rolestatus = '';
            //console.log(role);
            if (role === 'admin') {
                rolestatus = 1;
            } else if(role === 'user') {
                rolestatus = 0;
            }
            //console.log(rolestatus);
            let status = document.getElementById("filterByStatus").value;

            let url = `/admin/user/search?search=${encodeURIComponent(search)}&is_admin=${rolestatus}&status=${status}`;

            fetch(url)
                .then(res => res.text())
                .then(data => {
                    document.getElementById('userTable').innerHTML = data;
                })
        }
        function refreshTrigger() {
            document.getElementById('searchUser').value = '';
            document.getElementById('filterByRole').value = '';
            document.getElementById('filterByStatus').value = '';
            fetchdata();
        }
        //actions
        document.getElementById('searchUser').addEventListener('keyup', fetchdata);
        document.getElementById('filterByRole').addEventListener('change', fetchdata);
        document.getElementById('filterByStatus').addEventListener('change', fetchdata);
        document.getElementById('refresh').addEventListener('click', refreshTrigger);

    </script>

</x-app-layout>
