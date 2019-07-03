<!-- 存放在 resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Laravel学院')

@section('sidebar')
    @parent

@endsection

@section('content')
    <!-- register -->
    <div class="pages section">
        <div class="container">
            <div class="pages-head">
                <h3>REGISTER</h3>
            </div>
            <div class="register">
                <div class="row">
                    <form class="col s12">
                        <div class="input-field">
                            <input type="text" class="validate" placeholder="NAME" required id="name">
                        </div>
                        <div class="input-field">
                            <input type="email" placeholder="EMAIL" class="validate" required id="email">
                        </div>
                        <div class="input-field">
                            <input type="password" placeholder="PASSWORD" class="validate" required id="pass">
                        </div>
                        <div class="input-field">
                            <input type="password" placeholder="PASSWORD1" class="validate" required id="pass1">
                        </div>
                        <div  id="sub" class="btn button-default">REGISTER</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end register -->
    <script>
        $(function () {
            $('#sub').click(function () {
                var name =$('#name').val();
                var email =$('#email').val();
                var password= $('#pass').val();
                var password1= $('#pass1').val();
                if(name==''){
                    alert('NAME不能为为空'); return false;
                }
                if(email==''){
                    alert('EMAIL不能为为空'); return false;
                }
                if(password==''){
                    alert('PASSWORD不能为为空'); return false;
                }
                if(password1 !=password){
                    alert('PASSWORD与PASSWORD1不一致'); return false;
                }
                $.post(
                    "/user/reg",
                    {name:name,email:email,password:password,password1:password1},
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
@endsection

