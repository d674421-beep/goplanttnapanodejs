<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - GoPlant</title>
    
    {{-- 🔥 CRITICAL: Inline CSS untuk prevent flicker --}}
    <style>
        /* Prevent any flash by setting default background */
        html {
            background: #f7fafc;
            transition: background-color 0s; /* No transition on page load */
        }
        
        html.dark {
            background: #111827;
        }
        
        /* Hide content until theme is ready */
        html:not(.theme-ready) body {
            opacity: 0;
        }
        
        html.theme-ready body {
            opacity: 1;
            transition: opacity 0.15s ease-in;
        }
    </style>

    {{-- 🔥 CRITICAL: Load theme IMMEDIATELY (before any render) --}}
    <script>
        (function() {
            try {
                const theme = localStorage.getItem('theme');
                const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                
                // Apply to HTML immediately
                if (theme === 'dark' || (!theme && systemDark)) {
                    document.documentElement.classList.add('dark');
                }
                
                // Mark theme as ready
                document.documentElement.classList.add('theme-ready');
            } catch (e) {
                // Fallback: always mark ready to prevent permanent blank screen
                document.documentElement.classList.add('theme-ready');
            }
        })();
    </script>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <style>
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.6);
    backdrop-filter: blur(4px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    opacity: 0;
    pointer-events: none;
    transition: opacity .2s ease;
}

.modal-overlay.show {
    opacity: 1;
    pointer-events: auto;
}

.modal-box {
    background: #ffffff;
    width: 100%;
    max-width: 420px;
    padding: 28px;
    border-radius: 16px;
    box-shadow: 0 25px 60px rgba(0,0,0,.25);
    transform: translateY(-10px) scale(.97);
    transition: transform .2s ease;
    text-align: center;
}

.modal-overlay.show .modal-box {
    transform: translateY(0) scale(1);
}

.modal-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 10px;
}

.modal-text {
    color: #6b7280;
    margin-bottom: 22px;
}

.modal-actions {
    display: flex;
    justify-content: center;
    gap: 12px;
}

/* Dark mode */
html.dark .modal-box {
    background: #1f2937;
    color: #f9fafb;
}

html.dark .modal-text {
    color: #9ca3af;
}
    </style>
</head>
<body>
    <!-- TOPBAR -->
    <div class="topbar">
        <button id="toggleTheme" class="btn btn-view">
            <span id="themeIcon">🌙</span>
            <span id="themeText">Dark Mode</span>
        </button>
        <button id="btnLogoutTop" class="btn btn-delete">Logout</button>
    </div>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>Admin GoPlant</h2>
        @include('admin.layouts.sidebar')
    </div>

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>

    <!-- LOGOUT MODAL -->
    <div id="logoutModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-title">Konfirmasi Logout</div>

            <div class="modal-text">
                Apakah kamu yakin ingin keluar dari akun admin?
            </div>

            <div class="modal-actions">
                <button id="btnCancelLogout" class="btn btn-view">Batal</button>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-delete">Ya, Logout</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script>
        (function() {
            'use strict';

            // ===== Theme Toggle =====
            const toggleBtn = document.getElementById('toggleTheme');
            const themeIcon = document.getElementById('themeIcon');
            const themeText = document.getElementById('themeText');
            const html = document.documentElement;

            function updateThemeUI() {
                const isDark = html.classList.contains('dark');
                if (themeIcon && themeText) {
                    themeIcon.textContent = isDark ? '☀️' : '🌙';
                    themeText.textContent = isDark ? 'Light Mode' : 'Dark Mode';
                }
            }

            // Set initial UI
            updateThemeUI();

            toggleBtn?.addEventListener('click', function() {
                html.classList.toggle('dark');
                const isDark = html.classList.contains('dark');
                
                try {
                    localStorage.setItem('theme', isDark ? 'dark' : 'light');
                } catch (e) {
                    console.warn('Could not save theme preference');
                }
                
                updateThemeUI();
            });

            // ===== Modal Logic =====
            const logoutModal = document.getElementById('logoutModal');
            const btnLogoutTop = document.getElementById('btnLogoutTop');
            const btnCancelLogout = document.getElementById('btnCancelLogout');

            function openLogoutModal() {
                if (!logoutModal) return;
                logoutModal.classList.add('show');
                document.body.style.overflow = 'hidden';
            }

            function closeLogoutModal() {
                if (!logoutModal) return;
                logoutModal.classList.remove('show');
                document.body.style.overflow = '';
            }

            btnLogoutTop?.addEventListener('click', openLogoutModal);
            btnCancelLogout?.addEventListener('click', closeLogoutModal);

            // Close on outside click
            logoutModal?.addEventListener('click', function(e) {
                if (e.target === logoutModal) {
                    closeLogoutModal();
                }
            });

            // Close on ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && logoutModal?.classList.contains('show')) {
                    closeLogoutModal();
                }
            });
        })();
    </script>

    @yield('scripts')
</body>
</html>