<header class="transparent">
    <div class="container" style="width: 85%">
        <div class="row">
            <div class="col-md-2 col-lg-2 col-sm-4">
                @if(request()->is('home'))
                    <div class="logo"><a href="{{ url('/home') }}"><img src="{{ asset('assets/images/logo-white.png') }}" alt="logo"></a></div>
                @else
                    <div class="logo"><a href="{{ url('/home') }}"><img src="{{ asset('assets/images/logo1.png') }}" alt="logo"></a></div>
                @endif
            </div>
            <div class="col-md-10 col-lg-10 col-sm-8">
                <div class="button-header">
                    @guest(session('auth.current'))
                    <a href="{{ url('register') }}" class="custom-btn login">Sign Up</a>
                        <a href="{{ url('/login') }}" class="custom-btn">Poll Participation </a>
                    @else
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  class="custom-btn login">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest

                </div>
            </div>
        </div>
    </div>
{{--    <div class="mobile-block">--}}
{{--        <div class="logo-mobile"><a href="index.html"><img src="{{ asset('images/logo.png') }}" alt="logo"></a></div>--}}
{{--        <a href="#" class="mobile-menu-btn"><span></span></a>--}}
{{--        <div class="mobile-menu">--}}
{{--            <div class="inside">--}}
{{--                <div class="logo">--}}
{{--                    <a href="index-light.html"><img src="{{ asset('images/logo.png') }}" alt="logo"></a>--}}
{{--                </div><!--logo-->--}}
{{--                <ul class="menu panel-group" id="accordion" aria-multiselectable="true">--}}
{{--                    <li><a href="index-light.html">Home</a></li>--}}
{{--                    <li><a href="about.html">About Us</a></li>--}}
{{--                    <li class="children panel">--}}
{{--                        <a href="#menu1" class="collapsed" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="menu1">Hosting</a>--}}
{{--                        <ul class="sub-menu panel-collapse collapse" id="menu1">--}}
{{--                            <li><a href="service-page.html">Service page 1</a></li>--}}
{{--                            <li><a href="service-page-light.html">Service page 2</a></li>--}}
{{--                            <li><a href="service-page-dark.html">Service page 3</a></li>--}}
{{--                            <li><a href="service-page-images.html">Service page 4</a></li>--}}
{{--                        </ul><!--sub-menu-->--}}
{{--                    </li>--}}
{{--                    <li class="children panel">--}}
{{--                        <a href="#menu2" class="collapsed" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="menu2">Pages</a>--}}
{{--                        <ul class="sub-menu panel-collapse collapse" id="menu2">--}}
{{--                            <li><a href="404-light.html">404 Page</a></li>--}}
{{--                            <li><a href="order-light.html">Order</a></li>--}}
{{--                            <li><a href="user-interface-light.html">User Interface</a></li>--}}
{{--                        </ul><!--sub-menu-->--}}
{{--                    </li>--}}
{{--                    <li><a href="blog-list-light.html">Blog</a></li>--}}
{{--                    <li><a href="contact-light.html">Contact Us</a></li>--}}
{{--                </ul><!--menu-->--}}
{{--                <div class="button-header">--}}
{{--                    <a href="sign-up.php" class="custom-btn login">Sign Up</a>--}}
{{--                    <a href="#" class="custom-btn">Poll Participation </a>--}}
{{--                </div><!--button-header-->--}}
{{--            </div><!--inside-->--}}
{{--        </div><!--mobile-menu-->--}}
{{--    </div>--}}
</header>
