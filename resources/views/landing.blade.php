@extends('layouts.guest')

@section('content')

<div class="landing-wrapper">

    <div class="landing-topbar">
        <a href="{{ route('login') }}" class="btn-top btn-login">Login</a>
        <a href="{{ route('register') }}" class="btn-top btn-register">Daftar</a>
    </div>


    <!-- HERO -->
    <section class="hero">
        <h2 class="hero-title">
            Rawat Tanaman Lebih Mudah & Teratur
        </h2>

        <p class="hero-subtitle">
            GoPlant membantu kamu mengelola perawatan tanaman,
            berbagi pengalaman, dan tidak lupa jadwal penting.
        </p>

        <a href="{{ route('register') }}" class="btn-primary">
            Mulai Sekarang
        </a>
    </section>


    <!-- VALUE -->
    <section class="value-section">
        <div class="value-grid">
            <div class="value-item">
                <h3>🌿 Terorganisir</h3>
                <p>Catat dan pantau perawatan tanamanmu dengan rapi.</p>
            </div>

            <div class="value-item">
                <h3>⏰ Pengingat</h3>
                <p>Reminder otomatis agar tidak lupa menyiram dan merawat.</p>
            </div>

            <div class="value-item">
                <h3>💬 Komunitas</h3>
                <p>Diskusi, tanya jawab, dan berbagi pengalaman dengan pengguna lain.</p>
            </div>
        </div>
    </section>


    <!-- CTA -->
    <section class="cta">
        <svg class="cta-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="1.5"
                  d="M12 2C9 6 7 9 7 13a5 5 0 0010 0c0-4-2-7-5-11z"/>
        </svg>

        <h3 class="cta-title">
            Tanaman sehat dimulai dari perawatan yang konsisten
        </h3>

        <a href="{{ route('register') }}" class="btn-primary">
            Daftar Gratis
        </a>
    </section>


    <!-- FOOTER -->
    <footer class="footer">
        © {{ date('Y') }} GoPlant — Rawat tanaman dengan cerdas
    </footer>

</div>

@endsection
