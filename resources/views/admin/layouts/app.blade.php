<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - GoPlant</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    
    {{-- 🔥 CRITICAL: Script ini HARUS di <head> dan BLOCKING (tanpa defer/async) --}}
    <script>
        (function () {
            try {
                const theme = localStorage.getItem('theme');
                const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                
                // Apply theme SEBELUM render body
                if (theme === 'dark' || (!theme && systemDark)) {
                    // Tambahkan ke HTML dulu untuk faster rendering
                    document.documentElement.classList.add('dark-loading');
                }
            } catch (e) {
                console.error('Theme init error:', e);
            }
        })();
    </script>

    {{-- 🔥 Script kedua: Apply ke body setelah DOM ready --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            try {
                const theme = localStorage.getItem('theme');
                const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                
                if (theme === 'dark' || (!theme && systemDark)) {
                    document.body.classList.add('dark');
                }
                
                // Remove loading class
                document.documentElement.classList.remove('dark-loading');
                
                // Set initial button text
                const toggleBtn = document.getElementById('toggleTheme');
                if (toggleBtn) {
                    const isDark = document.body.classList.contains('dark');
                    toggleBtn.textContent = isDark ? '☀️ Light Mode' : '🌙 Dark Mode';
                }
            } catch (e) {
                console.error('Theme apply error:', e);
            }
        });
    </script>

    <style>
/* Prevent flash of wrong theme */
html.dark-loading body {
    visibility: hidden;
}

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
body.dark .modal-box {
    background: #1f2937;
    color: #f9fafb;
}

body.dark .modal-text {
    color: #9ca3af;
}
    </style>
</head>
<body>
    <!-- TOPBAR -->
    <div class="topbar">
        <button id="toggleTheme" class="btn btn-view">🌙 Dark Mode</button>
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
                <button id="btnCancelLogout" class="btn btn-view">
                    Batal
                </button>

                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-delete">
                        Ya, Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- ===== Scripts ===== -->
    <script>
        // ===== Dark Mode Toggle =====
        document.getElementById('toggleTheme')?.addEventListener('click', function() {
            document.body.classList.toggle('dark');
            
            const isDark = document.body.classList.contains('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            
            // Update button text
            this.textContent = isDark ? '☀️ Light Mode' : '🌙 Dark Mode';
        });

        // ===== Modal Logic =====
        const logoutModal = document.getElementById('logoutModal');
        const btnLogoutTop = document.getElementById('btnLogoutTop');
        const btnCancelLogout = document.getElementById('btnCancelLogout');

        function closeLogoutModal() {
            logoutModal?.classList.remove('show');
            document.body.style.overflow = '';
        }

        btnLogoutTop?.addEventListener('click', () => {
            logoutModal.classList.add('show');
            document.body.style.overflow = 'hidden';
        });

        btnCancelLogout?.addEventListener('click', closeLogoutModal);

        // Close modal on click outside
        logoutModal?.addEventListener('click', (e) => {
            if(e.target === logoutModal) {
                closeLogoutModal();
            }
        });

        // Close modal with ESC
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && logoutModal?.classList.contains('show')) {
                closeLogoutModal();
            }
        });
    </script>
</body>
</html>