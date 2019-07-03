<!-- 存放在 resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Laravel学院')

@section('sidebar')
    @parent
@endsection

@section('content')
    <!-- checkout -->
    <div class="checkout pages section">
        <div class="container">
            <div class="pages-head">
                <h3>CHECKOUT</h3>
            </div>
            <div class="checkout-content">
                <div class="row">
                    <div class="col s12">
                        <ul class="collapsible" data-collapsible="accordion">
                            {{--<li>--}}
                                {{--<div class="collapsible-header active"><h5>1 - Checkout Method</h5></div>--}}
                                {{--<div class="collapsible-body">--}}
                                    {{--<h6>Checkout as a Guest or Register</h6>--}}
                                    {{--<form action="#" class="checkout-radio">--}}
                                        {{--<p>--}}
                                            {{--<input type="radio" class="with-gap" id="guest-checkout" name="group1">--}}
                                            {{--<label for="guest-checkout"><span>Guest Checkout</span></label>--}}
                                        {{--</p>--}}
                                        {{--<p>--}}
                                            {{--<input type="radio" class="with-gap" id="register" name="group1">--}}
                                            {{--<label for="register"><span>Register</span></label>--}}
                                        {{--</p>--}}
                                    {{--</form>--}}
                                    {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis sunt</p>--}}
                                    {{--<a href="" class="btn button-default">CONTINUE</a>--}}
                                    {{--<div class="checkout-login">--}}
                                        {{--<div class="row">--}}
                                            {{--<form class="col s12">--}}
                                                {{--<h6>Login</h6>--}}
                                                {{--<p>Lorem ipsum dolor sit amet.</p>--}}
                                                {{--<div class="input-field">--}}
                                                    {{--<h5>Username/Email</h5>--}}
                                                    {{--<input type="text" class="validate" required>--}}
                                                {{--</div>--}}
                                                {{--<div class="input-field">--}}
                                                    {{--<h5>Password</h5>--}}
                                                    {{--<input type="password" class="validate" required>--}}
                                                {{--</div>--}}
                                                {{--<a href=""><h6>Forgot Password ?</h6></a>--}}
                                                {{--<a href="" class="btn button-default">LOGIN</a>--}}
                                            {{--</form>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            <li>
                                <div class="collapsible-header"><h5>1 - Billing Information</h5></div>
                                <div class="collapsible-body">
                                    <div class="billing-information">
                                        <form action="#">
                                            <div class="input-field">
                                                <h5>Name*</h5>
                                                <input type="text" class="validate" required id="name">
                                            </div>
                                            <div class="input-field">
                                                <h5>Email*</h5>
                                                <input type="email" class="validate" required id="email">
                                            </div>
                                            <div class="input-field">
                                                <h5>Company Name</h5>
                                                <input type="text" class="validate" id="company">
                                            </div>
                                            <div class="input-field">
                                                <h5>Address*</h5>
                                                <input type="text" class="validate" required id="addr">
                                            </div>
                                            <div class="input-field">
                                                <h5>Town/City*</h5>
                                                <input type="text" class="validate" required id="city">
                                            </div>
                                            <div class="input-field">
                                                <h5>State/Country*</h5>
                                                <input type="text" class="validate" required id="country">
                                            </div>
                                            <div class="input-field">
                                                <h5>Portalcode/ZIP*</h5>
                                                <input type="number" class="validate" required id="postcode">
                                            </div>
                                            <div class="input-field">
                                                <h5>Phone*</h5>
                                                <input type="number" class="validate" required id="tel">
                                            </div>
                                            <a  class="btn button-default">CONTINUE</a>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            {{--<li>--}}
                                {{--<div class="collapsible-header"><h5>2 - Shipping Information</h5></div>--}}
                                {{--<div class="collapsible-body">--}}
                                    {{--<div class="shipping-information">--}}
                                        {{--<form action="#">--}}
                                            {{--<div class="input-field">--}}
                                                {{--<h5>Name*</h5>--}}
                                                {{--<input type="text" class="validate" required>--}}
                                            {{--</div>--}}
                                            {{--<div class="input-field">--}}
                                                {{--<h5>Email*</h5>--}}
                                                {{--<input type="email" class="validate" required>--}}
                                            {{--</div>--}}
                                            {{--<div class="input-field">--}}
                                                {{--<h5>Company Name</h5>--}}
                                                {{--<input type="text" class="validate">--}}
                                            {{--</div>--}}
                                            {{--<div class="input-field">--}}
                                                {{--<h5>Address*</h5>--}}
                                                {{--<input type="text" class="validate" required>--}}
                                            {{--</div>--}}
                                            {{--<div class="input-field">--}}
                                                {{--<h5>Town/City*</h5>--}}
                                                {{--<input type="text" class="validate" required>--}}
                                            {{--</div>--}}
                                            {{--<div class="input-field">--}}
                                                {{--<h5>State/Country*</h5>--}}
                                                {{--<input type="text" class="validate" required>--}}
                                            {{--</div>--}}
                                            {{--<div class="input-field">--}}
                                                {{--<h5>Portalcode/ZIP*</h5>--}}
                                                {{--<input type="number" class="validate" required>--}}
                                            {{--</div>--}}
                                            {{--<div class="input-field">--}}
                                                {{--<h5>Phone*</h5>--}}
                                                {{--<input type="number" class="validate" required>--}}
                                            {{--</div>--}}
                                            {{--<a href="" class="btn button-default">CONTINUE</a>--}}
                                        {{--</form>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            <li>
                                <div class="collapsible-header"><h5>2 - Payment Mode</h5></div>
                                <div class="collapsible-body">
                                    <div class="payment-mode">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur provident repellat</p>
                                        <form action="#" class="checkout-radio">
                                            <div class="input-field">
                                                <input type="radio" class="with-gap" id="online-payments" name="group1">
                                                <label for="online-payments"><span>Online Payments</span></label>
                                            </div>

                                            <a href="" class="btn button-default">CONTINUE</a>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header"><h5>3 - Order Review</h5></div>
                                <div class="collapsible-body">
                                    <div class="order-review">
                                        <div class="row">
                                            @if($cartar)
                                            @foreach($cartar as $k=>$v)
                                            <div class="col s12" goods_id="{{$v['goods_id']}}">
                                                <div class="cart-details">
                                                    <div class="col s5">
                                                        <div class="cart-product">
                                                            <h5 class="goods" goods_id="{{$v['goods_id']}}">Image</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col s7">
                                                        <div class="cart-product">
                                                            <img src="{{$v['goods_img']}}" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="cart-details">
                                                    <div class="col s5">
                                                        <div class="cart-product">
                                                            <h5>Name</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col s7">
                                                        <div class="cart-product">
                                                            <a href="">{{$v['desc']}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="cart-details">
                                                    <div class="col s5">
                                                        <div class="cart-product">
                                                            <h5>Quantity</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col s7">
                                                        <div class="cart-product">
                                                            <input type="text" value="{{$v['buy_number']}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="cart-details">
                                                    <div class="col s5">
                                                        <div class="cart-product">
                                                            <h5>Unit Price</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col s7">
                                                        <div class="cart-product">
                                                            <span>${{$v['goods_price']}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="cart-details">
                                                    <div class="col s5">
                                                        <div class="cart-product">
                                                            <h5>Total Price</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col s7">
                                                        <div class="cart-product">
                                                            <span>${{$v['money']}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                @endforeach
                                                @else
                                                <h3 style="text-align:center;color: #304ffe">(＾－＾)没有商品</h3>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="order-review final-price">
                                        <div class="row">
                                            <div class="col s12">
                                                {{--<div class="cart-details">--}}
                                                    {{--<div class="col s8">--}}
                                                        {{--<div class="cart-product">--}}
                                                            {{--<h5>Sub Total</h5>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col s4">--}}
                                                        {{--<div class="cart-product">--}}
                                                            {{--<span>$26.00</span>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="cart-details">--}}
                                                    {{--<div class="col s8">--}}
                                                        {{--<div class="cart-product">--}}
                                                            {{--<h5>Flat Shipping Rate:</h5>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col s4">--}}
                                                        {{--<div class="cart-product">--}}
                                                            {{--<span>$5.00</span>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                <div class="cart-details">
                                                    <div class="col s8">
                                                        <div class="cart-product">
                                                            <h5>Total</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col s4">
                                                        <div class="cart-product">
                                                            <span>${{$money}}.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a id="btu" class="btn button-default button-fullwidth">CONTINUE</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#btu').click(function () {
                var name=$('#name').val();//姓名*
                var email=$('#email').val();//电子邮件*
                var company=$('#company').val();//公司名称
                var addr=$('#addr').val();//地址*
                var city=$('#city').val();//城镇/城市*
                var country=$('#country').val();//国家/国家
                var postcode=$('#postcode').val();//邮编
                var tel=$('#tel').val();//电话*
                var gap=$('#online-payments').prop('checked');//付款方式
                var  goods_id =$('.goods').attr('goods_id');
                // alert(goods_id);
                if(goods_id==undefined){
                    alert('选择商品商品');return false;
                }
                if(name==''){
                    alert('请填写Name'); return false;
                }
                if(email==''){
                    alert('请填写Email');return false;
                }
                if(company==''){
                    alert('请填写Company Name');return false;
                }
                if(addr==''){
                    alert('请填写Address');return false;
                }
                if(city==''){
                    alert('请填写Town/City');return false;
                }
                if(country==''){
                    alert('请填写State/Country');return false;
                }
                if(postcode==''){
                    alert('请填写Portalcode/ZIP');return false;
                }
                if(tel==''){
                    alert('请填写Phone');return false;
                }
                if(gap==false){
                    alert('请选择方式');return false;
                }
                $.post(
                "/settle/settle",
                {name:name,email:email,company:company,addr:addr,city:city,country:country,postcode:postcode,tel:tel,gap:gap},
                function (res) {
                    if(res.error=='0002'){
                        alert(res.msg);
                        location.href="/settle/payment";
                    }else{
                        alert(res.msg);
                    }
                },'json'
            );
        })
        })
    </script>
    <!-- end checkout -->
@endsection