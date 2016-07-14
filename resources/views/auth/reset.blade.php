@extends('layouts.auth')

@section('title') {{ trans('auth.reset') }} @endsection

@section('body-class') hold-transition register-page @endsection

@section('content')
<div class="register-box">
    <div class="register-logo">
        <a href="{{ url('/') }}"><b>{{ Config::get('app.name') }}</b>{{ trans('auth.reset') }}</a>
    </div>

    <div class="register-box-body">
        @include('public/message')
        <form action="{{ url('auth/forget/reset') }}" method="post">
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="{{ trans('auth.password') }}" name="passport" >
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="{{ trans('auth.repeat-password') }}" name="password_confirmation" >
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <input type="hidden" name="token" value="{{ $token }}" />
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('auth.forgot-btn') }}</button>
                </div>
            </div>
        </form>
        <br>
        <a href="{{ url('auth/login') }}" class="pull-left">{{ trans('auth.login') }}</a>
        <br>
    </div>
</div>
@endsection
