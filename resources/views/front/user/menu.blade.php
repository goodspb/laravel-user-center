<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">{{ trans('admin.menu') }}</li>
            <li class="active treeview">
                <a href="{{ url('/user/profile') }}">
                    <i class="fa fa-files-o"></i>
                    <span>{{ trans('user.menu_list.profile_edit') }}</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
