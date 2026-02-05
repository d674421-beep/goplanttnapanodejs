<nav class="navbar">
    <div class="navbar-inner">

        <!-- ================= LEFT SIDE ================= -->
        <div class="navbar-left">
            <a href="{{ route('landing') }}" class="navbar-brand">
                🌱 GoPlant
            </a>

            @auth
                <a href="{{ route('dashboard') }}"
                   class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>
            @endauth
        </div>


        <!-- ================= RIGHT SIDE ================= -->
        <div class="navbar-right">

            {{-- ========== USER SUDAH LOGIN ========== --}}
            @auth
                <span class="user-name">
                    👋 {{ Auth::user()->name }}
                </span>

                <a href="{{ route('profile.edit') }}" class="nav-link">
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        Logout
                    </button>
                </form>
            @endauth


            {{-- ========== USER BELUM LOGIN ========== --}}
            @guest
                <a href="{{ route('login') }}" class="nav-link">
                    Login
                </a>

                <a href="{{ route('register') }}" class="nav-link register-btn">
                    Daftar
                </a>
            @endguest

        </div>
    </div>
</nav>
