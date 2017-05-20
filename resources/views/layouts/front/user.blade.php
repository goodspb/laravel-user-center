<!DOCTYPE html>
<html>
<head>
    <?php $cdnUrl = Setting::get('cdn_url', '/'); ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <title>@yield('title', '') | {{ Setting::get('app_name', '') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="//cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="//cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css">
    @yield('css')
    <!-- Load google font-->
    <link rel="stylesheet" href="//fonts.gmirror.org/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"  media="none" onload="if(media!='all')media='all'">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ $cdnUrl }}assets/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ $cdnUrl }}assets/css/skins/_all-skins.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- ADD THE CLASS layout-boxed TO GET A BOXED LAYOUT -->
<body class="layout-boxed sidebar-mini skin-black-light">
<!-- Site wrapper -->
<div class="wrapper">

    @include('public.header')
    @include('front.user.menu')
    <div class="content-wrapper">
        @yield('content')
    </div>

    @include('public.footer')

</div>
<!-- ./wrapper -->

<script src="//cdn.bootcss.com/jquery/2.2.0/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="{{ $cdnUrl }}assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{ $cdnUrl }}assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{ $cdnUrl }}assets/js/app.min.js"></script>
@yield('js')
</body>
</html>
