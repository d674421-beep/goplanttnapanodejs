<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>User - GoPlant</title>

    {{-- ================= THEME INIT (NO BUILD REQUIRED) ================= --}}
    <script>
        (function () {
            try {
                const theme = localStorage.getItem('theme');
                const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                if (theme === 'dark' || (!theme && systemDark)) {
                    document.documentElement.classList.add('dark');
                }
            } catch (e) {}
        })();
    </script>

    {{-- ================= CSS (NO NODE / NO VITE) ================= --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


    {{-- OPTIONAL: kalau nanti mau user-specific override --}}
    {{-- <link rel="stylesheet" href="{{ asset('style/user.css') }}"> --}}

</head>
@stack('scripts')
<body>

    <!-- ================= TOPBAR ================= -->
    <div class="topbar">
        <button id="toggleTheme" class="btn-theme">🌓</button>

        <button onclick="openLogoutModal()"
                class="btn-logout-top">
            Logout
        </button>
    </div>

    <!-- ================= SIDEBAR ================= -->
    <div class="sidebar">
        <h2>User GoPlant</h2>
        @include('user.layouts.sidebar')
    </div>

    <!-- ================= CONTENT ================= -->
    <div class="content">
        <div class="page-container">
            @yield('content')
        </div>
    </div>


    <!-- ================= LOGOUT MODAL ================= -->
    <div id="logoutModal" class="modal-overlay">
        <div class="modal-box">
            <h3 class="modal-title">Keluar dari Akun</h3>

            <p class="text-muted mb-6">
                Apakah kamu yakin ingin logout?
            </p>

            <div class="modal-actions">
                <button onclick="closeLogoutModal()" class="btn btn-secondary">
                    Batal
                </button>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-delete">
                        Ya, Logout
                    </button>
                </form>
            </div>
        </div>
    </div>


    <!-- ================= SCRIPT ================= -->
    <script>
        function openLogoutModal() {
            document.getElementById('logoutModal').classList.add('show');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.remove('show');
        }


        // Toggle dark / light
        document.getElementById('toggleTheme')
            ?.addEventListener('click', function () {
                document.documentElement.classList.toggle('dark');
                const isDark = document.documentElement.classList.contains('dark');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
            });
    </script>

</body>
</html>
