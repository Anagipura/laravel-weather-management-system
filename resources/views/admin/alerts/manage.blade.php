<x-app-layout>
    <div class="container alert-manage-container">

        <!-- Header -->
        <div class="header-container">
            <h2 class="title">Alert Management</h2>

            <div class="panel-actions">
                <a href="{{route('admin.alerts.create')}}" class="action-buttons">+ Create Alert</a>
                <a href="{{route('admin.alerts.index')}}" class="action-buttons"> <= back to Main Panel</a>
            </div>
        </div>

        <!-- Filters + Search -->
        <div class="toolbar">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search by title or location...">
                <div id="suggestion"></div>
            </div>

            <div class="filters">
                <!-- Country Filter -->
                <select id="countryFilter">
                    <option value="">All Countries</option>
                    <option value="LK">Sri Lanka</option>
                    <option value="IN">India</option>
                    <option value="MV">Maldives</option>
                </select>

                <!-- Type Filter -->
                <select id="typeFilter">
                    <option value="">All Types</option>
                    <option value="warning">Warning</option>
                    <option value="info">Info</option>
                    <option value="critical">Critical</option>
                </select>

                <!-- Refresh -->
                <a href="{{route('admin.alerts.manage')}}" class="refresh-btn" id="refresh">⟳ Refresh</a>
            </div>
        </div>

        <!-- Table -->
        @include('partials.alertTable');


        <div class="container smart-Alert-management">
            <div class="smart-Alert-status">
                <h3>Pending Alerts</h3>
            </div>
            @include('partials.pendingAlertsTable');
        </div>
    </div>


    <style>
        /* ===== Layout ===== */

        .alert-manage-container {
            margin: 45px;
            padding: 20px;
        }

        /* ===== Typography ===== */
        .title {
            font-size: 26px;
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* ===== Toolbar ===== */
        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin: 20px 0;
        }

        /* Search */
        .search-box input {
            width: 250px;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: 0.2s ease;
        }

        .search-box input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.2);
        }

        /* Filters */
        .filters {
            display: flex;
            gap: 10px;
        }

        .filters select {
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            cursor: pointer;
        }

        /* Buttons */
        .action-buttons{
            padding: 10px 16px;
            border-radius: 8px;
            background: var(--primary-gradient);
            color: white;
            border: none;
            text-decoration: none;
            cursor: pointer;
            transition: 0.25s ease;
        }

        .refresh-btn {
            padding: 5px 8px;
            border-radius: 8px;
            background: var(--primary-gradient);
            color: white;
            border: none;
            text-decoration: none;
            cursor: pointer;
            transition: 0.25s ease;
        }

        .action-buttons:hover,
        .refresh-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        /* ===== Table ===== */
        .table-container {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }

        .alert-table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Table Head */
        .alert-table th {
            background: #f8f9fa;
            padding: 14px;
            text-align: left;
            font-size: 13px;
            text-transform: uppercase;
            color: #555;
        }

        /* Table Body */
        .alert-table td {
            padding: 14px;
            border-top: 1px solid #eee;
            font-size: 14px;
        }

        .alert-table tbody tr {
            transition: 0.2s ease;
        }

        .alert-table tbody tr:hover {
            background: #f9f9f9;
        }

        /* ===== Badge System ===== */
        .badge {
            display: inline-block;
            padding: 5px 10px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 6px;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }

        .badge-danger {
            background: #f8d7da;
            color: #721c24;
        }

        .badge-info {
            background: #d1ecf1;
            color: #0c5460;
        }

        /* ===== Delete Button ===== */
        .btn-delete {
            padding: 6px 12px;
            border-radius: 6px;
            border: none;
            background: #dc3545;
            color: white;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .btn-delete:hover {
            background: #c82333;
            transform: scale(1.05);
        }

        /* ===== Responsive ===== */
        @media (max-width: 768px) {
            .toolbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-box input {
                width: 100%;
            }

            .filters {
                width: 100%;
                flex-wrap: wrap;
            }

            .alert-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>

   <script>
       function fetchAlerts() {
           let search = document.getElementById('searchInput').value;
           let type = document.getElementById('typeFilter').value;
           let country = document.getElementById('countryFilter').value;

           let url = `/admin/alerts/search?search=${search}&type=${type}&country=${country}`;

           fetch(url)
               .then(res => res.text())
               .then(data => {
                   document.getElementById('alertTable').innerHTML = data;
               });
       }
       function refreshTrigger() {
           document.getElementById('searchInput').value = '';
           document.getElementById('typeFilter').value = '';
           document.getElementById('countryFilter').value = '';
           fetchAlerts();
       }

       // Events
       document.getElementById('searchInput').addEventListener('keyup', fetchAlerts);
       document.getElementById('typeFilter').addEventListener('change', fetchAlerts);
       document.getElementById('countryFilter').addEventListener('change', fetchAlerts);
       document.getElementById('refresh').addEventListener('click', refreshTrigger);
   </script>

</x-app-layout>
