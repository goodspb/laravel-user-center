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
                        <h3 class="box-title">前端</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <p>后台模板: <a href="https://almsaeedstudio.com/themes/AdminLTE/index2.html"> AdminLTE2 </a> </p>
                        <p>有需要请自行下载</p>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-header with-border">
                        <h3 class="box-title">后端</h3>
                    </div>
                    <div class="box-body">
                        <p>后端框架 <a href="https://laravel.com/docs/5.1"> Laravel 5.1 </a> </p>
                        <p>有需要请查阅使用文档</p>
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
