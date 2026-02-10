<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>User - GoPlant</title>

    {{-- Theme Init Script --}}
    <script>
        (function () {
            try {
                const theme = localStorage.getItem('theme');
                const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                
                if (theme === 'dark' || (!theme && systemDark)) {
                    document.documentElement.classList.add('dark');
                }
                
                // Mark as ready to prevent flash
                document.documentElement.classList.add('theme-ready');
            } catch (e) {
                document.documentElement.classList.add('theme-ready');
            }
        })();
    </script>

    {{-- CSS Files --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    {{-- Prevent flash inline CSS --}}
    <style>
        html:not(.theme-ready) body {
            opacity: 0;
        }
        html.theme-ready body {
            opacity: 1;
            transition: opacity 0.15s ease-in;
        }
    </style>

    @stack('styles')
</head>
<body>
    {{-- TOPBAR --}}
    <div class="topbar">
        <button id="toggleTheme" class="btn-theme">🌓 Theme</button>
        <button onclick="openLogoutModal()" class="btn-logout-top">Logout</button>
    </div>

    {{-- SIDEBAR --}}
    <div class="sidebar">
        <h2>User GoPlant</h2>
        @include('user.layouts.sidebar')
    </div>

    {{-- CONTENT --}}
    <div class="content">
        <div class="page-container">
            @yield('content')
        </div>
    </div>

    {{-- LOGOUT MODAL --}}
    <div id="logoutModal" class="modal-overlay">
        <div class="modal-box">
            <h3 class="modal-title">Keluar dari Akun</h3>
            <p class="modal-text">Apakah kamu yakin ingin logout?</p>
            <div class="modal-actions">
                <button onclick="closeLogoutModal()" class="btn-secondary">Batal</button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">Ya, Logout</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script>
        // Toggle Theme
        document.getElementById('toggleTheme')?.addEventListener('click', function () {
            document.documentElement.classList.toggle('dark');
            const isDark = document.documentElement.classList.contains('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            this.textContent = isDark ? '☀️ Light' : '🌓 Theme';
        });

        // Set initial button text
        window.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('toggleTheme');
            if (btn) {
                const isDark = document.documentElement.classList.contains('dark');
                btn.textContent = isDark ? '☀️ Light' : '🌓 Theme';
            }
        });

        // Modal functions
        function openLogoutModal() {
            const modal = document.getElementById('logoutModal');
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeLogoutModal() {
            const modal = document.getElementById('logoutModal');
            modal.classList.remove('show');
            document.body.style.overflow = '';
        }

        // Close on outside click
        document.getElementById('logoutModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeLogoutModal();
        });

        // Close on ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeLogoutModal();
        });
    </script>

    @stack('scripts')
</body>
</html>