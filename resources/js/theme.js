document.addEventListener('DOMContentLoaded', () => {
    const html = document.documentElement;
    const button = document.getElementById('toggleTheme');

    // 🔹 Deteksi preferensi OS
    const systemPrefersDark = window.matchMedia(
        '(prefers-color-scheme: dark)'
    ).matches;

    // 🔹 Tentukan tema awal
    if (localStorage.getItem('theme')) {
        // Jika user sudah memilih sebelumnya
        html.classList.toggle(
            'dark',
            localStorage.getItem('theme') === 'dark'
        );
    } else {
        // Jika belum pernah memilih → ikuti OS
        html.classList.toggle('dark', systemPrefersDark);
        localStorage.setItem(
            'theme',
            systemPrefersDark ? 'dark' : 'light'
        );
    }

    // 🔹 Jika tombol tidak ada, hentikan
    if (!button) return;

    // 🔹 Toggle manual oleh user
    button.addEventListener('click', () => {
        const isDark = html.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
		
	document.documentElement.classList.add('theme-ready');

    });
});
