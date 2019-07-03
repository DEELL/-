<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pc登录</title>
</head>
<script src="{{asset('js/jquery.min.js')}}"></script>
<body>
<table border="1">
    <tr>
        <td>用户</td>
        <td>登录地址</td>
        <td>操作</td>
    </tr>
    <tr>
        <td><input type="text" value="{{$u->name}}"></td>
        @if($u->status==1)
        <td><input type="text" value="pc端登录"></td>
        @else
            <td><input type="text" value="APP登录"></td>
        @endif
        <td><button id="sub">下线</button></td>
    </tr>
</table>

    <script>
        // 每隔3秒请求一次  发送ajax
        var t = setInterval("checkLogin()",3000);
        function checkLogin() {
            $.post(
                "/app/LoginlistDo",
                function (res) {
                    console.log(res);
                    if (res.error == '0001') {
                        clearInterval(t);
                        location.href = "/app/pcLogin";
                        alert(res.msg);
                    } else {
                        clearInterval(t);
                        location.href = "/app/pcLogin";
                        alert(res.msg);
                    }
                }, 'json'
            );
        }
        // 强制下线
        $(function () {
            $('#sub').click(function () {
                $.post(
                    "/app/Downline",
                    function (res) {
                        console.log(res);
                    }
                );
            })
        })
    </script>
</body>
</html>
