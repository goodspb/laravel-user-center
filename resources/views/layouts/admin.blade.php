<!DOCTYPE html>
<html>
<head>
    <?php $cdnUrl = Config::get('app.cdn_url'); ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <title>@yield('title', '') | {{ Config::get('app.name') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Load google font-->
    <link rel="stylesheet" href="http://fonts.useso.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"  media="none" onload="if(media!='all')media='all'">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ $cdnUrl }}assets/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ $cdnUrl }}assets/css/skins/_all-skins.min.css">
    @yield('css')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="@yield('body-class', 'sidebar-mini skin-black-light wysihtml5-supported')">
<div class="wrapper">
    @include('admin.header')
    @include('admin.menu')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
    @include('admin.footer')
</div>
<!-- js -->
<script src="http://cdn.bootcss.com/jquery/2.2.0/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="{{ $cdnUrl }}assets/js/app.min.js"></script>
<script src="{{ $cdnUrl }}assets/js/common.js"></script>
@yield('js')
@include('public.modal')
</body>
</html>
