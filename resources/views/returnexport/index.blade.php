@extends('layout.master')

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
                                <tr role="row">
                                    <th >ID</th>
                                    <th style="width: 300px;">Supplier</th>
                                    <th style="width: 300px;">Date created</th>
                                    <th style="width: 300px;">Status Transaction</th>
                                    <th style="width: 300px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($exports as $exports)
                                 <tr role="row">
                                    <td>{{ $exports->exportorderid }}</td>
                                    <td><strong>{{ $exports->customername }}</strong></td>
                                    <td>{{ $exports->exportcreateddate }}</td>

                                    @php
                                    if($exports->exportstatus_transaction==0){
                                    echo('<td class="text-warning">Processing</td>');
                                    }else if($exports->exportstatus_transaction==1){
                                    echo '<td class="text-success"> Done </td>';
                                    }else{
                                    echo '<td class="text-danger"> Cancel </td>';
                                    }
                                    @endphp
                                    <td>
                                        <a href="{{ url('export/detail') }}/{{ $exports->exportid }}"
                                            class="btn btn-info text-light" data-toggle="tooltip"
                                            data-placement="bottom" title="" data-original-title="View Profile">
                                            <i class="mdi mdi-eye"></i>
                                        </a>
                                        @php
                                        if($exports->exportstatus_order == 1) {
                                            echo('<a href="/export/update/'.$exports->exportid .'" class="btn btn-primary text-light" data-toggle="tooltip" data-placement="bottom" data-original-title="Update Profile">
                              <i class="mdi mdi-account-edit"></i>Update</a>');
                                        }
                                    @endphp
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
                    url: '{{ URL::to('/supplier/search') }}',
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


