@extends('admin.master')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush
@section('content')

    <div class="card">
        <div class="card-body">
            <div style="margin-bottom: 20px">
                <a href="export/create" class="btn btn-primary">
                    <i class="mdi mdi-account-plus-outline "></i>Add new</a>
                <i class="d-inline-flex mdi mdi-account-search-outline" style="width: 50% ;padding-left:12%">
                    <input type="search" class="form-control form-control-sm" id="search" name="search"
                        placeholder="Search...">
                </i>
            </div>
            <div class="row">
                <div class="row">
                    <div class="col-12">
                        <table class="table nowrap table-hover table-centered dataTable no-footer" id="view_invoice_list"
                            role="grid" aria-describedby="view_invoice_list_info">
                            <thead class="thead-light">
                                <tr role="row" >
                                    <th style="width: 100px;" >ID</th>
                                    <th style="width: 300px;">Customer Name</th>
                                    <th style="width: 200px;">Created Date</th>
                                    <th  style="width: 300px;">Status Order</th>
                                    <th style="width: 200px;">Type</th>
                                    <th  style="text-align: center"  style="width: 300px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($exports as $export)
                                 <tr role="row">
                                    <td>{{$export ->exportorderid}}</td>
                                    <td><strong>{{$export->customername}}</strong></td>
                                    <td>{{$export->exportcreateddate}}</td>
                                    @php
                                    if($export->exporttype==0){
                                    echo('<td class="text-success">Order</td>');
                                    }else if($export->exporttype==1){
                                        echo '<td class="text-danger">Return</td>';
                                    }else{
                                        echo '<td class="text-warning"> PreOrder </td>';
                                    }
                                    @endphp
                                    
                                    @php
                                    if($export->exportstatus_transaction==0){
                                    echo('<td class="text-warning">Processing</td>');
                                    }else if($export->exportstatus_transaction==1){
                                        echo '<td class="text-success"> Done </td>';
                                    }else{
                                        echo '<td class="text-danger"> Cancel </td>';
                                    }
                                    @endphp
                                    <td>
                                        <button class="btn btn-outline-primary"><a
                                                href="/export/detail/{{ $export->exportid }}">Detail</a></button>
                                        <button class="btn btn-outline-success"><a
                                                href="/admin/export/accept/{{ $export->exportid }}">Accept</a></button>
                                        <button class="btn btn-outline-success"><a
                                                href="/admin/export/cancel/{{ $export->exportid }}">Cancel</a></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                $value = $(this).val();
                
                $.ajax({
                    type: 'get',
                    url: '{{ URL::to('/admin/export/order-pending/search') }}',
                    data: {
                        'search': $value,
                        
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

