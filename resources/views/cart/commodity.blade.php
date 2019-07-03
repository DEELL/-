<!-- 存放在 resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', '首页')

@section('sidebar')
    @parent
@endsection

@section('content')
    <!-- shop single -->
    <div class="pages section">
        <div class="container">
            <div class="shop-single">
                    <img src="{{$goods->goods_img}}">
                    <h5>{{$goods->desc}}</h5>
                    <div class="price">￥{{$goods->goods_price}} <span>￥{{$goods->goods_number}}</span></div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam eaque in non delectus, error iste veniam commodi mollitia, officia possimus, repellendus maiores doloribus provident. Itaque, ab perferendis nemo tempore! Accusamus</p>
                <input type="hidden" class="goods_id" value="{{$goods->goods_id}}">
                <button type="button" class="btn button-default">ADD TO CART</button>
            </div>
            <div class="review">
                <h5>1 reviews</h5>
                <div class="review-details">
                    <div class="row">
                        <div class="col s3">
                            <img src="img/user-comment.jpg" alt="" class="responsive-img">
                        </div>
                        <div class="col s9">
                            <div class="review-title">
                                <span><strong>John Doe</strong> | Juni 5, 2016 at 9:24 am | <a href="">Reply</a></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis accusantium corrupti asperiores et praesentium dolore.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="review-form">
                <div class="review-head">
                    <h5>Post Review in Below</h5>
                    <p>Lorem ipsum dolor sit amet consectetur*</p>
                </div>
                <div class="row">
                    <form class="col s12 form-details">
                        <div class="input-field">
                            <input type="text" required class="validate" placeholder="NAME">
                        </div>
                        <div class="input-field">
                            <input type="email" class="validate" placeholder="EMAIL" required>
                        </div>
                        <div class="input-field">
                            <input type="text" class="validate" placeholder="SUBJECT" required>
                        </div>
                        <div class="input-field">
                            <textarea name="textarea-message" id="textarea1" cols="30" rows="10" class="materialize-textarea" class="validate" placeholder="YOUR REVIEW"></textarea>
                        </div>
                        <div class="form-button">
                            <div class="btn button-default">POST REVIEW</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
    <!-- end shop single -->


@endsection
