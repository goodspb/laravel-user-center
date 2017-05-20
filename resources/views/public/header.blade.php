<header class="main-header">
    <!-- Logo -->
    <a href="/admin" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">{{ trans('admin.main_title') }}</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>{{ Setting::get('app_name', '') }}</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ $auth_user->profile->avatar }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ $auth_user['email'] }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ $auth_user->profile->avatar }}" class="img-circle" alt="User Image">
                            <p>
                                {{ $auth_user->email }}@if ($auth_user->username) - {{ $auth_user->username }} @endif
                                <small>{{ trans('admin.created_at')." : ".$auth_user->created_at }}</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ url('/user/profile') }}" class="btn btn-default btn-flat">{{ trans('admin.profile') }}</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/auth/logout') }}" class="btn btn-default btn-flat">{{ trans('admin.logout') }}</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
