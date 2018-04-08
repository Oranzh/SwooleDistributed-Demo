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
    自定义设置了模板扩展名.tpl

@show

<div class="container">
    @yield('content')
</div>
</body>
</html>
