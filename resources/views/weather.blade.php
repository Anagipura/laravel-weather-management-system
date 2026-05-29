<x-app-layout>
    <body>
        <!-- Sidebar for Quick Actions -->
    <aside class="sidebar">
        <div class="sidebar-stats">
            <h3><i class="fas fa-exclamation-triangle"></i> Alert Status</h3>
            <div class="stat-item">
                <span class="stat-label">Risk Level</span>
                <span class="stat-value badge
                    {{ optional($riskLevel)->risklevel == 'low' ? 'badge-warning' : '' }}
                    {{ optional($riskLevel)->risklevel == 'medium' ? 'badge-info' : '' }}
                    {{ optional($riskLevel)->risklevel == 'high' ? 'badge-danger' : '' }}">

                    {{ optional($riskLevel)->risklevel ?? 'Unknown' }}
                </span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Active Alerts</span>
                <span class="stat-value">{{$alerts->count()}}</span>
            </div>
        </div>

        <div class="quick-actions">
            <h3><i class="fas fa-bolt"></i> Quick Actions</h3>
            <button class="btn-action emergency">
                <i class="fas fa-phone-alt"></i>
                SOS Emergency
            </button>
            <button class="btn-action">
                <i class="fas fa-first-aid"></i>
                First Aid Guide
            </button>
            <button class="btn-action">
                <i class="fas fa-cloud-download-alt"></i>
                Download Resources
            </button>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="main-container">
        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <div class="welcome-content">
                <h1>Welcome to DisasterAlert</h1>
                <p>Real-time monitoring and emergency management system</p>
            </div>
            <div class="welcome-time">
                <i class="fas fa-clock"></i>
                <span id="liveTime">Monitoring...</span>
            </div>
        </div>

        <!-- Dashboard Grid -->
        <div class="dashboard-grid">
            <!-- Weather Card -->
            <div class="dashboard-card weather-card">
                <div class="card-header">
                    <h2><i class="fas fa-cloud-sun"></i> Current Weather</h2>
                    <button class="btn-refresh" id="refreshWeather">
                        <i class="fas fa-redo-alt"></i>
                    </button>
                </div>
                <div class="weather-content">
                    <div class="weather-main">
                        <div class="weather-icon" id="weatherIcon">
                            <i class="fas fa-sun fa-3x"></i>
                        </div>
                        <div class="weather-temp">
                            <span class="temp-value" id="temperature">{{$weather['main']['temp']." °C" ?? '--'}}</span>
                            <span class="temp-unit"></span>
                        </div>
                    </div>
                    <div class="weather-details">
                        <div class="detail-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span id="location_name">{{$weather['name'] ?? 'Loading...'}}</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-tint"></i>
                            <span>Humidity: <strong id="humidity">{{$weather['main']['humidity'] ?? '--'}}</strong></span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-wind"></i>
                            <span>Wind: <strong id="wind_speed">{{$weather['wind']['speed'] ?? '--'}}</strong></span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-cloud"></i>
                            <span>Condition: <strong id="weather_condition">{{$weather['weather'][0]['description'] ?? '--'}}</strong></span>
                        </div>
                    </div>
                </div>
                <div class="weather-footer">
                    <span id="weather_status">Updating weather data...</span>
                </div>
            </div>

            <!-- Live Map Card -->
            <div class="dashboard-card map-card">
                <div class="card-header">
                    <h2><i class="fas fa-map"></i> Live Weather Map</h2>
                    <div class="map-controls">
                        <button class="map-btn active" style="border:solid #764ba2">Load OpenWeather map</button>
                    </div>
                </div>
                <div class="map-container">
                    <iframe
                        src="https://embed.windy.com/embed2.html?lat=7.87&lon=80.77&zoom=5&level=surface&overlay=wind&menu=&message=&marker=&calendar=&pressure=&type=map&location=coordinates&detail=&detailLat=&detailLon=&metricWind=default&metricTemp=default&radarRange=-1"
                        frameborder="0" class="live-map">
                    </iframe>
                </div>
                <div class="map-footer">
                    <p><i class="fas fa-info-circle"></i> Real-time weather monitoring</p>
                </div>
            </div>

            <!-- Emergency Alerts Card -->
            <div class="dashboard-card alerts-card">
                <div class="card-header">
                    <h2><i class="fas fa-exclamation-circle"></i> Emergency Alerts</h2>
                    <span class="alert-count">{{$alerts->count()}}</span>
                </div>

                <div class="alerts-list  overflow-auto" style="max-height: 300px; padding-right: 5px">
                    @forelse($alerts as $alert)
                        <div class="alert-item {{$alert->type}}">
                            <div class="alert-icon">
                                @if($alert->type == "critical")
                                    <i class="fas fa-bolt"></i>
                                @elseif($alert->type == "warning")
                                    <i class="fas fa-water"></i>
                                @else
                                    <i class="fas fa-info-circle"></i>
                                @endif
                            </div>
                            <div class="alert-content">
                                <h4>{{$alert->title}}</h4>
                                <p>{{$alert->message}}</p>

                                <span class="alert-time">
                                    {{$alert->created_at->diffForHumans()}}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p>No Alerts available</p>
                    @endforelse
                </div>
            </div>

            <!-- Emergency Contacts -->
            <div class="dashboard-card contacts-card">
                <div class="card-header">
                    <h2><i class="fas fa-phone-alt"></i> Emergency Contacts</h2>
                </div>
                <div class="contacts-grid">
                    <div class="contact-item police">
                        <i class="fas fa-shield-alt"></i>
                        <div>
                            <h4>Police</h4>
                            <p class="contact-number"><a href="tel:+94119" style="text-decoration: none;" class="contact-link">119</a>
                            </p>
                        </div>
                    </div>
                    <div class="contact-item fire">
                        <i class="fas fa-fire-extinguisher"></i>
                        <div>
                            <h4>Fire Department</h4>
                            <p class="contact-number"><a href="tel:+94110" style="text-decoration: none;" class="contact-text">110</a>
                            </p>
                        </div>
                    </div>
                    <div class="contact-item ambulance">
                        <i class="fas fa-ambulance"></i>
                        <div>
                            <h4>Ambulance</h4>
                            <p class="contact-number"><a href="tel:+941990" style="text-decoration: none;"
                                                         class="contact-text">1990</a></p>
                        </div>
                    </div>
                    <div class="contact-item disaster">
                        <i class="fas fa-life-ring"></i>
                        <div>
                            <h4>Disaster Management</h4>
                            <p class="contact-number"><a href="tel:+94117" style="text-decoration: none;" class="contact-text">117</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Live Notifications Panel -->
        <div class="notifications-panel" id="notificationsPanel">
            <div class="panel-header">
                <h3><i class="fas fa-bell"></i> Notifications</h3>
                <button class="btn-close" id="closeNotifications">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="notifications-list">
                <div class="notification-item unread">
                    <i class="fas fa-exclamation-triangle"></i>
                    <div>
                        <p>Severe weather alert issued for your area</p>
                        <span>2 minutes ago</span>
                    </div>
                </div>
                <div class="notification-item">
                    <i class="fas fa-check-circle"></i>
                    <div>
                        <p>System update completed successfully</p>
                        <span>1 hour ago</span>
                    </div>
                </div>
                <div class="notification-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <p>New emergency shelter opened in Colombo</p>
                        <span>3 hours ago</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="container secondary-container">

        </div>
    </main>
    </body>

</x-app-layout>
