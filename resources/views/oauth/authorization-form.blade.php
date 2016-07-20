@extends('layouts.auth')

@section('title') {{ trans('oauth.authorize-title') }} @endsection

@section('body-class') hold-transition login-page @endsection

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="/"><b>{{ trans('oauth.authorize-title') }}</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">

            <h2>{{$client->getName()}}</h2>
            <form method="post" action="{{route('oauth.authorize.post', $params)}}">
                {{ csrf_field() }}
                <input type="hidden" name="client_id" value="{{$params['client_id']}}">
                <input type="hidden" name="redirect_uri" value="{{$params['redirect_uri']}}">
                <input type="hidden" name="response_type" value="{{$params['response_type']}}">
                <input type="hidden" name="state" value="{{$params['state']}}">
                <input type="hidden" name="scope" value="{{$params['scope']}}">

                <button type="submit" class="btn btn-primary btn-block btn-flat" name="approve" value="1">{{ trans('oauth.approve') }}</button>
                <button type="submit" class="btn btn-cancle btn-block btn-flat" name="deny" value="1">{{ trans('oauth.deny') }}</button>
            </form>
            <br>
        </div>
    </div>
@endsection

