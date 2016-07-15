@extends('layouts.admin')

@section('title') {{ trans('admin.menu_list.user') }} @endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ trans('admin.menu_list.user') }}
            <small>{{ trans('page.total', ['total'=> $total = $users->total()]) }}</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('common.search_box') }}</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <form action="{{ url('/admin/user/list') }}" method="get">
                                <div class="col-lg-2">
                                     <input name="username" value="{{ Input::get('username', '') }}" title="username" type="text" class="form-control" placeholder="{{ trans('common.username') }}">
                                </div>
                                <div class="col-lg-2">
                                     <input name="mobile" value="{{ Input::get('mobile', '') }}" type="text" class="form-control" placeholder="{{ trans('common.mobile') }}" />
                                </div>
                                <div class="col-lg-2">
                                    <input name="email" value="{{ Input::get('email', '') }}" type="text" class="form-control" placeholder="{{ trans('common.email') }}" />
                                </div>
                                <div class="col-lg-2">
                                    <input name="nickname" value="{{ Input::get('nickname', '') }}" type="text" class="form-control" placeholder="{{ trans('common.nickname') }}" />
                                </div>
                                <div class="col-lg-2">
                                    <select name="sex" class="form-control">
                                        <option @if ('' === $sex = Input::get('sex')) selected @endif value="">{{ trans('common.sex_select') }}</option>
                                        <option @if (0 === $sex) selected @endif value="0">{{ trans('common.sex_0') }}</option>
                                        <option @if (1 === $sex) selected @endif value="1">{{ trans('common.sex_1') }}</option>
                                        <option @if (2 === $sex) selected @endif value="2">{{ trans('common.sex_2') }}</option>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-default col-md-6">{{ trans('common.search') }}</button>
                                    <button type="button" class="btn btn-default col-md-6" onclick="location.href='{{ url('admin/user/list') }}';">{{ trans('common.reset') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('admin.menu_list.user_list') }}</h3>
                            <span class="pull-right"><button type="button" onclick="location='{{ url('admin/user/add') }}';" class="btn btn-success pull-right">添加</button></span>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th class="visible-lg">#</th>
                                <th class="">{{ trans('common.role') }}</th>
                                <th>{{ trans('common.avatar') }}</th>
                                <th>{{ trans('common.nickname') }}</th>
                                <th>{{ trans('common.username') }}</th>
                                <th>{{ trans('common.email') }}</th>
                                <th>{{ trans('common.mobile') }}</th>
                                <th>{{ trans('common.sex') }}</th>
                                <th>#</th>
                            </tr>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    @foreach($user->roles as $rkey => $role)
                                        @if ($rkey > 0) , @endif
                                        {{ $role->display_name }}
                                    @endforeach
                                </td>
                                <td><img src="{{ $user->profile->avatar }}" width="30" /></td>
                                <td>{{ $user->profile->nickname }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->mobile }}</td>
                                <td>{{ trans('common.sex_'.$user->profile->sex) }}</td>
                                <td>
                                    <a href="{{ url('admin/user/edit', ['id' => $user->id]) }}">{{ trans('common.manage') }}</a>
                                    <a href="#" class="delete" data-name="{{ $user->email }}" data-url="{{ url('admin/user/delete') }}" data-id="{{ $user->id }}" data-toggle="modal" data-target="#doDelete">{{ trans('common.delete') }}</a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-left">
                            <li><a href="#"> {{ $users->currentPage() }} / {{ $users->lastPage() ?: 1 }}</a></li>
                        </ul>
                        @if ($users->lastPage() != 1)
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <li><a href="{{ $users->url(1) }}">{{ trans('common.page.first') }}</a></li>
                            <li><a href="{{ $users->previousPageUrl() }}">{{ trans('common.page.prev') }}</a></li>
                            <li><a href="{{ $users->nextPageUrl() }}">{{ trans('common.page.next') }}</a></li>
                            <li><a href="{{ $users->url($users->lastPage()) }}">{{ trans('common.page.last') }}</a></li>
                        </ul>
                        @endif
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>

@endsection
