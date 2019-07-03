<!-- 存放在 resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', '首页')

@section('sidebar')
    @parent
@endsection

@section('content')
    <!-- cart -->
    <div class="cart section">
        <div class="container">
            <div class="pages-head">
                <h3>CART</h3>
            </div>
            <div class="content">
                @if($cartar)
                @foreach($cartar as $k=>$v)
                    <div class="row">
                        <div class="col s5">
                            <h5>Image</h5>
                        </div>
                        <div class="col s7">
                            <img src="{{$v['goods_img']}}" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>Name</h5>
                        </div>
                        <div class="col s7">
                            <h5><a href="">{{$v['desc']}}</a></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>Quantity</h5>
                        </div>
                        <div class="col s7">
                            <input type="hidden" value="{{$v['goods_id']}}">
                            <input value="{{$v['buy_number']}}" type="text"  class="buy">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>Price</h5>
                        </div>
                        <div class="col s7">
                            <h5>${{$v['money']}}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>Action</h5>
                        </div>
                        <div class="col s7">

                            <h5><input type="hidden" class="aa" value="{{$v['goods_id']}}"><i class="fa fa-trash"></i></h5>
                        </div>
                    </div>
                    <div class="divider"></div>
                @endforeach
                    @else
                    <h3 style="text-align:center; color: #304ffe">(＾－＾) 没有商品</h3>
                @endif
            </div>
            <div class="total">
                {{--<div class="row">--}}
                    {{--<div class="col s7">--}}
                        {{--<h5>Fashion Men's</h5>--}}
                    {{--</div>--}}
                    {{--<div class="col s5">--}}
                        {{--<h5>$21.00</h5>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                    {{--<div class="col s7">--}}
                        {{--<h5>Fashion Men's</h5>--}}
                    {{--</div>--}}
                    {{--<div class="col s5">--}}
                        {{--<h5>$20.00</h5>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="row">
                    <div class="col s7">
                        <h6>Total</h6>
                    </div>
                    <div class="col s5">
                        <h6>${{$money}}.00</h6>
                    </div>
                </div>
            </div>
            <a href="/settle/settle"><button class="btn button-default">Process to Checkout</button></a>
        </div>
    </div>
    <!-- end cart -->
    <script>
        $(function () {
            $('.fa-trash').click(function () {
                // 删除商品
                var goods_id=$(this).prev().val();
                $.post(
                    "/cart/cartdel",
                    {goods_id:goods_id},
                    function (res) {
                        if(res.error=='0002'){
                            alert(res.msg);
                            history.go(0);
                        }else{
                            alert(res.msg);
                        }
                    },'json'
                );
            });
            // 修改购买的数量
            $('.buy').blur(function () {
                var buy_number=$(this).val();//购买的数量
                var goods_id=$(this).prev().val();//商品id
                $.post(
                    "/cart/updatecart",
                    {buy_number:buy_number,goods_id:goods_id},
                    function (res) {
                       if(res==1){
                           location.href='';
                       }
                    }
                );
            })
        })
    </script>
@endsection
