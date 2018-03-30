<html>
<head>
    <title>应用程序名称 - @yield('title')</title>
</head>
<body>
@section('sidebar')
    这里是名字:---{{$name}}
    这里是性别:---{{$sex}}
@show

<div class="container">
    @yield('content')
</div>
</body>
</html>