<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('badung-logo.png') }}" alt="Brand Logo" class="w-px-40 h-auto">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Admin</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->is('admin/dashboard') ? 'active open' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Articles</span>
        </li>
        <li
            class="menu-item {{ request()->is('admin/post*') ? 'active open' : '' }} {{ request()->is('admin/category*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div>News</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('admin/post*') ? 'active open' : '' }}">
                    <a href="{{ route('admin.post.index') }}" class="menu-link">
                        <div>List</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('admin/category*') ? 'active open' : '' }}">
                    <a href="{{ route('admin.category.index') }}" class="menu-link">
                        <div>Category</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Management</span>
        </li>
        <li class="menu-item {{ request()->is('admin/users*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Account Settings">User</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('admin/users') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}" class="menu-link">
                        <div data-i18n="Notifications">List</div>
                    </a>
                </li>
                @can('view role')
                    <li class="menu-item {{ request()->is('admin/users/roles') ? 'active' : '' }}">
                        <a href="{{ route('admin.users.roles.index') }}" class="menu-link">
                            <div data-i18n="role">Role</div>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    </ul>
</aside>