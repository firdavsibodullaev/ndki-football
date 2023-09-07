<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-users mr-2"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.profile.edit') }}"
                   class="dropdown-item">
                    <i class="fas fa-user"></i> {{ __('Профиль') }}
                </a>
                <div class="dropdown-divider"></div>
                <a href="javascript:void(0)"
                   onclick="$('#logout-form').submit()"
                   class="dropdown-item">
                    <i class="fas fa-sign-out-alt"></i> {{ __('Выйти') }}
                </a>
                <div class="dropdown-divider"></div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
<form action="{{ route('admin.logout') }}" id="logout-form" method="post">@csrf</form>
