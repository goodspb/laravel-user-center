@extends('layouts.admin')

@section('title') {{ trans('admin.menu_list.setting') }}  @endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        @include('public/message')
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('admin.menu_list.setting') }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{ url('admin/setting/edit') }}" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="app_name" class="col-sm-2 control-label">{{ trans('admin.settings.app_name') }}</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="app_name" name="app_name" value="{{ array_get($settings, 'app_name', old('app_name')) }}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cdn_url" class="col-sm-2 control-label">{{ trans('admin.settings.cdn_url') }}</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="cdn_url" name="cdn_url" value="{{ array_get($settings, 'cdn_url', old('cdn_url', '/')) }}" >
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-cancel pull-left" onclick="location='{{ url('admin/host/list') }}';">{{ trans('common.return') }}</button>
                    @if (isset($item))
                        <input type="hidden" name="id" value="{{ $item->id }}" />
                        <button type="submit" class="btn btn-info pull-right">{{ trans('common.edit') }}</button>
                    @else
                        <button type="submit" class="btn btn-success pull-right">{{ trans('common.save') }}</button>
                    @endif
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box -->
    </section>

@endsection
