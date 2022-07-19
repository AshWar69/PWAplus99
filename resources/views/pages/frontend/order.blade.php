@extends('layouts.main')
@section('content')
    <main class="main order">
        <div class="page-content pt-8 pb-10 mb-10">
            <div class="step-by pr-4 pl-4">
                <h3 class="title title-step"><a href="#">1.Shopping Cart</a></h3>
                <h3 class="title title-step"><a href="#">2.Checkout</a></h3>
                <h3 class="title title-step active"><a href="#">3.Order Complete</a></h3>
            </div>
            <div class="container mt-7">
                <div class="order-message">
                    <div class="icon-box d-inline-flex align-items-center">
                        <div class="icon-box-icon mb-0">
                            <svg xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve">
                                <g>
                                    <path fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="bevel"
                                        stroke-miterlimit="10"
                                        d="
                                                            M33.3,3.9c-2.7-1.1-5.6-1.8-8.7-1.8c-12.3,0-22.4,10-22.4,22.4c0,12.3,10,22.4,22.4,22.4c12.3,0,22.4-10,22.4-22.4
                                                            c0-0.7,0-1.4-0.1-2.1">
                                    </path>
                                    <polyline fill="none" stroke-width="3" stroke-linecap="round" stroke-linejoin="bevel"
                                        stroke-miterlimit="10"
                                        points="
                                                            48,6.9 24.4,29.8 17.2,22.3 	">
                                    </polyline>
                                </g>
                            </svg>
                        </div>
                        <h3 class="icon-box-title">Thank you. Your Order has been received.</h3>
                    </div>
                </div>
                <div class="order-results row cols-xl-6 cols-md-3 cols-sm-2 mt-10 pt-2 mb-4">
                    <div class="overview-item">
                        <span>Status</span>
                        <label>Processing</label>
                    </div>
                    <div class="overview-item">
                        <span>Date</span>
                        <label>{{date('d-m-Y' ,strtotime($order->created_at))}}</label>
                    </div>
                    <div class="overview-item">
                        <span>Email:</span>
                        <label>{{Auth::user()->email}}</label>
                    </div>
                    <div class="overview-item">
                        <span>Total:</span>
                        <label>{{$order->tprice}}</label>
                    </div>
                    <div class="overview-item">
                        <span>Payment method:</span>
                        <label>Cash on delivery</label>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            setTimeout(function() {
                self.location = "{{URL::to('/')}}";
            }, 10000);
        });
    </script>
@endsection
