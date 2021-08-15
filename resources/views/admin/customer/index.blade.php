@extends('layouts.app')
@section('title')
Customer List
@endsection


@section('content')
<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active,
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_processing,
    .dataTables_wrapper .dataTables_paginate {
        color: #3b83f6b5  !important;
    }
</style>
<div class="container login-container content-order animatedParent">
    <div class="table-outer-body">
        {!! $dataTable->table() !!}
    </div>
</div>
@endsection

@section('extra_js')


{{-- <script src="/vendor/datatables/buttons.server-side.js"></script>--}}
{!! $dataTable->scripts() !!}
@endsection