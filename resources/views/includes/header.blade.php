<header class="transparent">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-lg-2 col-sm-12 ">
{{--                @if(request()->is('home'))--}}
{{--                <div class="logo"><a href="{{ url('/home') }}"><img src="{{ asset('assets/images/logo-white.png') }}" alt="logo"></a></div>--}}
{{--                @else--}}
                <div class="logo"><a href="{{ url('/home') }}"><img src="{{ asset('assets/images/logo.png?1') }}" alt="logo"></a></div>

            </div>
            <div class="col-md-9 col-lg-9 col-sm-12">
                <div class="button-header">
                    <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                {{__('header.Language')}}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a  class="dropdown-item  {{ session()->get('locale') == 'en' ? 'active' : '' }}"  href="{{ route('changeLang').'?lang=en' }}">{{__('header.English')}}</a>
                                <a class="dropdown-item {{ session()->get('locale') == 'fr' ? 'active' : '' }}" href="{{ route('changeLang').'?lang=fr' }}">{{__('header.French')}}</a>
                            </div>
                    </div>

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
                    @if(!request()->is('home'))
                        <a href="{{ url('/home') }}" class="custom-btn">{{__('header.Home')}}</a>
                    @endif
                    @if(!request()->is('/'))
                        <a href="{{ url('/') }}" class="custom-btn">{{__('header.Poll Participation')}} </a>
                    @endif
                    @guest(session('auth.current'))
                        @if(!request()->is('home') && !request()->is('register'))
                                <a href="{{ url('register') }}" class="custom-btn login">{{__('header.Sign Up')}}</a>
                        @endif
                         @if(!request()->is('login') && !request()->is('/'))
                                <a href="{{ url('login') }}" class="custom-btn login">{{__('header.Login')}}</a>
                         @endif
                    @else
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="custom-btn login">{{ __('header.Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                        <div class="sidenav-btn" onclick="openNav()">&#9776;</div>
                        <div class="sidenav-section">
                            <div id="mySidenav" right  class="sidenav">
                                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                                @if(session('auth.current')=='admin')
                                    @can('View Customer') <a href="{{url('admin/customer')}}">Customers</a>@endcan
                                    @can('View Role & Permission')    <a href="{{url('admin/role_list')}}">Roles</a>@endcan
                                        @can('View Contact Us')   <a href="{{url('admin/contact_us')}}">Contact Us List</a>@endcan
                                        @can('View Subscriber')   <a href="{{url('admin/subscribe')}}">Subscriber</a>@endcan
                                @else

                                @endif
                                  <a href="{{ url('/dashboard') }}" >Dashboard </a>
                                @can('Create Poll')<a href="{{ url('/poll/create') }}" >Create Poll </a>@endcan
                                @can('View Poll')<a href="{{ url('/poll') }}" >Poll List</a>@endcan
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

    <style>
        a.active{
            background: #3f2ca7;
            color: white;
        }
    </style>
