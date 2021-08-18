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
                <div class="col-lg-6">
                    <label><b>Question :</b></label><label> {{$poll->question}}</label>
                </div>
                <div class="col-lg-6">
                    <label><b>Poll Key :</b></label><br>
                    @foreach($poll->pollkeys as $key)
                    <label> {{$key->key}}</label><br>
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
<div class="container login-container content-order animatedParent">
    <div class="table-outer-body">
        {!! $dataTable->table() !!}
    </div>
</div>
<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    z .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active,
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_processing,
    .dataTables_wrapper .dataTables_paginate {
        color: #3b83f6b5 !important;
    }
</style>

@endsection

@section('extra_js')
{!! $dataTable->scripts() !!}
@endsection

@section('extra_css')

@endsection
