// public/js/theme.js
(function () {
    const body = document.body;
    const toggleBtn = document.getElementById('toggleTheme');

    // 1. Apply saved theme on load
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        body.classList.add('dark');
    }

    // 2. Toggle theme
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            body.classList.toggle('dark');

            if (body.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
        });
    }
})();
