<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>GoPlant</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body class="light">


    <!-- THEME TOGGLE (Landing Only) -->
    <button id="toggleThemeLanding" class="btn-theme landing-theme-btn">🌓</button>

    @yield('content')

    <script>
        // init theme
        (function () {
            const theme = localStorage.getItem('theme');
            if (theme === 'dark') {
                document.body.classList.add('dark');
            }
        })();

        document.getElementById('toggleThemeLanding')?.addEventListener('click', () => {
            document.body.classList.toggle('dark');
            localStorage.setItem('theme',
                document.body.classList.contains('dark') ? 'dark' : 'light'
            );
        });
    </script>

</body>

</html>
