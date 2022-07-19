@extends('layouts.main')
@section('content')
    <div class="page-header cph-header pl-4 pr-4" style="background-color: #fff7ec">
        <h1 class="page-title font-weight-light text-capitalize">Models</h1>
        <div class="category-container row justify-content-center cols-2 cols-xs-3 cols-sm-4 cols-md-6 pt-6">
            @foreach ($models as $model)
                <div class="category category-ellipse mb-4 mb-md-0">
                    <a href="{{ URL::to('SingleModel/' . $model->id) }}">
                        <figure>
                            <img src="{{ asset('images/models/' . $model->img) }}" alt="{{ $model->name }}"
                                width="160" height="161">
                        </figure>
                    </a>
                    <div class="category-content">
                        <h3 class="category-name"><a
                                href="{{ URL::to('SingleModel/' . $model->id) }}">{{ $model->name }}</a>
                        </h3>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <section class="mt-10 pt-3 mb-10 pb-3 recommend-section">
        <div class="container-fluid">
            <h2 class="title title-line title-underline with-link text-normal mb-5">
                <span>Recommended</span>
                <a href="{{ URL::to('Shop') }}" class="btn btn-link text-capitalize">More
                    Products<i class="p-icon-arrow-long-right"></i></a>
            </h2>
            <div class="owl-carousel owl-theme owl-nav-inner owl-nav-arrow row cols-2 cols-md-4 cols-lg-6"
                data-owl-options="{
                                    'nav': true,
                                    'dots': false,
                                    'loop': false,
                                    'margin': 20,
                                    'responsive': {
                                        '0': {
                                            'items': 2,
                                            'nav': false
                                        },
                                        '768': {
                                            'items': 4
                                        },
                                        '992': {
                                            'items': 6
                                        }
                                    }
                                }">
                @foreach ($products as $pro)
                    <div class="product shadow-media text-center">
                        <figure class="product-media">
                            <a href="{{ URL::to('ProductInfo/' . $pro->id) }}">
                                <img src="{{ asset('images/product_images/' . $pro->image) }}" alt="product" width="295"
                                    height="369">
                            </a>
                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-cart" data-toggle="modal"
                                    data-target="#addCartModal" title="Add to Cart">
                                    <i class="p-icon-cart-solid"></i>
                                </a>
                            </div>
                        </figure>
                        <div class="product-details">
                            <h5 class="product-name">
                                <a href="{{ URL::to('ProductInfo/' . $pro->id) }}">
                                    {{ $pro->name }}
                                </a>
                            </h5>
                            <span class="product-price">
                                <span class="price">₹ {{ $pro->perprice }}</span>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
