@extends('layouts.auth')

@section('title') {{ trans('auth.forgot') }} @endsection

@section('body-class') hold-transition login-page @endsection

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="/"><b>{{ Setting::get('app_name', '') }}</b>{{ trans('auth.forgot') }}</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        @include('public/message')
        <form action="{{ url('auth/forgot/email') }}" method="post">
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="{{ trans('auth.email') }}" name="email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('auth.forgot-btn') }}</button>
                </div>
            </div>
        </form>
        <br>
        <a href="{{ url('auth/login') }}" class="pull-left">{{ trans('auth.login') }}</a>
        <a href="{{ url('auth/register') }}" class="pull-right">{{ trans('auth.register') }}</a>
        <br>
    </div>
</div>
@endsection
