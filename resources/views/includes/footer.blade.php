<footer class=" {{  (request()->is('poll-participation')) ? 'participation-footer' : '' }}">
    <div class="footer-outer">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12 widget-footer footer-logo">
                        <div class="logo "><a href="{{ URL::to('/home') }}"><img src="{{ asset('assets/images/logo.png') }}" alt="logo"></a></div>
                    </div>
                    <!--widget-footer-->
                    <div class="col-lg-3 col-md-6 col-sm-3 widget-footer wt-2">
                        <ul class="links">
                            <li><a href="/poll/create">Get Started</a></li>
                            <li><a href="/select_plan">Price & plans</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <li><a href="#about">About</a></li>
                        </ul>
                    </div>
                    <!--widget-footer-->
                    <div class="col-lg-3 col-md-6 col-sm-3 widget-footer wt-2">
                        <h4>Subscribe for newsletter</h4>
                        <ul>
                            <form method="post" action="{{url('subscribe/submit')}}">
                                @csrf
                                <li>
                                    <div class="form-group"><input type="email" name="email"></div>
                                </li>
                                <li><button type="submit" class="custom-btn-gray">Subscribe</button>
                                </li>
                            </form>
                        </ul>
                    </div>
                    <!--widget-footer-->

                    <div class="col-lg-3 col-md-6 col-sm-3 widget-footer wt-5 text-right">
                        <h4 class="">Social Links</h4>
                        <ul class="social-icon">
                            <li><a href="#"><i class="fa fa-facebook " aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
                        </ul>
                    </div>
                    <!--widget-footer-->
                </div>
            </div>
        </div>
</footer>
