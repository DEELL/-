<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>练习注册</title>
</head>
<body>
    <table border="1">
        <form action="/register/reg" method="post" enctype="multipart/form-data">
            <tr>
                <td>账号：</td>
                <td><input type="text" name="name" ></td>
            </tr>
            <tr>
                <td>手机号：</td>
                <td><input type="text" name="tel" ></td>
            </tr>
            <tr>
                <td>邮箱账号：</td>
                <td><input type="text" name="email" ></td>
            </tr>
            <tr>
                <td>密码：</td>
                <td><input type="password" name="password" ></td>
            </tr>
            <tr>
                <td>确认密码：</td>
                <td><input type="password" name="password1" ></td>
            </tr>
            <tr>
                <td>身份证件：</td>
                <td><input type="file" name="file_url" ></td>
            </tr>
            <tr>
                <td><input type="submit" value="注册"></td>
            </tr>
        </form>
    </table>
</body>
</html>