@extends('layouts.app')
@section('title')
Dashboard
@endsection
@section('extra_css')
<style>
    .dashboard-body .top-header {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }

    .dashboard-body .top-header h5 {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }

    .dashboard-body .top-header h5 b {
        margin-right: 5px;
    }

    .dashboard-body .top-header h5 .green-dot {
        height: 15px;
        width: 15px;
        margin: 5px 10px;
        border-radius: 100px;
        background: greenyellow;
    }

    .dashboard-body .underline {
        width: 100px;
        height: 3px;
        background: #7259F4;
    }

    .dashboard-body .profile-section {
        margin-top: 40px;
    }

    .dashboard-body .profile-section .profile {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }

    .dashboard-body .profile-section .profile .img-outer {
        height: 100px;
        width: 100px;
        overflow: hidden;
        border-radius: 100px;
    }

    .dashboard-body .profile-section .profile .img img {
        height: 100px;
        width: 100%;
    }

    .dashboard-body .profile-section .profile .text {
        margin-left: 25px;
        margin-top: 10px;
    }

    .dashboard-body .profile-section .profile .text h6 {
        font-weight: bold;
        font-size: 16px;
        color: #7259F4;
    }

    .dashboard-body .profile-section .profile .text p {
        font-size: 14px;
        margin-bottom: 5px;
    }

    .dashboard-body .profile-section .profile .text a {
        margin-bottom: 10px;
    }

    .dashboard-body .profile-section .profile .text .social-icons {

        margin-bottom: 10px !important;
    }

    .dashboard-body .profile-section .profile .text .social-icons span {
        font-size: 12px;
        font-weight: bold;
        margin-left: 5px;
    }

    .dashboard-body .profile-section .profile .text .social-icons .fa-twitter {
        color: #00A7E7;
        margin-bottom: 10px;
    }

    .dashboard-body .profile-section .profile .text .social-icons .fa-facebook {
        color: #3A5794;
        margin-bottom: 10px;
    }

    .dashboard-body .profile-section .profile .text .social-icons .fa-link {
        color: lightcoral;
        margin-bottom: 10px;
    }

    .dashboard-body .pool-card {
        min-height: 80px;
        width: 100%;
        background: #f5f5f5;
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .dashboard-body .pool-card .fa-info-circle {
        font-size: 12px;
        margin-left: 10px;
    }

    .dashboard-body .pool-card h5 {
        color: rgba(128, 128, 128, 0.774);
    }

    .dashboard-body .pool-card .numbers {
        color: rgba(0, 0, 0, 0.644);
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="dashboard-body">
        <div class="top-header">
            <div>
                <h2> <b> Welcome Back</b></h2>
                <div class="underline"></div>
            </div>
            <div>
                <h5>
                    <b>Current plan : </b>Plan 1
                </h5>
                <h5>
                    <b>Status : </b>online <span>
                        <div class="green-dot"></div>
                    </span>
                </h5>
            </div>
        </div>
        <div class="profile-section">
            <div class="row">
                <div class="col-lg-4">
                    <div class="profile">
                        <div class="img">
                            <div class="img-outer">
                                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="">
                            </div>
                        </div>
                        <div class="text">
                            <h6>{{$user['name']}}</h6>
                            <p>{{$user['about']}}</p>
                            <a href="customer/{{$user['id']}}">settings</a>
                            <p>{{$user['email']}}</p>
                            <div class="social-icons">
                                <i class="fa fa-twitter"></i> <span>Share with twitter</span>
                                <br>
                                <i class="fa fa-facebook"></i> <span>Share with facebook</span>
                                <br>
                                <i class="fa fa-link"></i> <span>Copy link</span>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="pool-card">
                                <h5>Total Poll <i class="fa fa-info-circle"> </i></h5>
                                <h5 class="numbers">{{$totalPoll}}<i class="fa fa-info-circle"> </i></h5>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="pool-card">
                                <h5>Open Poll <i class="fa fa-info-circle"> </i></h5>
                                <h5 class="numbers">{{$activePoll}}<i class="fa fa-info-circle"> </i></h5>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="pool-card">
                                <h5>Expired Poll <i class="fa fa-info-circle"> </i></h5>
                                <h5 class="numbers">{{$expiredPoll}}<i class="fa fa-info-circle"> </i></h5>
                            </div>
                        </div>
                        {{-- <div class="col-lg-4">--}}
                        {{-- <div class="pool-card">--}}
                        {{-- <h5>Open Pool <i class="fa fa-info-circle"> </i></h5>--}}
                        {{-- <h5 class="numbers">00<i class="fa fa-info-circle"> </i></h5>--}}
                        {{-- </div>--}}
                        {{-- </div>--}}


                    </div>
                </div>
            </div>
            <div class="row">
                @include('includes.datatable')
            </div>
            <div class="top-header">
                <div>
                    <h2> <b> Recent polls</b></h2>
                    <div class="underline"></div>
                </div>

            </div>
            <br>
            <br>
            <div class="recent-polls-body">
                <div class="badge-left">Name Here</div>
                <div class="badge-right">Draft</div>
                <div class="row">
                    <div class="col-lg-2 col-md-4 col-xs-6">
                        <div class="itom-box">
                            <h6>
                                0
                            </h6>

                            <b>title here</b>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-xs-6">
                        <div class="itom-box">
                            <h6>
                                0
                            </h6>

                            <b>title here</b>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-xs-6">
                        <div class="itom-box">
                            <h6>
                                0
                            </h6>

                            <b>title here</b>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-xs-6">
                        <div class="itom-box">
                            <h6>
                                0
                            </h6>

                            <b>title here</b>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-xs-6">
                        <div class="itom-box">
                            <h6>
                                0
                            </h6>

                            <b>title here</b>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-xs-6">
                        <div class="itom-box">
                            <h6>
                                0
                            </h6>

                            <b>title here</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection