@extends('layouts.app')
@section('title')
    Polls List
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Polls List</div>

                    <div class="panel-body">
                        <table class="table" id="datatable">
                            <thead>
                            <tr>
                                <th>First name</th>
                                <th>info</th>
                                <th>Category</th>
                                <th>Visibility</th>
                                <th>Question</th>
                                <th>Status</th>
                                <th>Start_date</th>
                                <th>End_date</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($polls as $poll)
                                <tr>
                                    <td>{{ $poll->name }}</td>
                                    <td>{{ $poll->info }}</td>
                                    <td>{{ $poll->category }}</td>
                                    <td>{{ $poll->visibility }}</td>
                                    <td>{{ $poll->question }}</td>
                                    <td>{{ $poll->status }}</td>
                                    <td>{{ $poll->start_date }}</td>
                                    <td>{{ $poll->end_date }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" charset="utf8" src="cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable();
        });
    </script>
@endsection

@section('extra_css')
    <link rel="stylesheet" type="text/css" href="cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <style>
    </style>
@endsection


