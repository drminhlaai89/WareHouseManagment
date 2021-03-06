@extends('layout.master');
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
@push('plugin-style')
@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <a href="/return/import/create" class="btn btn-primary">
                <i class="mdi mdi-account-plus-outline"></i>Add new</a>
            <i class="d-inline-flex mdi mdi-account-search-outline" style="width: 50% ;padding-left:12%">
                <input type="search" class="form-control form-control-sm" id="search" name="search" placeholder="Search...">
            </i>
            <div>
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table dt-responsive">
                            <thead class="thead-light">
                                <tr role="row">
                                    <th style="width: 70px;">ID</th>
                                    <th style="width: 200px;">Supplier</th>
                                    <th style="width: 200px;">Date Created</th>
                                    <th style="width: 100px;">Transaction Status</th>
                                    <th style="width: 110px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($imports)
                                    @foreach ($imports as $imports)
                                        <tr role="row">
                                            <td>{{ $imports->importorderid }}</td>
                                            <td><strong>{{ $imports->suppliername }}</strong></td>
                                            <td>{{ $imports->importcreateddate }}</td>

                                            @php
                                            if($imports->importstatus_transaction==0){
                                            echo('<td class="text-warning">Processing</td>');
                                            }else if($imports->importstatus_transaction==1){
                                            echo '<td class="text-success"> Done </td>';
                                            }else{
                                            echo '<td class="text-danger"> Cancel </td>';
                                            }
                                            @endphp
                                            <td>
                                                <a href="{{ url('import/detail') }}/{{ $imports->importid }}"
                                                    class="btn btn-info text-light" data-toggle="tooltip"
                                                    data-placement="bottom" title="" data-original-title="View Profile">
                                                    <i class="mdi mdi-eye"></i>
                                                </a>
                                                @php
                                                if($imports->importstatus_order == 1) {
                                                echo('<a href="/import/update/'.$imports->importid  .'"
                                                    class="btn btn-primary text-light" data-toggle="tooltip"
                                                    data-placement="bottom" data-original-title="Update Profile">
                                                    <i class="mdi mdi-account-edit"></i>Update</a>');
                                                }
                                                @endphp
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
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
                $id = $('#id').val();
                $.ajax({
                    type: 'get',
                    url: '{{ URL::to('/supplier/search') }}',
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
