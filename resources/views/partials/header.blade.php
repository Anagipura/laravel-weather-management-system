<header class="header">
    <div class="header-container">
        <div class="logo">
            <i class="fas fa-shield-alt"></i>
            <span>DisasterAlert</span>
        </div>

        <!-- Main Navigation -->
        <nav class="nav-main">
            <a href="{{ url('/') }}" class="nav-link active">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ url('/emergencyCenters') }}" class="nav-link">
                <i class="fas fa-map-marker-alt"></i>
                <span>Emergency Centers</span>
            </a>
            <a href="{{route('admin.donations.index')}}" class="nav-link">
                <i class="fas fa-hands-helping"></i>
                <span>Donations</span>
            </a>
            <a href="{{ route('aboutUs')  }}" class="nav-link">
                <i class="fas fa-info-circle"></i>
                <span>About Us</span>
            </a>
        </nav>

        <!-- User Authentication Section -->
        <div class="user-auth-container">

            @guest
                <!-- Login/Register -->
                <div class="auth-buttons">
                    <a href="{{ route('login') }}" class="btn-auth btn-login">Login</a>
                    <a href="{{ route('register') }}" class="btn-auth btn-register">Register</a>
                </div>
            @endguest

            @auth
                <!-- Logged User -->
                <div class="user-profile">
                    <div class="user-info">
                        <div class="user-info">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}"
                                 class="user-avatar">

                            <div class="user-details">
                                <span class="user-name">{{ Auth::user()->name }}</span>
                                <span class="user-email">{{ Auth::user()->email }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="user-actions">
                        <button class="btn-notification">
                            <i class="fas fa-bell"></i><!--Notification count for each user-->
                        </button>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class=" btn-auth btn-register">Logout</button>
                    </form>
                </div>
            @endauth

        </div>
    </div>
</header>
