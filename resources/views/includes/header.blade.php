<header class="transparent">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-lg-2 col-sm-12 ">
                @if(request()->is('home'))
                <div class="logo"><a href="{{ url('/home') }}"><img src="{{ asset('assets/images/logo-white.png') }}" alt="logo"></a></div>
                @else
                <div class="logo"><a href="{{ url('/home') }}"><img src="{{ asset('assets/images/logo1.png') }}" alt="logo"></a></div>
                @endif
            </div>
            <div class="col-md-10 col-lg-10 col-sm-12">
                <div class="button-header">
{{--                    <div class="dropdown">--}}
{{--                        <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                            Dropdown button--}}
{{--                        </button>--}}
{{--                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
{{--                            <a class="dropdown-item" href="#">Action</a>--}}
{{--                            <a class="dropdown-item" href="#">Another action</a>--}}
{{--                            <a class="dropdown-item" href="#">Something else here</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    @guest(session('auth.current'))
                    <a href="{{ url('register') }}" class="custom-btn login">Sign Up</a>
                    <a href="{{ url('/') }}" class="custom-btn">Poll Participation </a>
                    @else
                    <a href="{{ url('/') }}" class="custom-btn">Poll Participation </a>

                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="custom-btn login">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                        <div class="sidenav-btn" onclick="openNav()">&#9776;</div>
                        <div class="sidenav-section">
                            <div id="mySidenav" right  class="sidenav">
                                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                                @if(session('auth.current')=='admin')
                                    <a href="{{url('admin/customer')}}">Customers</a>

                                @else

                                @endif
                                <a href="{{ url('/dashboard') }}" >Dashboard </a>
                                <a href="{{ url('/poll/create') }}" >Create Poll </a>
                                <a href="{{ url('/poll') }}" >Poll List </a>

                            </div>
                        </div>

                    @endguest

                </div>
            </div>
        </div>
    </div>
</header>

<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>
