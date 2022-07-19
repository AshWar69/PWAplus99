@extends('layouts.main')
@section('content')
    <main class="main checkout">
        <div class="page-content pt-8 pb-10 mb-4">
            <div class="step-by pr-4 pl-4">
                <h3 class="title title-step"><a href="#">1. Shopping Cart</a></h3>
                <h3 class="title title-step active"><a href="#">2. Checkout</a></h3>
                <h3 class="title title-step"><a href="#">3. Order Complete</a></h3>
            </div>
            <div class="container mt-7">
                <form id="order" class="form">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="row">
                        <div class="col-lg-7 mb-6 mb-lg-0 check-detail">
                            <h3 class="title text-left mt-3 mb-6">Billing Details</h3>
                            <div class="row">
                                <div class="col-xs-6">
                                    <label>UserName</label>
                                    <input type="text" class="form-control" name="fname" value="{{Auth::user()->name}}" readonly />
                                </div>
                                <div class="col-xs-6">
                                    <label>Email Address*</label>
                                    <input type="text" class="form-control" name="email" value="{{Auth::user()->email}}" readonly/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <label>Town / City</label>
                                    <input type="text" class="form-control" name="city" value="Bareilly" readonly />
                                </div>
                                <div class="col-xs-6">
                                    <label>Postcode / ZIP*</label>
                                    <input type="text" class="form-control" name="pin" required=""  autofocus='' />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <label>Phone*</label>
                                    <input type="text" class="form-control" name="pmob" required="" />
                                </div>
                            </div>
                            <label>Street Address</label>
                            <input type="text" class="form-control" name="add1" required=""
                                placeholder="House number and street name"/>
                            <input type="text" class="form-control" name="add2"
                                placeholder="Apartment, suite, unit, etc. (optional)" />

                            <h2 class="title pt-2 mb-6">Additional Information</h2>
                            <label>Order Notes (optional)</label>
                            <textarea class="form-control mb-0" name="additional" cols="30" rows="5"
                                placeholder="Write Your Review Here..."></textarea>
                        </div>
                        <aside class="col-lg-5 sticky-sidebar-wrapper  pl-lg-6">
                            <div class="sticky-sidebar" data-sticky-options="{'bottom': 50}">
                                <div class="summary pt-5">
                                    <h3 class="title">Your Order</h3>
                                    <table class="order-sidebar">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $sub = 0;
                                                $tot = 0;
                                            @endphp
                                            @foreach ($cartDetails as $details)
                                                <input type="hidden" name="pname[]" value="{{ $details->pname }}">
                                                <input type="hidden" name="quantity[]" value="{{ $details->pquan }}">
                                                <input type="hidden" name="price[]" value="{{ $details->price }}">
                                                <input type="hidden" name="orderq[]" value="{{ $details->quan }}">
                                                <input type="hidden" name="com[]" value="{{ $details->company_name }}">
                                                <input type="hidden" name="model[]" value="{{ $details->mod_name }}">
                                                <tr>
                                                    <td class="product-name">{{ $details->pname }}
                                                        {{ $details->pquan }}pcs
                                                        * ₹{{ $details->price }} <span
                                                            class="product-quantity ml-5">×&nbsp;{{ $details->quan }}</span>
                                                    </td>
                                                    <td class="product-total text-body">
                                                        ₹{{ $details->quan * $details->pquan * $details->price }}</td>
                                                </tr>

                                                @php $sub += ($details->quan*$details->pquan)*$details->price; @endphp
                                            @endforeach
                                            <tr class="summary-subtotal">
                                                <td>
                                                    <h4 class="summary-subtitle">Subtotal</h4>
                                                </td>
                                                <input type="hidden" id="subpay" name="sub"
                                                    value="{{ $sub }}">
                                                <td class="summary-subtotal-price">₹{{ $sub }}
                                                </td>
                                            </tr>
                                            <tr class="sumnary-shipping shipping-row-last">
                                                <td colspan="2" class="pb-3">
                                                    <h4 class="summary-subtitle pb-3">Calculate Tax & Shipping</h4>
                                            <tr>
                                                <td>GST</td>
                                                <td>18 %</td>
                                            </tr>
                                            <tr>
                                                <input type="hidden" name="tax"
                                                    value="18%">
                                                    <input type="hidden" name="taxval"
                                                        value="{{ ($sub * 18) / 100 }}">
                                                <td></td>
                                                <td>{{ ($sub * 18) / 100 }}</td>
                                            </tr>
                                            {{-- <ul>
                                                        <li>GST
                                                            <input type="hidden" name="gst" value="18">
                                                            <p>18%</p>
                                                            <label class="custom-control-label text-right"
                                                                for="free-shipping">18%</label>
                                                        </li> --}}
                                            {{-- <li>
                                                            <input type="radio" id="local_pickup" name="shipping"
                                                                class="custom-control-input" value="Home Delivery">
                                                            <label class="custom-control-label" for="local_pickup">Home
                                                                Delivery</label>
                                                        </li>
                                                        <input type="hidden" id="pay" name="pay"> --}}
                                            {{-- </ul> --}}
                                            <input type="hidden" id="pay" name="pay" value="COD">
                                            </td>
                                            </tr>
                                            <tr class="summary-total">
                                                @php $tot = (($sub*18)/100)+$sub; @endphp
                                                <td>
                                                    <h4 class="summary-subtitle">Total</h4>
                                                </td>
                                                <td>
                                                    <p class="summary-total-price ls-s">₹{{ round($tot) }}</p>
                                                </td>
                                                
                                                <input type="hidden" name="tprice"
                                                value="{{ round($tot) }}">
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="payment accordion radio-type pb-5">
                                        <h4 class="summary-subtitle ls-m pb-3">Payment Methods</h4>
                                        <!-- <div class="card">
                                                            <div class="card-header">
                                                                <a href="#collapse1" class="collapse">Check payments
                                                                </a>
                                                            </div>
                                                            <div id="collapse1" class="expanded" style="display: block;">
                                                                <div class="card-body">
                                                                    Please send a check to Store Name, Store Street,
                                                                    Store Town, Store State / County, Store Postcode.
                                                                </div>
                                                            </div>
                                                        </div> -->
                                        <div class="card">
                                            <div class="card-header">
                                                <a href="#collapse2" id="paymentType" class="expand">Cash
                                                    on delivery</a>
                                            </div>
                                            <div id="collapse2" class="collapsed">
                                                <div class="card-body">
                                                    Pay with cash upon delivery.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="message"></div>
                                    <button type="submit" id="placeorder" class="btn btn-dim btn-block mt-6">Place
                                        Order</button>
                                    {{-- <h3 style="color: red; font-size: bold;" class="mt-2">Order Value Must Be ₹5000/- or more.</h3> --}}
                                </div>
                            </div>
                        </aside>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        $('#order').submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            if ($('#subpay').val() >= 5000) {
            $('#placeorder').addClass('Disabled');
                $('input[name="pay"]').val('COD');
                $.ajax({
                    type: "POST",
                    url: "{{ route('PlaceOrder') }}",
                    data: $(this).serialize(),
                    success: function(response) {
                        setTimeout(function() {
                            self.location = "{{URL::to('OrderPlaced')}}";
                        }, 1000);
                    },
                    error: function(response) {
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                });
            } else {
                $('#message').empty();
                $('#message').append(
                    '<h3 style="color: red; font-size: bold;" class="mt-2">Order Value Must Be ₹5000/- or more.</h3>'
                    );
            }
        });
        $('#paymentType').on("click", function() {
            $('input[name="pay"]').val('COD');
        });
    </script>
@endsection
