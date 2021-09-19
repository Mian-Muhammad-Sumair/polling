<div class="container login-container content-order animatedParent">
    <div class="table-outer-body">
        <div class="table table-responsive">
{{--            @yield('pollName')--}}
            {!! $dataTable->table() !!}
        </div>
    </div>
</div>


@section('extra_js')

    {!! $dataTable->scripts() !!}

@endsection
