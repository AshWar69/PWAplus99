<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Store99</title>

    <meta name="keywords" content="" />
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{asset('images/favicon.ico')}}">
    <!-- Preload Font -->

    <link rel="preload" href="{{ asset('front/vendor/fontawesome-free/webfonts/fa-solid-900.woff2') }}"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('front/vendor/fontawesome-free/webfonts/fa-brands-400.woff2') }}"
        as="font" type="font/woff2" crossorigin="anonymous">

    <script>
        WebFontConfig = {
            google: {
                families: ['Josefin Sans:300,400,500,600,700']
            }
        };
        (function(d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = "{{ asset('front/js/webfont.js') }}";
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>


    <link rel="stylesheet" type="text/css" href="{{ asset('front/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/vendor/animate/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/vendor/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/vendor/magnific-popup/magnific-popup.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/vendor/photoswipe/photoswipe.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('front/vendor/photoswipe/default-skin/default-skin.min.css') }}">

    <!-- Main CSS File -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/style.min.css') }}">
</head>

<body>
    <div class="page-wrapper">
        <header class="header">
            <div class="header-top">
                <div class="container">
                    <div class="header-left">
                        <a href="tel:#" class="call">
                            <i class="p-icon-phone-solid"></i>
                            <span>+91-1234567980</span>
                        </a>
                        <span class="divider"></span>
                        <a href="contact.html" class="contact">
                            <i class="p-icon-map"></i>
                            <span>25 West 21th STREET, Miami FL, USA</span>
                        </a>
                    </div>
                    <div class="header-right">
                        <span class="divider"></span>
                        <!-- End DropDown Menu -->
                        <div class="social-links">
                            <a href="#" class="social-link fab fa-facebook-f" title="Facebook"></a>
                            <a href="#" class="social-link fab fa-instagram" title="Instagram"></a>
                        </div>
                        <!-- End of Social Links -->
                    </div>
                </div>
            </div>
            <!-- End HeaderTop -->
            <div class="header-middle has-center sticky-header fix-top sticky-content">
                <div class="container">
                    <div class="header-left">
                        <a href="#" class="mobile-menu-toggle" title="Mobile Menu">
                            <i class="p-icon-bars-solid"></i>
                        </a>
                        <a href="index.php" class="logo">
                            <img src="{{ asset('images/logo.png') }}" alt="Store99"
                                style="height: auto; width: 80px;">
                        </a>
                        <!-- End of Divider -->
                    </div>
                    <div class="header-center">
                        <nav class="main-nav">
                            <ul class="menu">
                                <li>
                                    <a href="{{URL::to('/')}}">Home</a>
                                </li>
                                <li><a href="{{URL::to('AboutUs')}}">About Us</a></li>
                                <li><a href="{{URL::to('ContactUs')}}">Contact Us</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="header-right">
                        @if (Auth::user())
                            <a class="login-toggle text-black" title="Logout"
                            href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ Auth::user()->name }}<i
                                    class="p-icon-logout ml-2"></i></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <div class="dropdown cart-dropdown off-canvas mr-0 mr-lg-2">
                                <a href="#" class="cart-toggle link">
                                    <i class="p-icon-cart-solid">
                                        <span class="cart-count">{{$count->count}}</span>
                                    </i>
                                </a>
                                <div class="canvas-overlay"></div>
                                <div class="dropdown-box">
                                    <div class="canvas-header">
                                        <h4 class="canvas-title">Shopping Cart</h4>
                                        <a href="#" class="btn btn-dark btn-link btn-close">close<i
                                                class="p-icon-arrow-long-right"></i><span
                                                class="sr-only">Cart</span></a>
                                    </div>
                                    <div class="products scrollable">
                                        <!-- End of Cart Product -->
                                        @php $sub = 0; @endphp
                                        @foreach($cart as $car)
                                        <div class="product product-mini">
                                            <figure class="product-media">
                                                <a href="#">
                                                    <img src="{{asset('images/product_images/'.$car->image)}}" alt="{{$car->pname}}" width="50"
                                                        height="70" />
                                                </a>
                                                <a href="#" title="Remove Product" class="btn-remove">
                                                    <i class="p-icon-times"></i><span class="sr-only">Close</span>
                                                </a>
                                            </figure>
                                            <div class="product-detail">
                                                <a href="#" class="product-name">{{$car->pname}}</a>
                                                <div class="price-box">
                                                    <span class="product-quantity">{{$car->quan*$car->pquan}}</span>
                                                    <span class="product-price">{{$car->price}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        @php $sub += ($car->quan*$car->pquan)*$car->price; @endphp
                                        @endforeach
                                        <!-- End of Cart Product -->
                                    </div>
                                    <!-- End of Products  -->
                                    <div class="cart-total">
                                        <label>Subtotal:</label>
                                        <span class="price">₹{{$sub}}.00</span>
                                    </div>
                                    <!-- End of Cart Total -->
                                    <div class="cart-action">
                                        <a href="{{URL::to('Cart')}}" class="btn btn-outline btn-dim mb-2">View
                                            Cart</a>
                                        <a href="{{URL::to('Checkout')}}" class="btn btn-dim"><span>Go To Checkout</span></a>
                                    </div>
                                    <!-- End of Cart Action -->
                                </div>
                                <!-- End Dropdown Box -->
                            </div>
                        @else
                            <a class="login-toggle" title="Login/Register"
                                href="{{ URL::to('Authentication') }}"><i class="p-icon-user-solid"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </header>
