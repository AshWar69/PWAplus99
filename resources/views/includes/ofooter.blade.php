<footer class="footer">
    <div class="container">
        <div class="footer-top">
            <ul class="menu menu-type2">
                <li>
                    <a href="about.html">About us</a>
                </li>
                <li>
                    <a href="#">our team</a>
                </li>
                <li>
                    <a href="faq.html">faq</a>
                </li>
                <li>
                    <a href="account.html">my account</a>
                </li>
                <li>
                    <a href="contact.html">contact us</a>
                </li>
            </ul>
        </div>
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
                            <span>25 West 21th STREET, Miami FL, USA</span>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:mail@panda.com" class="">
                            <i class="p-icon-message"></i>
                            <span>info@panda.com</span>
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
                <a href="demo1.html" class="logo-footer">
                    <img src="images/logo.png" alt="logo-footer" width="171" height="41">
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
                    <p>Subscribe to the Panda eCommerce Newsletter<br> updates from your favourite products.
                    </p>
                    <form action="#" class="form-simple">
                        <input type="email" name="email" id="email" placeholder="Email address here..." required="">
                        <button class="btn btn-link" type="submit">sign up</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- End FooterMiddle -->
        <div class="footer-bottom">
            <p class="copyright">Panda eCommerce © 2022. All Rights Reserved</p>
            <figure>
                <img src="images/payment.png" alt="payment" width="159" height="29">
            </figure>
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
            <input type="text" name="search" autocomplete="off" placeholder="Search your keyword..." required />
            <button class="btn btn-search" type="submit">
                <i class="p-icon-search-solid"></i>
            </button>
        </form>
    </div>
</div>
<!-- Scroll Top -->
<a id="scroll-top" class="scroll-top" href="#top" title="Top" role="button"> <i class="p-icon-arrow-up"></i>
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70">
        <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10" cx="35" cy="35" r="34" style="stroke-dasharray: 108.881, 400;"></circle>
    </svg>
</a>

<!-- MobileMenu -->
<div class="mobile-menu-wrapper">
    <div class="mobile-menu-overlay">
    </div>
    <!-- End Overlay -->
    <a class="mobile-menu-close" href="#"><i class="p-icon-times"></i></a>
    <!-- End CloseButton -->
    <div class="mobile-menu-container scrollable">
        <form action="#" class="inline-form">
            <input type="search" name="search" autocomplete="off" placeholder="Search your keyword..." required />
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
            <li>
                <a class="login-toggle" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ Auth::user()->name }}
                    <i class="p-icon-logout ml-2"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
        <!-- End MobileMenu -->
    </div>
</div>
<!-- Plugins JS File -->
<script src="{{asset('front/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('front/vendor/owl-carousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('front/vendor/jquery.count-to/jquery-numerator.min.js')}}"></script>
<script src="{{asset('front/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<!-- Main JS File -->
<script src="{{asset('front/js/main.min.js')}}"></script>
@yield('scripts')
<script src="{{ asset('/sw.js') }}"></script>
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script>
</body>
</html>