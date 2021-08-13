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
                        <a href="{{ url('/') }}" class="custom-btn">Poll Participation </a>
                    @else
                        <a href="{{ url('/') }}" class="custom-btn">Poll Participation </a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  class="custom-btn login">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest

                </div>
            </div>
        </div>
    </div>
</header>
