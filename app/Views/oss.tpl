<html>
<head>
    <title>upload</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<form enctype="multipart/form-data" action="/AppController/oss" method="post">
    选择文件:
    <input name="userfile" type="file"><br />
    <!--<<input name="userfile[]" type="file"><br />-->
    <!--<input name="userfile[]" type="file">-->
    文件描述:
    <input name="description" type="text">
    <input type="submit" value="上传">
</form>
</body>
</html>
