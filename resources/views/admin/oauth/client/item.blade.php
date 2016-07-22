@extends('layouts.admin')

@section('title') {{ trans('admin.menu_list.oauth') }} @endsection

@section('css')
<link rel="stylesheet" href="{{ Config::get('app.cdn_url') }}plugins/select2/select2.min.css">
@endsection

@section('content')

    <section class="content-header">
        <h1>
            {{ trans('admin.menu_list.oauth_client') }}
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
                    {{ trans('admin.menu_list.oauth_client_edit') }}
                    <small>Client Id: {{ $item->id }}</small>
                </h3>
                @else
                    <h3 class="box-title">{{ trans('admin.menu_list.oauth_client_add') }}</h3>
                @endif
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{ isset($item) ? url('admin/oauth/client/edit') :  url('admin/oauth/client/add') }}" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="oauth_client_id" class="col-sm-2 control-label">{{ trans('common.oauth_client_id') }}</label>
                        <div class="col-sm-10">
                            @if (isset($item))
                                <input type="text" class="form-control" id="oauth_client_id" value="{{ $item->id }}" readonly>
                            @else
                                <input type="text" class="form-control" id="oauth_client_id" name="oauth_client_id" value="{{ old('oauth_client_id') }}" >
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="oauth_client_secret" class="col-sm-2 control-label">{{ trans('common.oauth_client_secret') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="oauth_client_secret" name="oauth_client_secret" value="{{ isset($item) ? $item->secret : old('oauth_client_secret') }}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="oauth_client_name" class="col-sm-2 control-label">{{ trans('common.oauth_client_name') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="oauth_client_name" name="oauth_client_name"
                                   value="{{ isset($item) ? $item->name : old('oauth_client_name') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="oauth_client_redirect_uri" class="col-sm-2 control-label">{{ trans('common.oauth_client_redirect_uri') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="oauth_client_redirect_uri" name="oauth_client_redirect_uri"
                                   value="{{ isset($item) ? $item->endpoint->redirect_uri : old('oauth_client_redirect_uri') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="oauth_client_scope" class="col-sm-2 control-label">{{ trans('common.oauth_client_scope') }}</label>
                        <div class="col-sm-10">
                            <select name="oauth_client_scope[]" id="oauth_client_scope" class="form-control" multiple="multiple">
                                @foreach($scopes as $scope)
                                    <option @if(isset($item))
                                                @foreach($item->scopes as $uScope)
                                                    @if($uScope->id == $scope->id) selected @endif
                                                @endforeach
                                            @else
                                                @if ($oldScope = old('oauth_client_scope'))
                                                    @foreach($oldScope as $oScope)
                                                         @if($oScope == $scope->id) selected @endif
                                                    @endforeach
                                                @endif
                                            @endif
                                    value="{{ $scope->id }}">{{ $scope->id }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{--
                    <div class="form-group">
                        <label for="oauth_client_grant" class="col-sm-2 control-label">{{ trans('common.oauth_client_grant') }}</label>
                        <div class="col-sm-10">
                            <select name="oauth_client_grant[]" id="oauth_client_grant" class="form-control" multiple="multiple">
                                @foreach($grants as $grant)
                                    <option @if(isset($item)) @foreach($item->grants as $uGrant) @if($uGrant->id == $grant->id) selected @endif @endforeach @endif value="{{ $grant->id }}">{{ $grant->id }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    --}}
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-cancel pull-left" onclick="location='{{ url('admin/oauth/client/list') }}';">{{ trans('common.return') }}</button>
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
<script src="{{ Config::get('app.cdn_url') }}plugins/select2/select2.full.min.js"></script>
<script src="{{ Config::get('app.cdn_url') }}plugins/select2/i18n/zh-CN.js"></script>
<script>
    $(function(){
        $("#oauth_client_scope").select2({
            placeholder: "{{ trans('common.oauth_client_scope_select') }}",
            language: "zh-CN"
        });
        $('#oauth_client_grant').select2({
            placeholder: "{{ trans('common.oauth_client_grant_select') }}",
            language: "zh-CN"
        });
    });
</script>
@endsection
