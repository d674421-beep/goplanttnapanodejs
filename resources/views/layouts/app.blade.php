<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GoPlant') }}</title>

    <!-- CSS Custom Project -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <!-- Tailwind CDN (BIAR CLASS TAILWIND HIDUP) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Optional Theme Script -->
    <script src="{{ asset('js/theme.js') }}" defer></script>
</head>

<body class="site-body">

    {{-- NAVBAR --}}
    @include('layouts.navigation')

    {{-- HEADER (kalau ada) --}}
    @isset($header)
        <header class="page-header">
            <div class="page-header-inner">
                {{ $header }}
            </div>
        </header>
    @endisset

    {{-- CONTENT --}}
    <main class="page-content">
        @yield('content')
    </main>

</body>
</html>
