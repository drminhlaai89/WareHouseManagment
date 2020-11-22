@extends('layout.master')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<style type="text/css">
    body{
        font: 14px sans-serif;
    }.wrapper{width: 350px; padding: 20px;}
    .form-control-borderless {
        border: none;
    }

    .form-control-borderless:hover, .form-control-borderless:active, .form-control-borderless:focus {
        border: none;
        outline: none;
        box-shadow: none;
    }
</style>

@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush
@section('content')
<div class="container pt-3">
    <h3 style="color: rgb(68, 219, 212);text-align: center">Select Customer</h3>
        <div class="col-12 col-md-10 col-lg-8">
            <form class="card card-sm">
                        <meta name="_token" content="{{ csrf_token() }}">
                        <i style="width: 130% ; height: 0px; padding-left: 200px">
                            <input type="search" class="form-control form-control-sm" id="search" name ="search"  placeholder="Search...">
                        </i> 
            </form>
    </div>
    <div class="container pt-3">
        <div class="row text-center">
            <div class="col-lg-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @if ($customers)
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->customerid }}</td>
                                    <td><strong>{{ $customer->customername }}</strong></td>
                                    <td>{{ $customer->customeremail }}</td>
                                    <td>{{ $customer->customerphone }}</td>
                                    <td>{{ $customer->customeraddress }}</td>
                                <td><a href="/export/{{$customerid}}/customer/{{$customer->customerid}}"
                                        class="btn btn-primary btn-sm">Select</a></td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div>
                    <input value="{{$customerid}}" hidden readonly id="id">
                    </div>
            </div>
        </div>
    </div>
</div>

    <script>
        $(document).ready(function() {


            $('#search').on('keyup', function() {
                $value = $(this).val();
                $id = $('#id').val();
                $.ajax({
                    type: 'get',
                    url: '{{ URL::to('/export/customer/search') }}',
                    data: {
                        'search': $value,
                        'id' : $id
                    },
                    success: function(data) {
                        $('tbody').html(data);
                    }
                });
            })
            $.ajaxSetup({
                headers: {
                    'csrftoken': '{{ csrf_token() }}'
                }
            });
        });

    </script>
@endsection
@push('plugin-scripts')
    {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
    {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush

@push('custom-scripts')
    {!! Html::script('/assets/js/dashboard.js') !!}
@endpush
