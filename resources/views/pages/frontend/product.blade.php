@extends('layouts.main')
@section('content')

<div class="page-header" style="background-color: #f9f8f4">
    <h1 class="page-title py-0 my-0">Our Products</h1>
</div>
<div class="page-content mb-10 shop-page">
    <div class="container">
        <div class="row main-content-wrap">
            <div class="col-lg-12 main-content">
                <nav class="toolbox sticky-toolbox sticky-content fix-top">
                    <div class="toolbox-left">
                        <a href="#" class="toolbox-item left-sidebar-toggle btn btn-outline btn-primary btn-icon-right d-lg-none"><span>Filter</span><i class="p-icon-category-1 ml-md-1"></i></a>
                        <div class="toolbox-item toolbox-sort select-menu">
                            <label>Sort By :</label>
                            <select name="orderby">
                                <option value="default" selected="selected">Default Sorting</option>
                                <option value="popularity">Sort By Popularity</option>
                                <option value="rating">Sort By The Latest</option>
                                <option value="date">Sort By Average Rating</option>
                                <option value="price-low">Sort By Price: Low To High</option>
                                <option value="price-high">Sort By Price: High To Low</option>
                            </select>
                        </div>
                    </div>
                    <div class="toolbox-right">
                        <div class="toolbox-item toolbox-show select-box">
                            <label>Show :</label>
                            <select name="count">
                                <option value="12">12</option>
                                <option value="24">24</option>
                                <option value="36">36</option>
                            </select>
                        </div>
                        <div class="toolbox-item toolbox-layout">
                            <a href="#" class="p-icon-list btn-layout active"></a>
                            <a href="#" class="p-icon-grid btn-layout"></a>
                        </div>
                    </div>
                </nav>
                <div class="row product-wrapper cols-lg-4 cols-2">
                    @foreach($products as $pro)
                    <div class="product-wrap">
                        <div class="product shadow-media text-center">
                            <figure class="product-media">
                                <a href="{{URL::to('ProductInfo/'.$pro->id)}}">
                                    <img src="{{asset('images/product_images/'.$pro->image)}}" alt="{{$pro->name}}" width="295" height="369" />
                                </a>
                                {{-- <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart" data-toggle="modal" data-target="#addCartModal" title="Add to Cart">
                                        <i class="p-icon-cart-solid"></i>
                                    </a>
                                    <a href="#" class="btn-product-icon btn-wishlist" title="Add to Wishlist">
                                        <i class="p-icon-heart-solid"></i>
                                    </a>
                                    <a href="#" class="btn-product-icon btn-compare" title="Compare">
                                        <i class="p-icon-compare-solid"></i>
                                    </a>
                                    <a href="#" class="btn-product-icon btn-quickview" title="Quick View">
                                        <i class="p-icon-search-solid"></i>
                                    </a>
                                </div> --}}
                            </figure>
                            <div class="product-details">
                                <h5 class="product-name">
                                    <a href="{{URL::to('ProductInfo/'.$pro->id)}}">
                                        {{$pro->name}}
                                    </a>
                                </h5>
                                <span class="product-price">
                                    <ins class="new-price">₹{{$pro->perprice}}</ins>
                                </span>
                            </div>
                        </div>
                        <!-- End .product -->
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>    

@endsection
