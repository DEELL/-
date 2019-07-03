<!-- 存放在 resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Laravel学院')

@section('sidebar')
    @parent
@endsection

@section('content')
    <!-- login -->
    <div class="pages section">
        <div class="container">
            <div class="pages-head">
                <h3>LOGIN</h3>
            </div>
            <div class="login">
                <div class="row">
                    <form class="col s12">
                        <div class="input-field">
                            <input type="text" class="validate" placeholder="USERNAME" required id="name">
                        </div>
                        <div class="input-field">
                            <input type="password" class="validate" placeholder="PASSWORD" required id="pass">
                        </div>
                        <a href=""><h6>Forgot Password ?</h6></a>
                        <a class="btn button-default" id="sub">LOGIN</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end login -->
    <script>
        $(function () {
            $('#sub').click(function () {
               var name=$('#name').val();
               var pass=$('#pass').val();
                if(name==''){
                    alert('USERNAME不能为为空'); return false;
                }
                if(pass==''){
                    alert('PASSWORD不能为为空'); return false;
                }
                $.post(
                    "/user/login",
                    {name:name,pass:pass},
                    function (res) {
                        if(res.error=='0001'){
                            alert(res.msg);
                        }else{
                            location.href="/";
                            alert(res.msg);
                        }
                    },'json'
                );
            })
        })
    </script>
@endsection