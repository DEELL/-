<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>练习登录</title>
</head>
<body>
    <table border="1">
        <form action="/register/login" method="post" >
            <tr>
                <td>账号：</td>
                <td><input type="text" name="name" ></td>
            </tr>
            <tr>
                <td>密码：</td>
                <td><input type="password" name="password" ></td>
            </tr>
            <tr>
                <td><input type="submit" value="登录"></td>
            </tr>
        </form>
    </table>
</body>
</html>