@extends('layouts.admin')

@section('title') {{ trans('admin.menu_list.oauth') }} @endsection

@section('css')
<link rel="stylesheet" href="{{ Setting::get('cdn_url', '/') }}plugins/select2/select2.min.css">
@endsection

@section('content')

    <section class="content-header">
        <h1>
            {{ trans('admin.menu_list.oauth_scope') }}
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('public/message')
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                @if (isset($item))
                <h3 class="box-title">
                    {{ trans('admin.menu_list.oauth_scope_edit') }}
                    <small>Client Id: {{ $item->id }}</small>
                </h3>
                @else
                    <h3 class="box-title">{{ trans('admin.menu_list.oauth_scope_add') }}</h3>
                @endif
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{ isset($item) ? url('admin/oauth/scope/edit') :  url('admin/oauth/scope/add') }}" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="oauth_scope_id" class="col-sm-2 control-label">{{ trans('common.oauth_scope_id') }}</label>
                        <div class="col-sm-10">
                            @if (isset($item))
                            <input type="text" class="form-control" id="oauth_scope_id" value="{{ $item->id }}" readonly>
                            @else
                                <input type="text" class="form-control" id="oauth_scope_id" name="oauth_scope_id" value="{{ old('oauth_scope_id') }}" >
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="oauth_scope_description" class="col-sm-2 control-label">{{ trans('common.oauth_scope_description') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="oauth_scope_description" name="oauth_scope_description" value="{{ isset($item) ? $item->description : old('oauth_scope_description') }}" >
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-cancel pull-left" onclick="location='{{ url('admin/oauth/scope/list') }}';">{{ trans('common.return') }}</button>
                    @if (isset($item))
                        <input type="hidden" name="id" value="{{ $item->id }}" />
                        <button type="submit" class="btn btn-info pull-right">{{ trans('common.edit') }}</button>
                    @else
                        <button type="submit" class="btn btn-success pull-right">{{ trans('common.add') }}</button>
                    @endif
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box -->
    </section>

@endsection

@section('js')
<script src="{{ Setting::get('cdn_url', '/') }}plugins/select2/select2.full.min.js"></script>
<script src="{{ Setting::get('cdn_url', '/') }}plugins/select2/i18n/zh-CN.js"></script>
<script>
    $(function(){
        $("#oauth_client_scope").select2({
            placeholder: "{{ trans('common.role_select') }}",
            language: "zh-CN"
        });
    });
</script>
@endsection
