<div class="menu">

    <div class="menu-title">
        Menu Admin
    </div>

    <a href="{{ route('admin.dashboard') }}"
       class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        Dashboard
    </a>

    <div class="menu-section">
        Konten
    </div>

    <a href="{{ route('admin.encyclopedia.index') }}"
       class="menu-link {{ request()->routeIs('admin.encyclopedia.*') ? 'active' : '' }}">
        Ensiklopedia
    </a>

    <a href="{{ route('admin.posts.index') }}"
       class="menu-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
        Postingan
    </a>

    <a href="{{ route('admin.forums.index') }}"
       class="menu-link {{ request()->routeIs('admin.forums.*') ? 'active' : '' }}">
        Forum Diskusi
    </a>

    <div class="menu-section">
        Sistem
    </div>

    <a href="{{ route('admin.reminders.index') }}"
       class="menu-link {{ request()->routeIs('admin.reminders.*') ? 'active' : '' }}">
        Pengingat
    </a>

</div>
