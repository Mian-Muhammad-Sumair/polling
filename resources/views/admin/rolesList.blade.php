@extends('layouts.app')
@section('title')
Rolls List
@endsection
@section('extra_css')
<style>
    .table-outer-body .dataTable tbody tr td:last-child a{
    background: #3116c1;
    color: white;
    padding: 10px;
    border-radius: 7px;
        width: auto;

    box-shadow: 1px 1px 11px rgb(98 129 157 / 40%);
}


</style>
@endsection
@section('content')
    @include('includes.datatable')
@endsection
