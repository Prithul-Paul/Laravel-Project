<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{asset('admin-assets')}}/images/icon/logo.png" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="@yield('dashboard_active_class')">
                    <a class="js-arrow" href="{{url('/admin/dashboard')}}">
                        <i class="fa fa-circle"></i>Dashboard</a>
                </li>
                <li class="@yield('category_active_class')">
                    <a class="js-arrow" href="{{url('/admin/category')}}">
                        <i class="fa fa-circle"></i>Category</a>
                </li>
                <li class="@yield('coupon_active_class')">
                    <a class="js-arrow" href="{{url('/admin/coupon')}}">
                        <i class="fa fa-circle"></i>Coupon</a>
                </li>
                <li class="@yield('size_active_class')">
                    <a class="js-arrow" href="{{url('/admin/size')}}">
                        <i class="fa fa-circle"></i>Size</a>
                </li>
                <li class="@yield('colour_active_class')">
                    <a class="js-arrow" href="{{url('/admin/colour')}}">
                        <i class="fa fa-circle"></i>Colour</a>
                </li>
                <li class="@yield('brand_active_class')">
                    <a class="js-arrow" href="{{url('/admin/brand')}}">
                        <i class="fa fa-circle"></i>Brand</a>
                </li>
                <li class="@yield('product_active_class')">
                    <a class="js-arrow" href="{{url('/admin/product')}}">
                        <i class="fa fa-circle"></i>Product</a>
                </li>
                <li class="@yield('tax_active_class')">
                    <a class="js-arrow" href="{{url('/admin/tax')}}">
                        <i class="fa fa-circle"></i>Tax</a>
                </li>
                <li class="@yield('customer_active_class')">
                    <a class="js-arrow" href="{{url('/admin/customer')}}">
                        <i class="fa fa-circle"></i>Customer</a>
                </li>
                <li class="@yield('customer_active_class')">
                    <a class="js-arrow" href="{{url('/admin/banner')}}">
                        <i class="fa fa-circle"></i>Banner</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->