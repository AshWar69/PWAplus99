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
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.ico') }}">
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
        <header class="header" style="background-color: #333">
            <div class="header-middle has-center sticky-header fix-top sticky-content">
                <div class="container justify-content-center">
                        <a href="#" class="logo" style="margin-top: -15px; margin-bottom: -8px;">
                            <img src="{{ asset('images/logo.png') }}" alt="Store99"
                                style="height: auto; width: 60px;">
                        </a>
                </div>
            </div>
        </header>
        <main class="main">
            <div class="page-content">
                <div class="container pt-8 pb-10">
                    <div class="login-popup mx-auto pl-6 pr-6 pb-9">
                        <div class="form-box">
                            <div class="tab tab-nav-underline tab-nav-boxed">
                                <ul class="nav nav-tabs nav-fill align-items-center justify-content-center mb-4">
                                    <li class="nav-item">
                                        <a class="nav-link active lh-1 ls-normal" href="#signin-1">Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#register-1" class="nav-link lh-1 ls-normal">Register</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="signin-1">
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" id="singin-email-1" name="email"
                                                    placeholder="Username or Email Address" required="" autofocus>
                                                @error('email')
                                                    <span style="color: red;" class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <input type="password" id="singin-password" name="password"
                                                    placeholder="Password" required="">
                                                @error('password')
                                                    <span style="color: red;" class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-footer">
                                                {{-- <div class="form-checkbox">
                                                <input type="checkbox" id="signin-remember-1" name="signin-remember-1">
                                                <label for="signin-remember-1">Remember
                                                    me</label>
                                            </div> --}}
                                                <a href="{{ route('password.request') }}"
                                                    class="lost-link d-block ">Lost your
                                                    password?</a>
                                            </div>
                                            <button class="btn btn-dark btn-block" type="submit">Login</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="register-1">
                                        <form action="{{ route('register') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" id="register-user-1" name="name"
                                                    placeholder="Username" required="" autofocus>
                                                @error('name')
                                                    <span style="color: red;" class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <input type="email" id="register-email-1" name="email"
                                                    placeholder="Your Email Address" required="">
                                                @error('email')
                                                    <span style="color: red;" class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <input type="password" id="register-password-1" name="password"
                                                    placeholder="Password" required="">
                                                @error('password')
                                                    <span style="color: red;" class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <input type="password" id="register-password-1"
                                                    name="password_confirmation" placeholder="Password"
                                                    required="">
                                            </div>
                                            <!-- <div class="form-footer mb-5">
                                                                <div class="form-checkbox">
                                                                    <input type="checkbox" id="register-agree-1" name="register-agree-1"
                                                                        required="">
                                                                    <label for="register-agree-1">I
                                                                        agree to the
                                                                        privacy policy</label>
                                                                </div>
                                                            </div> -->
                                            <button class="btn btn-dark btn-block" type="submit">Register</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="footer">
            <div class="container">
                <!-- End FooterTop -->
                <div class="footer-middle">
                    <div class="footer-left">
                        <ul class="widget-body">
                            <li>
                                <a href="tel:#" class="footer-icon-box">
                                    <i class="p-icon-phone-solid"></i>
                                    <span>+456 789 000</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="">
                                    <i class="p-icon-map"></i>
                                    <span>Bareilly</span>
                                </a>
                            </li>
                            <li>
                                <a href="mailto:mail@panda.com" class="">
                                    <i class="p-icon-message"></i>
                                    <span>info@.com</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="">
                                    <i class="p-icon-clock"></i>
                                    <span>Mon-Fri: 10:00 - 18:00</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-center">
                        <a href="#" class="logo-footer">
                            <img src="{{ asset('images/logo.png') }}" alt="logo-footer" width="171"
                                height="41">
                        </a>
                        <div class="social-links">
                            <a href="#" class="social-link fab fa-facebook-f" title="Facebook"></a>
                            <a href="#" class="social-link fab fa-twitter" title="Twitter"></a>
                            <a href="#" class="social-link fab fa-pinterest" title="Pinterest"></a>
                            <a href="#" class="social-link fab fa-linkedin-in" title="Linkedin"></a>
                        </div>
                        <!-- End of Social Links -->
                    </div>
                    <div class="footer-right">
                        <div class="widget-newsletter">
                            <h4 class="widget-title">Subscribe Newsletter</h4>
                            <p>Subscribe to the Store99 eCommerce Newsletter<br> updates from your favourite products.
                            </p>
                            <form action="#" class="form-simple">
                                <input type="email" name="email" id="email"
                                    placeholder="Email address here..." required="">
                                <button class="btn btn-link" type="submit">sign up</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End FooterMiddle -->
                <div class="footer-bottom">
                    <p class="copyright">Store99 eCommerce © 2022. All Rights Reserved</p>
                    {{-- <figure>
                        <img src="images/payment.png" alt="payment" width="159" height="29">
                    </figure> --}}
                </div>
                <!-- End FooterBottom -->
            </div>
        </footer>
        <!-- End Footer -->
    </div>
    <!-- Sticky Footer -->
    <div class="sticky-footer sticky-content fix-bottom">
        <a href="index.php" class="sticky-link">
            <i class="p-icon-home"></i>
            <span>Home</span>
        </a>
        <a href="shop.php" class="sticky-link">
            <i class="p-icon-store"></i>
            <span>Shop</span>
        </a>
        <a href="cart.php" class="sticky-link">
            <i class="p-icon-cart"></i>
            <span>Cart</span>
        </a>
        <a href="account.php" class="sticky-link">
            <i class="p-icon-user-solid"></i>
            <span>Account</span>
        </a>
        <div class="header-search hs-toggle dir-up">
            <a href="#" class="search-toggle sticky-link">
                <i class="p-icon-search-solid"></i>
                <span>Search</span>
            </a>
            <form action="#" class="form-simple">
                <input type="text" name="search" autocomplete="off" placeholder="Search your keyword..."
                    required />
                <button class="btn btn-search" type="submit">
                    <i class="p-icon-search-solid"></i>
                </button>
            </form>
        </div>
    </div>
    <!-- Scroll Top -->
    <a id="scroll-top" class="scroll-top" href="#top" title="Top" role="button"> <i
            class="p-icon-arrow-up"></i>
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70">
            <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10"
                cx="35" cy="35" r="34" style="stroke-dasharray: 108.881, 400;"></circle>
        </svg>
    </a>

    <!-- MobileMenu -->
    {{-- <div class="mobile-menu-wrapper">
        <div class="mobile-menu-overlay">
        </div>
        <!-- End Overlay -->
        <a class="mobile-menu-close" href="#"><i class="p-icon-times"></i></a>
        <!-- End CloseButton -->
        <div class="mobile-menu-container scrollable">
            <form action="#" class="inline-form">
                <input type="search" name="search" autocomplete="off" placeholder="Search your keyword..."
                    required />
                <button class="btn btn-search" type="submit">
                    <i class="p-icon-search-solid"></i>
                </button>
            </form>
            <!-- End Search Form -->
            <ul class="mobile-menu mmenu-anim">
                <li class="active">
                    <a href="index.php">Home</a>
                </li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
            <!-- End MobileMenu -->
        </div>
    </div> --}}
    <!-- Plugins JS File -->
    <script src="{{ asset('front/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('front/vendor/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front/vendor/jquery.count-to/jquery-numerator.min.js') }}"></script>
    <script src="{{ asset('front/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <!-- Main JS File -->
    <script src="{{ asset('front/js/main.min.js') }}"></script>
</body>

</html>
