<div class="menu">
    <a href="{{ route('user.dashboard') }}"
       class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
        Dashboard
    </a>

    <a href="{{ route('user.forums.index') }}"
       class="{{ request()->routeIs('user.forums.*') ? 'active' : '' }}">
        Forum Diskusi
    </a>

    <a href="{{ route('user.posts.index') }}"
       class="{{ request()->routeIs('user.posts.*') ? 'active' : '' }}">
        Post
    </a>

    <a href="{{ route('user.encyclopedia.index') }}"
       class="{{ request()->routeIs('user.encyclopedia.*') ? 'active' : '' }}">
        Ensiklopedia
    </a>

    <a href="{{ route('user.reminders.index') }}"
       class="{{ request()->routeIs('user.reminders.*') ? 'active' : '' }}">
        Pengingat
    </a>
</div>
