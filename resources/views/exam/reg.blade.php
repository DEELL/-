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
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <table border="1">
        <form >
            <tr>
                <td>账号：</td>
                <td><input type="text" id="name"  ></td>
            </tr>
            <tr>
                <td><input type="text" id="code" ></td>
                <td id="ce"><input type="button" value="获取验证码"></td>
            </tr>
            <tr>
                <td>密码：</td>
                <td><input type="password" id="password" ></td>
            </tr>
            <tr>
                <td>确认密码：</td>
                <td><input type="password" id="password1" ></td>
            </tr>
            <tr>
                <td><input type="button" value="注册" id="sub"></td>
            </tr>
        </form>
    </table>
<script>
    $(function () {
        // 点击获取验证码
        $('#ce').click(function () {
            var name=$('#name').val();
            if(name==''){
                alert('请填写账号');
            }
           $.post(
               "/exam/code",
               {name:name},
               function (res) {
                   if(res.error=='0001'){
                       alert(res.msg);
                   }else{
                       alert(res.msg);
                   }
               },'json'
           );
        });
        $('#sub').click(function () {
            var name=$('#name').val();
            var code=$('#code').val();
            var password=$('#password').val();
            var password1=$('#password1').val();
            if(name==''){
                alert('请填写账号');return false;
            }
            if(code==''){
                alert('请填写验证码');return false;
            }
            if(password==''){
                alert('请填写密码');return false;
            }
            if(password1==''){
                alert('请填写确认密码');return false;
            }
            if(password1 != password){
                alert('确认密码和密码不一致');return false;
            }
            $.post(
                "/exam/regDo",
                {name:name,code:code,password1:password1,password:password},
                function (res) {
                   if(res.error=='0001'){
                       alert(res.msg);
                   }else{
                       alert(res.msg);
                   }
                },'json'
            );
        })
    })
</script>
</body>
</html>