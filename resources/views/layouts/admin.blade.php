<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - GoPlant</title>

    <!-- CSS statis TANPA Node.js -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<div style="display:flex; min-height:100vh; font-family:Arial, sans-serif">

    <!-- SIDEBAR -->
    <aside style="
        width:220px;
        background:#1f2937;
        color:white;
        padding:16px;
    ">
        <h3 style="margin-bottom:12px">Admin Panel</h3>
        <hr style="margin-bottom:12px">

        <ul style="list-style:none; padding:0">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('admin.plants.index') }}">Tanaman</a></li>
            <li><a href="{{ route('admin.encyclopedia.index') }}">Ensiklopedia</a></li>
            <li><a href="{{ route('admin.forum.index') }}">Forum</a></li>
            <li><a href="{{ route('admin.reminders.index') }}">Reminder</a></li>
        </ul>
    </aside>

    <!-- CONTENT -->
    <main style="flex:1; padding:24px; background:#f9fafb">
        @yield('content')
    </main>

</div>

</body>
</html>
