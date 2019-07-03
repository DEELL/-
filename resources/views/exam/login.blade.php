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
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <table border="1">
        <form >
            <tr>
                <td>账号：</td>
                <td><input type="text" id="name"></td>
            </tr>
            <tr>
                <td>密码：</td>
                <td><input type="password" id="password" ></td>
            </tr>
            <tr>
                <td><input type="button" value="登录" id="sub"></td>
            </tr>
        </form>
    </table>
<script>
    $(function () {
        $('#sub').click(function () {
            var name=$('#name').val();
            var password=$('#password').val();
            if(name==''){
                alert('请填写账号');return false;
            }
            if(password==''){
                alert('请填写密码');return false;
            }
            $.post(
                "/exam/loginDo",
                {name:name,password:password},
                function (res) {
                   if(res.error==1){
                        alert(res.msg);
                        location.href='/exam/index';
                   }
                },'json'
            );
        })
    })
</script>
</body>
</html>