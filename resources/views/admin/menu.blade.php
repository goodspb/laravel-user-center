<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">{{ trans('admin.menu') }}</li>
            @foreach($menus as $menu)
                <li class="active treeview">
                    <a href="{{ url(array_get($menu, 'url', '#')) }}">
                        <i class="{!! array_get($menu, 'icon', 'fa fa-files-o') !!}"></i>
                        <span>{{ trans(array_get($menu, 'label', '')) }}</span>
                        {!! array_has($menu, 'children') && !empty(array_get($menu, 'children')) ? '<i class="fa fa-angle-left pull-right"></i>' : '' !!}
                    </a>
                    @if (array_has($menu, 'children') && !empty($children = array_get($menu, 'children')))
                        <ul class="treeview-menu">
                            @foreach($children as $childrenMenu)
                                <li>
                                    <a href="{{ url(array_get($childrenMenu, 'url', '#')) }}">
                                        <i class="{!! array_get($childrenMenu, 'icon', 'fa fa-circle-o') !!}"></i> {{ trans(array_get($childrenMenu, 'label', '')) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
