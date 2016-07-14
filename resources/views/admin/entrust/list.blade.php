@extends('layouts.admin')

@section('title') {{ trans('admin.menu_list.'.$type) }} @endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ trans('admin.menu_list.'.$type) }}
            <small>{{ trans('page.total', ['total'=> $total = $lists->total()]) }}</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('admin.menu_list.'.$type.'_list') }}</h3>
                        <span class="pull-right"><button type="button" onclick="location='{{ url('admin/'.$type.'/add') }}';" class="btn btn-success pull-right">{{ trans('common.add') }}</button></span>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th class="visible-lg">#</th>
                                <th>{{ trans('admin.'.$type.'.name') }}</th>
                                <th>{{ trans('admin.'.$type.'.display_name') }}</th>
                                <th>{{ trans('admin.'.$type.'.description') }}</th>
                                <th>{{ trans('admin.created_at') }}</th>
                                <th>{{ trans('admin.updated_at') }}</th>
                                <th>#</th>
                            </tr>
                            @if ($lists->total() > 0)
                                @foreach($lists as $list)
                                <tr>
                                    <td>{{ $list->id }}</td>
                                    <td>{{ $list->name }}</td>
                                    <td>{{ $list->display_name }}</td>
                                    <td>{{ str_limit($list->description, 30) }}</td>
                                    <td>{{ $list->created_at }}</td>
                                    <td>{{ $list->updated_at }}</td>
                                    <td>
                                        @if ($type == 'role')
                                            <a href="{{ url('admin/role/permission', ['id' => $list->id]) }}">{{ trans('admin.menu_list.permission_role') }}</a>
                                        @endif
                                        <a href="{{ url('admin/'.$type.'/edit', ['id' => $list->id]) }}">{{ trans('common.manage') }}</a>
                                        <a href="#" class="delete" data-name="{{ $list->name }}" data-url="{{ url('admin/'.$type.'/delete') }}" data-id="{{ $list->id }}" data-toggle="modal" data-target="#doDelete">{{ trans('common.delete') }}</a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr><td style="text-align: center;" colspan="7">{{ trans('common.empty') }}</td></tr>
                            @endif
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-left">
                            <li><a href="#"> {{ $lists->currentPage() }} / {{ $lists->lastPage() }}</a></li>
                        </ul>
                        @if ($lists->lastPage() != 1)
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <li><a href="{{ $lists->url(1) }}">{{ trans('common.page.first') }}</a></li>
                            <li><a href="{{ $lists->previousPageUrl() }}">{{ trans('common.page.prev') }}</a></li>
                            <li><a href="{{ $lists->nextPageUrl() }}">{{ trans('common.page.next') }}</a></li>
                            <li><a href="{{ $lists->url($lists->lastPage()) }}">{{ trans('common.page.last') }}</a></li>
                        </ul>
                        @endif
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>

@endsection
