@extends('layouts.app')
@section('title')
{{$title ?? 'List Table'}}
@endsection
@section('content')
@include('includes.datatable')
@endsection
