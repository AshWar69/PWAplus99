<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Store99</title>

    <meta name="keywords" content="" />
    <meta name="description" content="">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/icons/favicon.png">
    <!-- Preload Font -->

    <link rel="preload" href="vendor/fontawesome-free/webfonts/fa-solid-900.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="vendor/fontawesome-free/webfonts/fa-brands-400.woff2" as="font" type="font/woff2" crossorigin="anonymous">

    <script>
        WebFontConfig = {
            google: {
                families: ['Josefin Sans:300,400,600,700']
            }
        };
        (function(d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = 'js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <link rel="stylesheet" type="text/css" href="{{asset('front/css/vendor/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/vendor/animate/animate.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('front/css/vendor/owl-carousel/owl.carousel.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/vendor/magnific-popup/magnific-popup.min.css')}}">
    <!-- Main CSS File -->
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/css/demo5.min.css')}}">
</head>

<body class="home">
    <div class="page-wrapper">
        <header class="header header-transparent">
            <div class="header-middle has-center sticky-header fix-top sticky-content">
                <div class="container-fluid">
                    <div class="header-left">
                        <ul class="menu menu-type2">
                            <li class="active">
                                <a href="index.php">Home</a>
                            </li>
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="contact.php">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="header-center d-flex">
                        <a href="#" class="mobile-menu-toggle">
                            <i class="p-icon-bars-solid"></i>
                        </a>
                        <a href="index.php" class="logo">
                            <img src="images/logo.png" style="height: 80px; width: 130px;">
                        </a>
                    </div>
                    <div class="header-right">
                        <a href="tel:#" class="call">
                            <i class="p-icon-phone-solid"></i>
                            <span>+91-1234567980</span>
                        </a>
                        <span class="divider"></span>
                        @if(Auth::user())
                            <a class="login-toggle" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{Auth::user()->name}}<i class="p-icon-logout ml-2"></i>Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @else
                            <a class="login-toggle" href="authenticate.php"><i class="p-icon-user-solid"></i></a>
                        @endif
                        <?php if (isset($_SESSION["uid"])) { ?>
                            <div class="dropdown cart-dropdown off-canvas mr-0 mr-lg-2">
                                <a href="#" class="cart-toggle link">
                                    <i class="p-icon-cart-solid">
                                        <span class="cart-count"><?php if($cartItems['count'] > 0) echo $cartItems['count']; else echo "0"; ?></span>
                                    </i>
                                </a>
                                <div class="canvas-overlay"></div>
                                <div class="dropdown-box">
                                    <div class="canvas-header">
                                        <h4 class="canvas-title">Shopping Cart</h4>
                                        <a href="#" class="btn btn-dark btn-link btn-close">close<i class="p-icon-arrow-long-right"></i><span class="sr-only">Cart</span></a>
                                    </div>
                                    <div class="products scrollable">
                                        <!-- End of Cart Product -->
                                        <?php 
                                        $sub = 0;
                                        $cart = mysqli_query($con, "select cart.id as cid, product_id, user_id, cart.quantity as quan, cart.price as price, count(cart.id) as count, pro.name as pname, image from cart_details cart inner join products pro on cart.product_id = pro.id where cart.user_id = $id group by cart.product_id ")or die(mysqli_error($con));
                                        while($car = mysqli_fetch_assoc($cart)){ ?>
                                        <div class="product product-mini">
                                            <figure class="product-media">
                                                <a href="productInfo.php?product=<?php echo $car['product_id']; ?>">
                                                    <img src="images/products/<?php echo $car['image'] ?>" alt="product" width="50" height="70" />
                                                </a>
                                                <a href="#" title="Remove Product" class="btn-remove">
                                                    <i class="p-icon-times"></i><span class="sr-only">Close</span>
                                                </a>
                                            </figure>
                                            <div class="product-detail">
                                                <a href="productInfo.php?product=<?php echo $car['product_id']; ?>" class="product-name"><?php echo $car['pname'] ?></a>
                                                <div class="price-box">
                                                    <span class="product-quantity"><?php echo $car['quan']; ?></span>
                                                    <span class="product-price">₹<?php echo $car['price']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $sub += $car['quan']*$car['price']; } ?>
                                        <!-- End of Cart Product -->
                                    </div>
                                    <!-- End of Products  -->
                                    <div class="cart-total">
                                        <label>Subtotal:</label>
                                        <span class="price">₹<?php echo $sub; ?>.00</span>
                                    </div>
                                    <!-- End of Cart Total -->
                                    <div class="cart-action">
                                        <a href="cart.php" class="btn btn-outline btn-dim mb-2">View
                                            Cart</a>
                                        <a href="checkout.php" class="btn btn-dim"><span>Go To Checkout</span></a>
                                    </div>
                                    <!-- End of Cart Action -->
                                </div>
                                <!-- End Dropdown Box -->
                            </div>
                        <?php 
                            } 
                        ?>
                    </div>
                </div>
            </div>
        </header>
        <!-- End Header -->