@extends('layouts.admin')

@section('title') {{ trans('admin.main_title') }} @endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            后台首页
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">服务器参数</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <dl class="dl-horizontal">
                            <dt>服务器系统</dt>
                            <dd>{{ $status['system'] }}</dd>
                            <dt>PHP运行方式</dt>
                            <dd>{{ $status['php_sapi_name'] }}</dd>
                            <dt>PHP版本号</dt>
                            <dd>{{ $status['php_version'] }}</dd>
                            <dt>服务器地址</dt>
                            <dd>{{ $status['host'] }}</dd>
                            <dt>客户端地址</dt>
                            <dd>{{ $status['remote_addr'] }}</dd>
                            <dt>HTTP协议版本</dt>
                            <dd>{{ $status['server_protocol'] }}</dd>
                        </dl>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->

@endsection

@section('js')
    <script src="{{ Config::get('app.cdn_url') }}assets/js/pages/dashboard.js"></script>
@endsection
