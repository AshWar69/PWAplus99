@extends('layouts.main')
@section('content')
    <div class="page-header" style="background-color: #f9f8f4; height:100px">
        <h1 class="page-title py-0 my-0">Product Details</h1>
    </div>
    <nav class="breadcrumb-nav has-border">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ URL::to('/') }}">Home</a></li>
                <li>{{ $products->cname }}</li>
                <li class="active">{{ $products->name }}</li>
            </ul>
        </div>
    </nav>
    <div class="page-content mt-2">
        <div class="container">
            <div class="product product-single product-simple row mb-8">
                <div class="col-md-7">
                    <div class="product-gallery">
                        <div class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1 gutter-no">
                            <figure class="product-image">
                                <img src="{{ asset('images/product_images/' . $products->image) }}"
                                    data-zoom-image="{{ asset('images/product_images/' . $products->image) }}"
                                    alt="{{ $products->name }}" width="800" height="1000">
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="product-details">
                        <h1 class="product-name">{{ $products->name }}</h1>
                        <p class="product-price mb-1">
                            <ins class="new-price">₹{{ $products->perprice }} / Piece</ins>
                        <p class="mb-0 pb-0">x{{ $products->quantity }}pcs /box</p>
                        <p class="mt-0 pt-0">₹{{ $products->quantity * $products->perprice }} /box</p>
                        </p>
                        <p class="product-short-desc">
                        </p>

                        <div class="product-form product-qty pt-1">
                            <div class="product-form-group">
                                <div class="input-group">
                                    <button class="qbtn quantity-minus p-icon-minus-solid"></button>
                                    <input class="quantity form-control" id="pquan" type="number" min="1"
                                        max="1000000">
                                    <button class="qbtn quantity-plus p-icon-plus-solid"></button>
                                </div>
                                {{-- <input type="hidden" id="prodPric" value=""> --}}
                                <input type="hidden" id="prodPrice" value="{{ $products->perprice }}">
                                <input type="hidden" id="prod" value="{{ $products->id }}">
                                <input type="hidden" id="user" value="{{ Auth::user()->id }}">
                                <button id="addcart" class="btn-product btn-cart ls-normal font-weight-semi-bold"><i
                                        class="p-icon-cart-solid"></i>ADD TO CART</button>
                            </div>
                        </div>
                        <hr class="product-divider">
                        <div class="product-meta">
                            <label>CATEGORIES:</label><a href="#">{{ $products->cname }}</a><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // $('.qbtn').click(function() {
        //     var q = $('.quantity').val();
        //     var pr = $('#prodPric').val();

        //     $('#prodPrice').val(q * pr);
        //     $('.new-price').text("");
        //     $('.new-price').text("₹" + q * pr);
        // });

        $("#addcart").on('click', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var prod = $('#prod').val();
            var pquan = $('#pquan').val();
            var price = parseFloat($('#prodPrice').val());
            $.ajax({
                type: "POST",
                url: "{{ route('addCart') }}",
                data: {
                    pid: prod,
                    quantity: pquan,
                    price: price
                },
                success: function(response) {
                    setTimeout(function() {
                        self.location="{{URL::to('/')}}";
                    }, 2000);
                },
                error: function(response) {
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            });
        });
    </script>
@endsection
