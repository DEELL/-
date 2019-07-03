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
                <td>USERNAME</td>
                <td><input type="text" id="name"></td>
            </tr>
            <tr>
                <td>PASSWORD</td>
                <td><input type="password" id="pass"></td>
            </tr>
            <tr>
                <td><input type="submit" value="登录" id="sub"></td>
            </tr>

    </table>
    <script>
        $(function(){
            $('#sub').click(function(){
               var name=$('#name').val();
               var pass=$('#pass').val();
               $.post(
                   "/app/pcLogin",
                   {name:name,pass:pass},
                   function (res) {
                       if(res.error=='001'){
                           location.href="/app/Loginlist";
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
