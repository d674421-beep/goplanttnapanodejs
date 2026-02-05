<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - GoPlant</title>
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
body.dark .modal-box {
    background: #1f2937;
    color: #f9fafb;
}

body.dark .modal-text {
    color: #9ca3af;
}
</style>


    <script>
        // ===== Dark Mode Init =====
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
</head>
<body>
    <!-- TOPBAR -->
    <div class="topbar">
        <button id="toggleTheme" class="btn-theme">🌓</button>
        <button id="btnLogoutTop" class="btn-logout-top">Logout</button>
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
            <button id="btnCancelLogout" class="btn btn-secondary">
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

    <!-- ===== Scripts ===== -->
    <script>
        // ===== Dark Mode Toggle =====
        document.getElementById('toggleTheme')?.addEventListener('click', () => {
            const html = document.documentElement;
            html.classList.toggle('dark');
            localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
        });

        // ===== Modal Logic =====
        const logoutModal = document.getElementById('logoutModal');
        const btnLogoutTop = document.getElementById('btnLogoutTop');
        const btnCancelLogout = document.getElementById('btnCancelLogout');

        btnLogoutTop?.addEventListener('click', () => {
            logoutModal.classList.add('show');
        });

        btnCancelLogout?.addEventListener('click', () => {
            logoutModal.classList.remove('show');
        });

        // Close modal on click outside box
        logoutModal?.addEventListener('click', (e) => {
            if(e.target === logoutModal) {
                logoutModal.classList.remove('show');
            }
        });
    </script>
</body>
</html>
