@extends('layouts.app')
@section('title')
Poll Data
@endsection
@section('content')
<div class="container">
    <div class="dashboard-body">
        <div class="top-header">
            <div>
                <h2> <b>Poll Data</b></h2>
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
                <div class="col-lg-12">
                    <label><b>Question :</b></label><label> {{$poll->question}}</label>
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
                    <label><b>Poll identifier Question :</b></label>
                    <ol>
                        @foreach($poll->pollIdentifierQuestions as $question)

                        <li> {{$question->identifier_question}}</li>

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
    </style>
@endsection
