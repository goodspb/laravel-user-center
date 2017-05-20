<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">{{ trans('admin.menu') }}</li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>{{ trans('admin.menu_list.site') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/setting') }}"><i class="fa fa-circle-o"></i> {{ trans('admin.menu_list.setting') }}</a></li>
                </ul>
            </li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>{{ trans('admin.menu_list.user') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/user/list') }}"><i class="fa fa-circle-o"></i> {{ trans('admin.menu_list.user_list') }}</a></li>
                    <li><a href="{{ url('admin/user/add') }}"><i class="fa fa-circle-o"></i> {{ trans('admin.menu_list.user_add') }}</a></li>
                </ul>
            </li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>{{ trans('admin.menu_list.entrust') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/role/list') }}"><i class="fa fa-circle-o"></i> {{ trans('admin.menu_list.role') }}</a></li>
                    <li><a href="{{ url('admin/permission/list') }}"><i class="fa fa-circle-o"></i> {{ trans('admin.menu_list.permission') }}</a></li>
                </ul>
            </li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>{{ trans('admin.menu_list.oauth') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/oauth/client/list') }}"><i class="fa fa-circle-o"></i> {{ trans('admin.menu_list.oauth_client') }}</a></li>
                    <li><a href="{{ url('admin/oauth/scope/list') }}"><i class="fa fa-circle-o"></i> {{ trans('admin.menu_list.oauth_scope') }}</a></li>
{{--                    <li><a href="{{ url('admin/oauth/grant/list') }}"><i class="fa fa-circle-o"></i> {{ trans('admin.menu_list.oauth_grant') }}</a></li>--}}
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
