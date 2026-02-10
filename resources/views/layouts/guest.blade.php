<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>GoPlant</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- ===== THEME INIT (ANTI FLASH) ===== --}}
    <script>
        (function () {
            try {
                const theme = localStorage.getItem('theme');
                const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                if (theme === 'dark' || (!theme && systemDark)) {
                    document.documentElement.classList.add('dark');
                }

                document.documentElement.classList.add('theme-ready');
            } catch (e) {
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
    <button id="toggleThemeLanding"
            class="btn-theme landing-theme-btn"
            aria-label="Toggle theme">
        <span id="themeIcon">🌓</span>
    </button>

    {{-- CONTENT --}}
    @yield('content')

    {{-- ===== THEME SCRIPT ===== --}}
    <script>
        (function () {
            const toggleBtn = document.getElementById('toggleThemeLanding');
            const icon = document.getElementById('themeIcon');

            function updateIcon() {
                const isDark = document.documentElement.classList.contains('dark');
                if (icon) {
                    icon.textContent = isDark ? '☀️' : '🌓';
                }
            }

            // set icon on load
            updateIcon();

            toggleBtn?.addEventListener('click', function () {
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
