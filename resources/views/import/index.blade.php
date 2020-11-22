@extends('layout.master')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<style typee="text/css">
    body {
        font: 14px sans-serif;
    }

    .wrapper {
        width: 350px;
        padding: 20px;
    }

    .form-control-borderless {
        border: none;
    }

    .form-control-borderless:hover,
    .form-control-borderless:active,
    .form-control-borderless:focus {
        border: none;
        outline: none;
        box-shadow: none;
    }

</style>

@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush
@section('content')
<div class="card">
    <div class="card-body">
        <div style="margin-bottom: 20px">
            <a href="import/create" class="btn btn-primary">
                <i class="mdi mdi-account-plus-outline "></i>Add new</a>
             <i class="d-inline-flex mdi mdi-account-search-outline" style="width: 50% ;padding-left:12%">
                <input type="search" class="form-control form-control-sm" id="search" name="search"
                    placeholder="Search...">
            </i><h3 style="text-align :center">Import List</h3>
        </div>
            <div class="row">
                <div class="col-12">
                    <table class="table nowrap table-hover table-centered dataTable no-footer">
                        <thead class="thead-light">
                            <tr role="row">
                            <th style="width: 70px;">ID</th>
                            <th style="width: 200px;">Supplier Name</th>
                            <th style="width: 200px;">Created Date</th>
                            <th style="width: 150px;">Status Order</th>
                            <th style="width: 150px;">Status Transaction</th>
                            <th style="width: 150px;">Status Shipping</th>
                            <th style="padding-left: 75px">Action</th>
                            </tr>
                    </thead>
                    <tbody>

                        @foreach ($imports as $import)
                            <tr>
                                <td>{{ $import->importorderid}}</td>
                                <td>{{ $import->suppliername }}</td>
                                <td>{{ $import->importcreateddate }}</td>
                                <td>
                                    @php
                                    if($import->importstatus_order==0){
                                    echo('<span class="btn btn-warning">Processing</span>');
                                    }else if($import->importstatus_order==1){
                                    echo('<span class="btn btn-success">Accept</span>');
                                    }else{
                                    echo('<span class="btn btn-danger">Cancel</span>');
                                    }
                                    @endphp
                                </td>
                                <td>
                                    @php
                                    if($import->importstatus_transaction==0){
                                    echo('<span class="btn btn-warning">Processing</span>');
                                    }else if($import->importstatus_transaction==1){
                                    echo('<span class="btn btn-success">Done</span>');
                                    }else{
                                    echo('<span class="btn btn-danger">Cancel</span>');
                                    }
                                    @endphp
                                </td>
                                <td>
                                    @php
                                    if($import->importstatus_shipping==0){
                                    echo('<span class="btn btn-warning">Processing</span>');
                                    }else if($import->importstatus_shipping==1){
                                    echo('<span class="btn btn-success">Done</span>');
                                    }else{
                                    echo('<span class="btn btn-danger">Cancel</span>');
                                    }
                                    @endphp
                                </td>
                                <td>
                                    <a href="/import/detail/{{ $import->importid }}"class="btn btn-info text-light"
                                        data-toggle="tooltip" data-placement="bottom" title=""
                                        data-original-title="View Profile"><i class="mdi mdi-eye"></i>View</a>
                                    <a href="/import/update/{{ $import->importid }}"class="btn btn-primary text-light"
                                        data-toggle="tooltip" data-placement="bottom"
                                        data-original-title="Update Profile"><i class="mdi mdi-account-edit"></i>Print</a>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
                {{$imports->links("pagination::bootstrap-4")}}
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
                    url: '{{ URL::to('/import/search') }}',
                    data: {
                        'search': $value,
                        'id': $id
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
