<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>GoPlant</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- ===== THEME INIT (ANTI FLASH / FOUC) ===== --}}
    <script>
        (function () {
            try {
                const savedTheme = localStorage.getItem('theme');
                const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                if (savedTheme === 'dark' || (!savedTheme && systemDark)) {
                    document.documentElement.classList.add('dark');
                }
            } catch (e) {
                // ignore
            } finally {
                document.documentElement.classList.add('theme-ready');
            }
        })();
    </script>

    {{-- Anti flash --}}
    <style>
        html:not(.theme-ready) body {
            opacity: 0;
        }
        html.theme-ready body {
            opacity: 1;
            transition: opacity .15s ease-in;
        }
    </style>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

    {{-- ===== THEME TOGGLE (LANDING ONLY) ===== --}}
    <button
        id="toggleThemeLanding"
        class="btn-theme landing-theme-btn"
        aria-label="Ganti tema"
        type="button"
    >
        <span id="themeIcon">🌓</span>
    </button>

    {{-- CONTENT --}}
    @yield('content')

    {{-- ===== THEME TOGGLE SCRIPT ===== --}}
    <script>
        (function () {
            const btn  = document.getElementById('toggleThemeLanding');
            const icon = document.getElementById('themeIcon');

            if (!btn || !icon) return;

            function updateIcon() {
                const isDark = document.documentElement.classList.contains('dark');
                icon.textContent = isDark ? '☀️' : '🌓';
            }

            updateIcon();

            btn.addEventListener('click', function () {
                document.documentElement.classList.toggle('dark');
                const isDark = document.documentElement.classList.contains('dark');

                try {
                    localStorage.setItem('theme', isDark ? 'dark' : 'light');
                } catch (e) {}

                updateIcon();
            });
        })();
    </script>

</body>
</html>
