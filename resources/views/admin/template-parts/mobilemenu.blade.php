<!-- HEADER MOBILE-->
<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="index.html">
                    <img src="{{asset('admin-assets')}}/images/icon/logo.png" alt="CoolAdmin" />
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li>
                    <a class="js-arrow" href="{{url('/admin/dashboard')}}">
                        <i class="fa fa-circle"></i>Dashboard</a>
                </li>
                <li>
                    <a class="js-arrow" href="{{url('/admin/category')}}">
                        <i class="fa fa-circle"></i>Category</a>
                </li>
                <li>
                    <a class="js-arrow" href="{{url('/admin/coupon')}}">
                        <i class="fa fa-circle"></i>Coupon</a>
                </li>
                <li>
                    <a class="js-arrow" href="{{url('/admin/size')}}">
                        <i class="fa fa-circle"></i>Size</a>
                </li>
                <li>
                    <a class="js-arrow" href="{{url('/admin/colour')}}">
                        <i class="fa fa-circle"></i>Colour</a>
                </li>
                <li>
                    <a class="js-arrow" href="{{url('/admin/brand')}}">
                        <i class="fa fa-circle"></i>Brand</a>
                </li>
                <li>
                    <a class="js-arrow" href="{{url('/admin/product')}}">
                        <i class="fa fa-circle"></i>Product</a>
                </li>
                <li>
                    <a class="js-arrow" href="{{url('/admin/tax')}}">
                        <i class="fa fa-circle"></i>Tax</a>
                </li>
                <li>
                    <a class="js-arrow" href="{{url('/admin/customer')}}">
                        <i class="fa fa-circle"></i>Customer</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- END HEADER MOBILE-->