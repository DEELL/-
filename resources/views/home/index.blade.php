<!-- 存放在 resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', '首页')

@section('sidebar')
    @parent
@endsection

@section('content')
    <!-- slider -->
    <div class="slider">

        <ul class="slides">
            <li>
                <img src="img/slide1.jpg" alt="">
                <div class="caption slider-content  center-align">
                    <h2>WELCOME TO MSTORE</h2>
                    <h4>Lorem ipsum dolor sit amet.</h4>
                    <a href="" class="btn button-default">SHOP NOW</a>
                </div>
            </li>
            <li>
                <img src="img/slide2.jpg" alt="">
                <div class="caption slider-content center-align">
                    <h2>JACKETS BUSINESS</h2>
                    <h4>Lorem ipsum dolor sit amet.</h4>
                    <a href="" class="btn button-default">SHOP NOW</a>
                </div>
            </li>
            <li>
                <img src="img/slide3.jpg" alt="">
                <div class="caption slider-content center-align">
                    <h2>FASHION SHOP</h2>
                    <h4>Lorem ipsum dolor sit amet.</h4>
                    <a href="" class="btn button-default">SHOP NOW</a>
                </div>
            </li>
        </ul>

    </div>
    <!-- end slider -->

    <!-- features -->
    <div class="features section">
        <div class="container">
            <div class="row">
                <div class="col s6">
                    <div class="content">
                        <div class="icon">
                            <i class="fa fa-car"></i>
                        </div>
                        <h6>Free Shipping</h6>
                        <p>Lorem ipsum dolor sit amet consectetur</p>
                    </div>
                </div>
                <div class="col s6">
                    <div class="content">
                        <div class="icon">
                            <i class="fa fa-dollar"></i>
                        </div>
                        <h6>Money Back</h6>
                        <p>Lorem ipsum dolor sit amet consectetur</p>
                    </div>
                </div>
            </div>
            <div class="row margin-bottom-0">
                <div class="col s6">
                    <div class="content">
                        <div class="icon">
                            <i class="fa fa-lock"></i>
                        </div>
                        <h6>Secure Payment</h6>
                        <p>Lorem ipsum dolor sit amet consectetur</p>
                    </div>
                </div>
                <div class="col s6">
                    <div class="content">
                        <div class="icon">
                            <i class="fa fa-support"></i>
                        </div>
                        <h6>24/7 Support</h6>
                        <p>Lorem ipsum dolor sit amet consectetur</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end features -->

    <!-- quote -->
    <div class="section quote">
        <div class="container">
            <h4>FASHION UP TO 50% OFF</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid ducimus illo hic iure eveniet</p>
        </div>
    </div>
    <!-- end quote -->

    <!-- product -->
    <div class="section product">
        <div class="container">
            <div class="section-head">
                <h4>NEW PRODUCT</h4>
                <div class="divider-top"></div>
                <div class="divider-bottom"></div>
            </div>
            <div class="row">
                @foreach($now as $k=>$v)
                <div class="col s6">
                    <div class="content">
                        <a href="/cart/commodity?good_id={{$v->goods_id}}"> <img src="{{$v->goods_img}}"></a>
                        <h6><a href="/cart/commodity?good_id={{$v->goods_id}}">{{$v->desc}}</a></h6>
                        <div class="price">
                            ${{$v->goods_price}}<span>${{$v->goods_number}}</span>
                        </div>
                        <input type="hidden" class="goods_id" value="{{$v->goods_id}}">
                        <button class="btn button-default" >ADD TO CART</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end product -->

    
    <!-- promo -->
    <div class="promo section">
        <div class="container">
            <div class="content">
                <h4>PRODUCT BUNDLE</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
                <button class="btn button-default">SHOP NOW</button>
            </div>
        </div>
    </div>
    <!-- end promo -->

    <!-- product -->
    <div class="section product">
        <div class="container">
            <div class="section-head">
                <h4>TOP PRODUCT</h4>
                <div class="divider-top"></div>
                <div class="divider-bottom"></div>
            </div>
            <div class="row">
                @foreach($apex as $k=>$v)
                <div class="col s6">
                    <div class="content">
                        <a href="/cart/commodity?good_id={{$v->goods_id}}"><img src="{{$v->goods_img}}" ></a>
                        <h6><a href="/cart/commodity?good_id={{$v->goods_id}}">{{$v->desc}}</a></h6>
                        <div class="price">
                            ${{$v->goods_price}} <span>${{$v->goods_number}}</span>
                        </div>
                        <input type="hidden" class="goods_id" value="{{$v->goods_id}}">
                        <button class="btn button-default"  >ADD TO CART</button>
                    </div>
                </div>
                    @endforeach
            </div>
            <div class="pagination-product">
                <ul>
                    <li class="active">1</li>
                    <li><a href="">2</a></li>
                    <li><a href="">3</a></li>
                    <li><a href="">4</a></li>
                    <li><a href="">5</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end product -->
    <script>
        $(function () {
            // 加入购物车
            $('.btn').click(function () {
                var id =$(this).prev().val();
                var buy_number=$(this).val(); //定义一个空的变量
                 buy_number=buy_number+1;
                $.post(
                    "/cart/addcart",
                    {id:id,buy_number:buy_number},
                    function (res) {
                        if(res.error=='0001'){
                            // 错误提示
                            alert(res.msg);
                        }else{
                            alert(res.msg);
                        }
                    },'json'
                );
            });
        })
    </script>
@endsection
