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
            <div class=" ">
                <div class="row">
                    <div class="col-lg-4">
                        <label><b>Name:</b></label><label> {{$poll->name}}</label>
                    </div>
                    <div class="col-lg-4">
                        <label><b>Info:</b></label><label> {{$poll->info}}</label>
                    </div>
                    <div class="col-lg-4">
                        <label><b>Question:</b></label><label> {{$poll->question}}</label>
                    </div>
                    <div class="col-lg-6">
                        <label><b>Poll Key:</b></label><br>
                        @foreach($poll->pollkeys as $key)
                            <label>000 {{$key->key}}</label><br>
                            <label> {{$key->key}}</label><br>
                        @endforeach
                    </div>
                    <div class="col-lg-12">
                        <label><b>Poll identifier Question:</b></label>
                        <table>
                            <th>
                            <td>Question</td>
                            </th>
                        @foreach($poll->pollIdentifierQuestions as $question)
                                <tr><td> {{$question->identifier_question}}</td></tr>
                        @endforeach
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
    @include('includes.datatable')
@endsection



