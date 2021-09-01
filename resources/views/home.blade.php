@extends('layouts.app')
@section('title')
Home
@endsection

@section('extra_css')
<style>
    .images-bg-fix {
        background-image:url('{{asset('assets/images/contact.png')}}');
        background-color: #7258f3;
        background-repeat: no-repeat;
        background-size: cover;
        padding-top: 80px;
        height: 700px;
    }

    .images-bg-fix .theme-bar {
        float: inherit;
        width: 60%;
    }

    .section-contact .images-bg-fix .text-section .title-menu {
        text-align: right;
    }

    .section-contact .images-bg-fix .text-section li,
    .section-contact .images-bg-fix .text-section .first {
        margin-bottom: 25px;
    }

    header.transparent {
        position: absolute;
    }

    @media only screen and (max-width:1200px) {
        .images-bg-fix {
            height: 1350px;
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
        <img src="{{asset('assets/images/banner-main.png')}}" alt="slider">
        <div class="inside">
            <h2>Get Answers with <strong>Survays</strong></h2>
            <p>Be the person with great ideas. Surveys give you actionable insights
                and fresh perspectives..</p>
            <a href="{{ URL::to('/poll/create') }}" class="custom-btn">Get Started</a>
            <a href="{{URL::to('/select_plan')}}" class="custom-btn-white" style="margin-left:10px">Go Premium</a>
        </div>
        <!--inside-->
    </div>
</div>
<!--===================== End of Base Slider ========================-->

<div class="img-banner animatedParent">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <img src="{{asset('assets/images/base.png')}}">
            </div>

        </div>
    </div>
</div>
<div class="container">
    <div class="survay-section">
        <div class="row">
            <div class="col-md-4 col-lg-4 col-sm-4">
                <div class="">
                    <div class="title-head">
                        100+ Daily Survays
                        <div class="theme-bar theme-bar-30 theme-bar-center"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-4">
                <div class="">
                    <div class="title-head">
                        100+ Daily Survays
                        <div class="theme-bar theme-bar-30 theme-bar-center"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-4">
                <div class="">
                    <div class="title-head">
                        100+ Daily Survays
                        <div class="theme-bar theme-bar-30 theme-bar-center"></div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="row about-section reverse animatedParent" id="about">
        <div class="col-md-6 col-lg-6 col-sm-6 animated bounceInLeft">
            <div class="title-menu">
                About Us
                <div class="theme-bar theme-bar-20"></div>
            </div>
            <div class="side">
                <div class="first">
                    <p>Learn more about SurveyMonkey Enterprise and schedule a demo.</p>
                </div>
                <ul>
                    <li>
                        <p> Manage multiple users and gain visibility into all survey data collected across your
                            organization with admin controls and dashboards.</p>
                    </li>
                    <li>
                        <p> Ensure confidential data is protected with enhanced security including encryption, SSO,
                            and features that help you remain compliant with HIPAA and GDPR.
                        </p>
                    </li>
                    <li>
                        <p>Make feedback automated and actionable by connecting to key business systems using APIs
                            and powerful integrations, including Salesforce, Marketo, Tableau, and more.</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6  animated bounceInRight">
            <div class="side">
                <img src="{{asset('assets/images/about.png')}}">
            </div>
        </div>

    </div>
</div>
@if(!empty($polls)&& $polls!='[]')
    <div class="section-contact1">
        <div class=" animatedParent">
            <div class="container">
                <div class="top-header">
                    <div>
                        <h2> <b> Public polls</b></h2>
                        <div class="underline"></div>
                    </div>

                </div>
                <br>
                <br>
                @foreach($polls as $poll)
                <div class="recent-polls-body">
                    <div class="badge-left">{{$poll['name']}}</div>
                    <div class="badge-right">{{$poll['question']}}</div>
                    <div class="row"    >
                        @foreach($poll['votes'] as $vote)
                        <div class="col-lg-2 col-md-4 col-xs-6">
                            <div class="itom-box">
                                <h6>
                                    {{$vote['total_Vote']}}
                                </h6>

                                <b>{{$vote['question_option']}}</b>
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
<div class="section-contact" id="contact">
    <div class=" animatedParent">
        <div class="images-bg-fix">
            <div class="container">
                <div class="col-md-6 col-sm-6 animated bounceInRight">
                    <div class="login-bg contact-us-bg animatedParent">
                        <form method="POST" action="{{ url('contact_us/send') }}">
                            @csrf
                            <div class="form-group">
                                <label>First Name  @error('first_name')<sup style="color: red">*</sup>@enderror </label>
                                <input type="text"  name="first_name" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name  @error('last_name')<sup style="color: red">*</sup>@enderror</label>
                                <input type="text"  name="last_name" required>
                            </div>
                            <div class="form-group">
                                <label>Email @error('email')<sup style="color: red">*</sup>@enderror </label>
                                <input type="text" name="email" required>
                            </div>
                            <div class="form-group">
                                <label>Message  @error('message')<sup style="color: red">*</sup>@enderror</label>
                                <textarea name="message" required></textarea>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 text-section animated bounceInLeft">
                    <div class="title-menu float-right">
                        Contact Us
                        <div class="theme-bar theme-bar-20 theme-bar-white"></div>
                    </div>
                    <div class="side float-right">
                        <div class="first">
                            <p>Learn more about SurveyMonkey Enterprise and schedule a demo.</p>
                        </div>
                        <ul>
                            <li>
                                <p> Manage multiple users and gain visibility into all survey data collected across your
                                    organization with admin controls and dashboards.</p>
                            </li>
                            <li>
                                <p> Ensure confidential data is protected with enhanced security including encryption, SSO,
                                    and features that help you remain compliant with HIPAA and GDPR.
                                </p>
                            </li>
                            <li>
                                <p>Make feedback automated and actionable by connecting to key business systems using APIs
                                    and powerful integrations, including Salesforce, Marketo, Tableau, and more.</p>
                            </li>
                        </ul>
                    </div>
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
