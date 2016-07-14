<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>

    <link href="http://fonts.useso.com/css?family=Lato:100" rel="stylesheet" type="text/css" media="none" onload="if(media!='all')media='all'">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 72px;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        @yield('content')
    </div>
</div>
</body>
</html>
