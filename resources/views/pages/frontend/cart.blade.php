@extends('layouts.main')
@section('content')
    <main class="main cart">
        <div class="page-content pt-8 pb-10 mb-4">
            <div class="step-by">
                <h3 class="title title-step active"><a href="{{ URL::to('Cart') }}">1.Shopping Cart</a></h3>
                <h3 class="title title-step"><a href="{{ URL::to('Checkout') }}">2.Checkout</a></h3>
                <h3 class="title title-step"><a href="{{ URL::to('#') }}">3.Order Complete</a></h3>
            </div>
            <div class="container mt-7 mb-2">
                <div class="row">
                    @if (Auth::user())
                        <div class="col-lg-8 col-md-12 pr-lg-6">
                            <table class="shop-table cart-table">
                                <thead>
                                    <tr>
                                        <th><span>Product</span></th>
                                        <th></th>
                                        <th><span>Price</span></th>
                                        <th><span>quantity</span></th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sub = 0; @endphp
                                    @foreach ($cartDetails as $details)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <figure>
                                                    <a href="#">
                                                        <img src="{{ asset('images/product_images/' . $details->image) }}"
                                                            width="90" height="112" alt="{{ $details->pname }}">
                                                    </a>
                                                </figure>
                                            </td>
                                            <td class="product-name">
                                                <div class="product-name-section">
                                                    <a href="#">{{ $details->pname }}</a>

                                                </div>
                                            </td>
                                            <td class="product-subtotal">
                                                <span class="amount">₹{{ $details->price }} x{{ $details->pquan }}pcs</span>
                                            </td>
                                            <td>
                                                <div class="product-quantity">
                                                    <form class="cart_upd">
                                                        <div class="input-group">
                                                            <button
                                                                class="quantity-left-minus p-icon-minus-solid qtybtn"></button>
                                                            <input type="text" name="quantity[]"
                                                                class="form-control input-number" style="width: 40px;"
                                                                value="{{ $details->quan }}" min="1" max="100">
                                                            <input type="hidden" name="cart[]"
                                                                value="{{ $details->cid }}">
                                                            <button
                                                                class="quantity-right-plus p-icon-plus-solid qtybtn"></button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- <span class="quan">x</span> -->
                                            </td>
                                            <td class="product-price">
                                                <span
                                                    class="amount">₹{{ $details->quan * $details->pquan * $details->price }}</span>
                                            </td>
                                            <td class="product-remove">
                                                <a href="#" class="btn-remove" id="{{ $details->cid }}"
                                                    title="Remove this product">
                                                    <i class="p-icon-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @php $sub += ($details->quan*$details->pquan)*$details->price; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="cart-actions mb-6 pt-6">
                                <a href="shop.php" class="btn btn-dim btn-icon-left mr-4 mb-4"><i
                                        class="p-icon-arrow-long-left"></i>Continue Shopping</a>
                            </div>
                            {{-- <div class="cart-coupon-box pt-5 pb-8">
                                <h4 class="title coupon-title text-capitalize mb-4">Coupon Discount</h4>
                                <form action="#">
                                    <input type="text" name="coupon_code" class="input-text mb-6" id="coupon_code"
                                        value="" placeholder="Enter coupon code here..." required>
                                    <button type="submit" class="btn btn-dark btn-outline">Apply
                                        Coupon</button>
                                </form>
                            </div> --}}
                        </div>
                        <aside class="col-lg-4 sticky-sidebar-wrapper">
                            <div class="sticky-sidebar" data-sticky-options="{'bottom': 20}">
                                <div class="summary mb-4">
                                    <h3 class="summary-title">Cart Totals</h3>
                                    <table class="shipping mb-2">
                                        <tr class="summary-subtotal">
                                            <td>
                                                <h4 class="summary-subtitle">Subtotal</h4>
                                            </td>
                                            <td>
                                                <p class="summary-subtotal-price">₹{{ $sub }}</p>
                                            </td>
                                        </tr>
                                    </table>
                                    <a href="{{ URL::to('Checkout') }}" class="btn btn-dim btn-checkout btn-block">Proceed
                                        to
                                        checkout</a>
                                </div>
                            </div>
                        </aside>
                    @else
                        <h1 class='text-center'>Cart Empty</h1>;
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        $('.btn-remove').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var id = $(this).attr('id');

            $.ajax({
                type: "POST",
                url: "{{ route('DelCartItem') }}",
                data: "rid=" + id,
                success: function(response) {
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                },
                error: function(response) {
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            });
        });

        var proQty = $('.input-group');
        proQty.on('click', '.qtybtn', function(e) {
            var $button = $(this);
            var oldValue = $button.parent().find("input[name='quantity[]']").val();
            if ($button.hasClass('quantity-right-plus')) {
                var newVal = parseInt(oldValue) + 1;
            } else if ($button.hasClass('quantity-left-minus')) {
                // Don't allow decrementing below zero
                if (oldValue == 1) {
                    var newVal = parseInt(oldValue);
                } else {
                    var newVal = parseInt(oldValue) - 1;
                }
            }
            if ($button.parent().find("input[name='quantity[]']").val(newVal)) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{route('updateCart')}}",
                    data: $('.cart_upd').serialize(),

                    success: function(response) {
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    },
                    error: function(response) {
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                });
            }
        });
    </script>
@endsection
