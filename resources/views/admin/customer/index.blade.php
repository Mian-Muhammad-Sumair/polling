@extends('layouts.app')
@section('title')
    Customer List
@endsection

@section('content')
    <div class="container login-container content-order animatedParent">
    {!! $dataTable->table() !!}
    </div>
@endsection

@section('extra_js')



    {!! $dataTable->scripts() !!}
@endsection
