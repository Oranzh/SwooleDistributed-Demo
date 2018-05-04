
@includeIf('app::side')
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>系好安全带,准备启航</title>
    <h1>This is Blade Demo1</h1>
    <script type="text/javascript" >
        function attackEnemy() {
            document.write("land on");
            alert("ready go");
        }
    </script>

</head>
<body>
<form>
    <input type="button" value="开始游戏" onclick="attackEnemy()"/>
</form>
</body>
</html>