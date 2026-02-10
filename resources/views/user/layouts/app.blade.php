<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - GoPlant</title>

    {{-- ================= THEME INIT ================= --}}
    <script>
        (function () {
            try {
                const theme = localStorage.getItem('theme');
                const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                if (theme === 'dark' || (!theme && systemDark)) {
                    document.documentElement.classList.add('dark');
                }
                
                // Mark theme ready
                document.documentElement.classList.add('theme-ready');
            } catch (e) {
                document.documentElement.classList.add('theme-ready');
            }
        })();
    </script>

    {{-- ================= PREVENT FLASH ================= --}}
    <style>
        html:not(.theme-ready) body {
            opacity: 0;
        }
        html.theme-ready body {
            opacity: 1;
            transition: opacity 0.15s ease-in;
        }
    </style>

    {{-- ================= CSS FILES ================= --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">

    @stack('styles')
</head>
<body>
    {{-- ================= TOPBAR ================= --}}
    <div class="topbar">
        <button id="toggleTheme" class="btn-theme">
            <span id="themeIcon">🌓</span>
        </button>

        <button onclick="openLogoutModal()" class="btn-logout-top">
            Logout
        </button>
    </div>

    {{-- ================= SIDEBAR ================= --}}
    <div class="sidebar">
        <h2>User GoPlant</h2>
        @include('user.layouts.sidebar')
    </div>

    {{-- ================= CONTENT ================= --}}
    <div class="content">
        <div class="page-container">
            @yield('content')
        </div>
    </div>

    {{-- ================= LOGOUT MODAL ================= --}}
    <div id="logoutModal" class="modal-overlay">
        <div class="modal-box">
            <h3 class="modal-title">Keluar dari Akun</h3>

            <p class="modal-text">
                Apakah kamu yakin ingin logout?
            </p>

            <div class="modal-actions">
                <button onclick="closeLogoutModal()" class="btn-secondary">
                    Batal
                </button>

                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-delete">
                        Ya, Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- ================= SCRIPTS ================= --}}
    <script>
        (function() {
            'use strict';

            // Theme toggle
            const toggleBtn = document.getElementById('toggleTheme');
            const themeIcon = document.getElementById('themeIcon');

            function updateThemeIcon() {
                const isDark = document.documentElement.classList.contains('dark');
                if (themeIcon) {
                    themeIcon.textContent = isDark ? '☀️' : '🌓';
                }
            }

            // Set initial icon
            updateThemeIcon();

            toggleBtn?.addEventListener('click', function () {
                document.documentElement.classList.toggle('dark');
                const isDark = document.documentElement.classList.contains('dark');
                
                try {
                    localStorage.setItem('theme', isDark ? 'dark' : 'light');
                } catch (e) {
                    console.warn('Could not save theme preference');
                }
                
                updateThemeIcon();
            });

            // Modal functions
            window.openLogoutModal = function() {
                const modal = document.getElementById('logoutModal');
                if (modal) {
                    modal.classList.add('show');
                    document.body.style.overflow = 'hidden';
                }
            };

            window.closeLogoutModal = function() {
                const modal = document.getElementById('logoutModal');
                if (modal) {
                    modal.classList.remove('show');
                    document.body.style.overflow = '';
                }
            };

            // Close modal on outside click
            const logoutModal = document.getElementById('logoutModal');
            logoutModal?.addEventListener('click', function(e) {
                if (e.target === logoutModal) {
                    closeLogoutModal();
                }
            });

            // Close modal on ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && logoutModal?.classList.contains('show')) {
                    closeLogoutModal();
                }
            });
        })();
    </script>

    @stack('scripts')
</body>
</html>