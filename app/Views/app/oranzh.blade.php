<html>
<head>
    <title>应用程序名称 - @yield('title')</title>
</head>
<body>
@section('sidebar')
    这里是名字:---{{$name}}
    这里是性别:---{{$sex}}
    <br>
    这里是时间{{date('Y-m-d ')}}
    <br>
    <?php echo date('Y-m-d H:i:s') ?>
@show

<div class="container">
    @yield('content')
</div>
</body>
</html>