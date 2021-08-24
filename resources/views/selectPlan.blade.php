@extends('layouts.app')
@section('title')
Select Plan
@endsection
@section('extra_css')
<style>
    .container {
        width: 70%;
    }

    .desc {
        line-height: 20px;
    }

    .card .main-card {
        margin: 16px 16px 40px 16px;
        float: left;
        box-sizing: border-box;
        text-align: center;
        border-radius: 10px;
        padding: 0 0 20px;
        background: #F3F3F3;
        /* box-shadow: 0 10px 10px rgba(0, 0, 0, .2); */
        transition: .5s;
    }

    .card .main-card {
        background-repeat: no-repeat;
        height: 610px;
        background-color: #F3F3F3;
        background-size: cover;
    }

    .card-payment-row .col-lg-4 .title {
        background: #808080;
        height: 100px;
        color: white;
        font-size: 20px;
        padding: 20px;
        border-radius: 10px;
    }

    .card-payment-row .col-lg-4:first-child .title {
        background: #7158F4;

    }

    .card-payment-row .col-lg-4:last-child .title {
        background: #7158F4;
    }

    .card-payment-row .col-lg-4:first-child .triangle {
        width: 98.5%;
        margin-left: 0.8%;
        height: 4%;
        margin-top: -0.7px;
        background-image: linear-gradient(to top right, transparent 50%, #7158F4 50%), linear-gradient(to top left, transparent 50%, #7158F4 50%);
        background-size: 50.2% 100%;
        background-repeat: no-repeat;
        background-position: top left, top right;
    }

    .card-payment-row .col-lg-4 .triangle {
        width: 98.5%;
        margin-left: 0.8%;
        height: 4%;
        margin-top: -0.7px;
        background-image: linear-gradient(to top right, transparent 50%, #808080 50%), linear-gradient(to top left, transparent 50%, #808080 50%);
        background-size: 50.2% 100%;
        background-repeat: no-repeat;
        background-position: top left, top right;
    }

    .card-payment-row .col-lg-4:last-child .triangle {
        width: 98.5%;
        margin-left: 0.8%;
        height: 4%;
        margin-top: -0.7px;
        background-image: linear-gradient(to top right, transparent 50%, #7158F4 50%), linear-gradient(to top left, transparent 50%, #7158F4 50%);
        background-size: 50.2% 100%;
        background-repeat: no-repeat;
        background-position: top left, top right;
    }


    /*.triangle {*/
    /*    width: 0;*/
    /*    height: 0;*/
    /*    border-left: 50px solid transparent;*/
    /*    border-right: 50px solid transparent;*/
    /*    border-bottom: 100px solid red;*/
    /*}*/

    .main-sec {
        padding: 40px 20px;
    }

    .card .desc {
        /* font-weight: 600; */
        font-size: 14px;
    }

    .card .bar .theme-bar {
        padding: 5px;
        margin: auto;
    }

    .card .bar {
        margin: 40px 0;
    }

    .card .option ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .card .options {
        padding: 0 10px 0 30px;
    }

    .card .options ul li {
        color: #000;
        /*padding: 0 10px;*/
        font-size: 16px;
        font-weight: 500;
        text-align: left;
    }

    .card .custom-btn {
        margin-top: -10px;
        font-size: 14px;
        text-transform: capitalize !important;
        background-color: #404040;
    }

    .card .custom-btn:hover {
        margin-top: 20px;
        background-color: black;
    }

    .card .options ul li::before {
        content: "\2022";
        color: #7158F4;
        font-size: 30px;
        font-weight: bold;
        display: inline-block;
        width: 1em;
        margin-left: -1em;

    }

    .card p {
        color: #000;
        /* margin-left: 15px; */
        font-size: 14px;
        margin-top: -24px;
        line-height: initial;
    }

    @media only screen and (max-width: 1762px) {
        .card .main-card {
            height: 595px;
        }

        .main-sec {
            padding: 30px 15px;
        }
    }

    @media only screen and (max-width: 1719px) {
        .main-sec {
            padding: 40px 20px;
        }

        .card .main-card {
            height: 615px;
        }

        .container {
            width: 80%;
        }
    }

    @media only screen and (max-width: 1542px) {
        .container {
            width: 90%;
        }
    }

    @media only screen and (max-width: 1380px) {
        .card .main-card {
            height: 635px;
        }

    }

    @media only screen and (max-width: 1357px) {
        .card .bar {
            margin: 20px 0px;
        }

        .card .main-card {
            height: 710px;
        }

    }

    @media only screen and (max-width: 1371px) {
        .card .main-card {
            height: 710px;
        }

    }

    @media only screen and (max-width: 1357px) {
        .card .main-card {
            height: 670px;
        }
    }

    @media only screen and (max-width: 1334px) {
        .main-sec {
            padding: 30px 15px;
        }

        .card .main-card {
            height: 650px;
        }
    }

    @media only screen and (max-width: 1324px) {
        .card .main-card {
            height: 630px;
        }

        .card .desc {
            font-size: 14px
        }
    }

    @media only screen and (max-width: 1241px) {
        .card .main-card {
            height: 630px;
        }

        .card p {
            margin-left: 6px;
            font-size: 15px;
        }

        .card .desc {
            font-size: 14px;
        }
    }

    @media only screen and (max-width: 1217px) {
        .main-sec {
            padding: 30px 10px;
        }
    }

    @media only screen and (max-width: 1184px) {
        .card p {
            font-size: 14px;
        }

        .card .main-card {
            height: 555px;
        }

        .custom-btn {
            padding: 10px 20px;
        }
    }

    @media only screen and (max-width: 1181px) {
        .card .main-card {
            height: 620px;
        }
    }

    @media only screen and (max-width: 1087px) {
        .card .main-card {
            height: 580px;
        }

        .main-sec {
            padding: 20px 10px;
        }

        .card .desc,
        .card p {
            font-size: 12px;
        }

    }


    .custom-btn {
        box-shadow: none !important;
    }
</style>
@endsection
@section('content')
<div class="container animatedParent card-payment-row">
    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-4 ">
            <div class="card ">
                <div class="main-card">
                    <h2 class="title ">Plan 1</h2>
                    <div class="triangle "></div>
                    <div class="main-sec">
                        <div class="desc">
                            Make feedback automated and actionable by connecting to key business systems using APIs
                            and
                            powerful integrations, including Salesforce, Marketo, Tableau, and more.

                        </div>
                        <div class="bar">
                            <div class="theme-bar theme-bar-20"></div>
                        </div>
                        <div class="options">
                            <ul>
                                <li>
                                    <p>
                                        Survey sharing with fine control over
                                        who can view and edit
                                    </p>
                                </li>
                                <li>
                                    <p>Survey sharing with fine control over
                                        who can view and edit
                                    </p>
                                </li>
                                <li>
                                    <p>Survey sharing with fine control over
                                        who can view and edit
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        Survey sharing with fine control over
                                        who can view and edit
                                    </p>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <a href="{{ URL::to('/') }}" class="custom-btn ">Choose Plan </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-4 ">
            <div class="card ">
                <div class="main-card">
                    <h2 class="title ">Plan 2</h2>
                    <div class="triangle "></div>
                    <div class="main-sec">
                        <div class="desc">
                            Make feedback automated and actionable by connecting to key business systems using APIs
                            and
                            powerful integrations, including Salesforce, Marketo, Tableau, and more.

                        </div>
                        <div class="bar">
                            <div class="theme-bar theme-bar-20"></div>
                        </div>
                        <div class="options">
                            <ul>
                                <li>
                                    <p>
                                        Survey sharing with fine control over
                                        who can view and edit
                                    </p>
                                </li>
                                <li>
                                    <p>Survey sharing with fine control over
                                        who can view and edit
                                    </p>
                                </li>
                                <li>
                                    <p>Survey sharing with fine control over
                                        who can view and edit
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        Survey sharing with fine control over
                                        who can view and edit
                                    </p>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <a href="{{ URL::to('/') }}" class="custom-btn ">Choose Plan </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-4 ">
            <div class="card ">
                <div class="main-card">
                    <h2 class="title ">Plan 3</h2>
                    <div class="triangle "></div>

                    <div class="main-sec">
                        <div class="desc">
                            Make feedback automated and actionable by connecting to key business systems using APIs
                            and
                            powerful integrations, including Salesforce, Marketo, Tableau, and more.

                        </div>
                        <div class="bar">
                            <div class="theme-bar theme-bar-20"></div>
                        </div>
                        <div class="options">
                            <ul>
                                <li>
                                    <p>
                                        Survey sharing with fine control over
                                        who can view and edit
                                    </p>
                                </li>
                                <li>
                                    <p>Survey sharing with fine control over
                                        who can view and edit
                                    </p>
                                </li>
                                <li>
                                    <p>Survey sharing with fine control over
                                        who can view and edit
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        Survey sharing with fine control over
                                        who can view and edit
                                    </p>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <a href="{{ URL::to('/') }}" class="custom-btn ">Choose Plan </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection