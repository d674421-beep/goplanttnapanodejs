<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>GoPlant</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="theme-light bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex flex-col items-center justify-center min-h-screen p-6 lg:p-8">

    {{-- Header --}}
    <header class="w-full lg:max-w-4xl max-w-[335px] mb-6 text-sm">
        @if (Route::has('login'))
            <nav class="flex justify-end gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="px-4 py-1.5 text-sm rounded-sm border hover:border-gray-400 dark:border-gray-700 dark:hover:border-gray-500">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="px-4 py-1.5 text-sm rounded-sm border hover:border-gray-400 dark:border-gray-700 dark:hover:border-gray-500">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="px-4 py-1.5 text-sm rounded-sm border hover:border-gray-400 dark:border-gray-700 dark:hover:border-gray-500">
                           Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    {{-- Main --}}
    <main class="flex flex-col-reverse lg:flex-row max-w-[335px] lg:max-w-4xl w-full gap-4">

        {{-- Konten --}}
        <div class="flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none text-[13px] leading-[20px]">
            <h1 class="mb-2 font-medium text-base">Let's get started</h1>
            <p class="mb-4 text-[#706f6c] dark:text-[#A1A09A] text-sm">Laravel has an incredibly rich ecosystem. We suggest starting with the following.</p>

            {{-- Info Cards Ringkas --}}
            <div class="dashboard-cards flex gap-3 flex-nowrap overflow-x-auto py-2">
                <div class="flex-shrink-0 w-28 p-2 text-center bg-green-50 dark:bg-green-900 rounded shadow">
                    <h3 class="text-xs font-medium text-green-700 dark:text-green-300">Total Tanaman</h3>
                    <p class="text-sm font-bold text-green-900 dark:text-green-100">123</p>
                </div>
                <div class="flex-shrink-0 w-28 p-2 text-center bg-blue-50 dark:bg-blue-900 rounded shadow">
                    <h3 class="text-xs font-medium text-blue-700 dark:text-blue-300">Posting Forum</h3>
                    <p class="text-sm font-bold text-blue-900 dark:text-blue-100">45</p>
                </div>
                <div class="flex-shrink-0 w-28 p-2 text-center bg-yellow-50 dark:bg-yellow-900 rounded shadow">
                    <h3 class="text-xs font-medium text-yellow-700 dark:text-yellow-300">Pengguna</h3>
                    <p class="text-sm font-bold text-yellow-900 dark:text-yellow-100">67</p>
                </div>
            </div>

            {{-- Link --}}
            <ul class="flex gap-2 mt-4 text-sm">
                <li>
                    <a href="https://cloud.laravel.com" target="_blank"
                       class="px-3 py-1 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded-sm text-xs hover:opacity-80">
                        Deploy now
                    </a>
                </li>
            </ul>
        </div>

        {{-- SVG Laravel --}}
        <div class="bg-[#fff2f2] dark:bg-[#1D0002] relative lg:-ml-px -mb-px lg:mb-0 rounded-t-lg lg:rounded-t-none lg:rounded-r-lg w-full lg:w-[438px] aspect-[335/376] lg:aspect-auto shrink-0 overflow-hidden">
            {{-- Masukkan SVG Laravel Anda di sini, sama seperti sebelumnya --}}
        </div>
    </main>

</body>
</html>
