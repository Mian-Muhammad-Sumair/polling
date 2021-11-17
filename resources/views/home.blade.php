@extends('layouts.app')
@section('title')
{{__('home.title')}}
@endsection

@section('extra_css')
<style>
    .images-bg-fix {
        background-image:url('{{asset('assets/images/contact.png')}}');
        background-color: #1f46a2;
        background-repeat: no-repeat;
        background-size: cover;
        padding: 50px 0px;

        /* height: 700px; */
    }

    .images-bg-fix .theme-bar {
        float: inherit;
        width: 40%;
    }


    .section-contact .images-bg-fix .text-section li,
    .section-contact .images-bg-fix .text-section .first {
        margin-bottom: 10px;
    }

    /* header.transparent {
        position: absolute;
    } */

    @media only screen and (max-width:1200px) {
        .images-bg-fix {
            
            /* height: 1350px; */
        }

        .section-contact {
            padding: 40px 0 40px 0;
        }
    }
</style>

@endsection

@section('content')

<div class="base-slider owl-carousel owl-theme bg-gray">
    <div class="item">
        <img src="{{asset('assets/images/banner-main.png?v=1')}}" alt="slider">
        <div class="inside">
            {!! __('home.banner_description') !!}
          <a href="{{ URL::to('/poll/create') }}" class="custom-btn">{{__('home.Get Started')}}</a>
            <a href="{{URL::to('/select_plan')}}" class="custom-btn custom-btn-white" style="margin-left:10px">{{__('home.Go Premium')}}</a>
        </div>
        <!--inside-->
    </div>
</div>
<!--===================== End of Base Slider ========================-->

@if(!empty($polls)&& $polls!='[]')
    <div class="section-contact1">
        <div class=" animatedParent">
            <div class="container">
                <div class="top-header">
                    <div>
                        <h2> <b> {{__('home.Public polls')}}</b></h2>
                        <div class="underline"></div>
                    </div>

                </div>
                <br>
                <br>
                @foreach($polls as $poll)
                    <div class="recent-polls-body">
                        <div class="badge-left">{!! $poll['name'] !!}</div>
{{--                        <div class="badge-right">{!! $poll['question']!!}</div>--}}
                        <div class="row"   style="text-align: center;" >
                            <div class="col-lg-12 col-md-12 col-xs-12"><b>{!! $poll['question']!!}</b></div>
                            @if($poll['question_video'])

                                <video width="320" height="240" controls>
                                    <source src="{{asset($poll['question_video'])}}" type="video/mp4">
                                    <source src="{{asset($poll['question_video'])}}" type="video/ogg">
                                </video>
                            @endif
                        </div>
                        <div class="row"    >
                            @foreach($poll['votes'] as $vote)
                                <div class="col-lg-2 col-md-12 col-xs-12  item-main" >
                                    <div class="itom-box" >
                                        <h6>
                                            {{$vote['total_Vote']}}
                                        </h6>

                                        <b>{!!  $vote['question_option']!!}</b>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
<div class="container">
    <div class="survay-section">
        <div class="row">
            <div class="col-md-6 col-lg-4 col-sm-4">
                <div class="">
                    <div class="title-head">
                        {{__('home.100+ Daily Surveys')}}
                        <div class="theme-bar theme-bar-30 theme-bar-center"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-sm-4">
                <div class="">
                    <div class="title-head">
                        {{__('home.100+ Daily Surveys')}}
                        <div class="theme-bar theme-bar-30 theme-bar-center"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4 col-sm-4">
                <div class="">
                    <div class="title-head">
                        {{__('home.100+ Daily Surveys')}}
                        <div class="theme-bar theme-bar-30 theme-bar-center"></div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="row about-section reverse animatedParent" id="about">
        <div class="col-md-6 col-lg-6 animated bounceInLeft">
            <div class="title-menu">
                {{__('About Us')}}
                <div class="theme-bar theme-bar-20"></div>
            </div>
            {!! __('home.About Description') !!}
        </div>
        <div class="col-md-6 col-lg-6  animated bounceInRight">
            <div class="side">
                <img src="{{asset('assets/images/about.png')}}">
            </div>
        </div>

    </div>
</div>

<div class="section-contact" id="contact">
    <div class=" animatedParent">
        <div class="images-bg-fix">
            <div class="container">
                <div class="col-md-6 animated bounceInRight">
                    <div class="login-bg contact-us-bg animatedParent">
                        <form method="POST" action="{{ url('contact_us/send') }}">
                            @csrf
                            <div class="form-group">
                                <label>{{__('home.First Name')}}   @error('first_name')<sup style="color: red">*</sup>@enderror </label>
                                <input type="text"  name="first_name" required>
                            </div>
                            <div class="form-group">
                                <label>{{__('home.Last Name')}}  @error('last_name')<sup style="color: red">*</sup>@enderror</label>
                                <input type="text"  name="last_name" required>
                            </div>
                            <div class="form-group">
                                <label>{{__('home.Email')}} @error('email')<sup style="color: red">*</sup>@enderror </label>
                                <input type="text" name="email" required>
                            </div>
                            <div class="form-group">
                                <label>{{__('home.Message')}}  @error('message')<sup style="color: red">*</sup>@enderror</label>
                                <textarea name="message" required></textarea>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit">{{__('home.Send')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 text-section animated bounceInLeft">
                    <div class="title-menu" style="text-align: right; margin-bottom:10px">
                        {{__('home.Contact Us')}}
                    </div>

                    <div class="theme-bar theme-bar-20 theme-bar-white" style="float:right"></div>
<br>
                    {!! __('home.Contact Us Description') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra_js')
<script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 1
            }
        }
    })
</script>
@endsection
