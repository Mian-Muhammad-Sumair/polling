@extends('layouts.app')
@section('title')
Rolls List
@endsection
@section('extra_css')
<style>
    table .custom-btn{
    background: #3f2ca7;
    border-radius: 7px;
    box-shadow: 1px 1px 11px rgb(98 129 157 / 40%);
}
</style>
@endsection
@section('content')
    @include('includes.datatable')
@endsection
