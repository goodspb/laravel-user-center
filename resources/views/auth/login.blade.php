@extends('layouts.auth')

@section('title') {{ trans('auth.login') }} @endsection

@section('css')
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ Setting::get('cdn_url', '/') }}plugins/iCheck/square/blue.css">
@endsection

@section('body-class') hold-transition login-page @endsection

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="/"><b>{{ Setting::get('app_name', '') }}</b>{{ trans('auth.login') }}</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        @include('public/message')
        <form action="{{ url('auth/login') }}" method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="{{ trans('auth.email') }}" name="email" value="{{ old('email') }}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="{{ trans('auth.password') }}" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember"> {{ trans('auth.remember') }}
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('auth.login-btn') }}</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <a href="{{ url('auth/forgot/email') }}" class="pull-left">{{ trans('auth.forgot') }}</a>
        <a href="{{ url('auth/register') }}" class="pull-right">{{ trans('auth.register') }}</a>
        <br>
    </div>
</div>
@endsection

@section('js')
<!-- iCheck -->
<script src="{{ Setting::get('cdn_url', '/') }}plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
@endsection
