<!-- 存放在 resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Laravel学院')

@section('sidebar')
    @parent
@endsection

@section('content')
    <!-- product -->
    <div class="section product product-list">
        <div class="container">
            <div class="pages-head">
                <h3>PRODUCT LIST</h3>
            </div>
            <div class="input-field">
                <select>
                    <option value="">Popular</option>
                    <option value="1">New Product</option>
                    <option value="2">Best Sellers</option>
                    <option value="3">Best Reviews</option>
                    <option value="4">Low Price</option>
                    <option value="5">High Price</option>
                </select>
            </div>
            <div class="row">
                <div class="col s6">
                    <div class="content">
                        <img src="{{asset('img/product-new1.png')}}" alt="">
                        <h6><a href="">Fashion Men's</a></h6>
                        <div class="price">
                            $20 <span>$28</span>
                        </div>
                        <button class="btn button-default">ADD TO CART</button>
                    </div>
                </div>
                <div class="col s6">
                    <div class="content">
                        <img src="{{asset('img/product-new2.png')}}" alt="">
                        <h6><a href="">Fashion Men's</a></h6>
                        <div class="price">
                            $20 <span>$28</span>
                        </div>
                        <button class="btn button-default">ADD TO CART</button>
                    </div>
                </div>
            </div>
            <div class="row margin-bottom">
                <div class="col s6">
                    <div class="content">
                        <img src="{{asset('img/product-new3.png')}}" alt="">
                        <h6><a href="">Fashion Men's</a></h6>
                        <div class="price">
                            $20 <span>$28</span>
                        </div>
                        <button class="btn button-default">ADD TO CART</button>
                    </div>
                </div>
                <div class="col s6">
                    <div class="content">
                        <img src="{{asset('img/product-new4.png')}}" alt="">
                        <h6><a href="">Fashion Men's</a></h6>
                        <div class="price">
                            $20 <span>$28</span>
                        </div>
                        <button class="btn button-default">ADD TO CART</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    <div class="content">
                        <img src="{{asset('img/product-new3.png')}}" alt="">
                        <h6><a href="">Fashion Men's</a></h6>
                        <div class="price">
                            $20 <span>$28</span>
                        </div>
                        <button class="btn button-default">ADD TO CART</button>
                    </div>
                </div>
                <div class="col s6">
                    <div class="content">
                        <img src="{{asset('img/product-new4.png')}}" alt="">
                        <h6><a href="">Fashion Men's</a></h6>
                        <div class="price">
                            $20 <span>$28</span>
                        </div>
                        <button class="btn button-default">ADD TO CART</button>
                    </div>
                </div>
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
    <!-- end product -
@endsection