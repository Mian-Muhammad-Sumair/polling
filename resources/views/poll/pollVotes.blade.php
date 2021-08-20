@extends('layouts.app')
@section('title')
    Poll Data
@endsection
@section('content')
    <div class="container">
        <div class="dashboard-body">
            <div class="top-header">
                <div>
                    <h2><b>{{$selectedOption->question_option}} Option Total Votes</b></h2>
                    <div class="underline"></div>
                </div>
            </div>
            <div class="poll-date-section">
                <div class="row">
                    <div class="col-lg-6">
                        <label><b>Name :</b></label><label> {{$poll->name}}</label>
                    </div>
                    <div class="col-lg-6">
                        <label><b>Info :</b></label><label> {{$poll->info}}</label>
                    </div>

                    <div class="col-lg-6">
                        <label style="font-size: 18px"><b>Question :</b></label><label> {{$poll->question}}</label><br>
                    </div>
                    <div class="col-lg-12">
                        <label><b>Poll Key :</b></label><br>
                        @foreach($poll->pollkeys as $index=>$key)
                            <label class="selected">( {{$key->key}} )</label>
                            @if(count($poll->pollkeys)!=$index+1)
                                <span class="separate">--</span>
                        @endif
                        @endforeach
                    </div>
                    <div class="col-lg-12">
                        <label><b>Total Vote - Options :</b></label>
                        <ol>
                            @foreach($pollVote as $index=>$Options)
                                <li class="{{$selectedOption->question_option==$Options['question_option']?'selected':''}}"
                                    class="selected">
                                    @if($Options['total_Vote']>0 && $selectedOption->question_option!=$Options['question_option'])
                                    <a href='/poll/votes/{{$Options['poll_id']}}/{{$Options['id']}}'>{{$Options['total_Vote']}}
                                        <span class="separate"> - </span>{{$Options['question_option']}}</a>
                                    @else
                                        {{$Options['total_Vote']}} <span class="separate"> - </span> {{$Options['question_option']}}
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.datatable')
@endsection

@section('extra_js')
@endsection

@section('extra_css')
    <style>
        .selected {
            color: #7259F4 !important;
            font-weight: 800;
        }
        .ol a{
            text-decoration: none;
            color:#7782aa !important;
        }
        .separate{
            font-weight: bold;
            font-size: 18px;
        }
    </style>

@endsection
