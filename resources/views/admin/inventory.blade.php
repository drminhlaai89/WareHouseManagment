@extends('admin.master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush
@section('content')
    <div class="container">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Inventory</h4>
                    <div class="table-responsive">
                        <table class="table table-list">
                            <form role="form">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">

                                            <input type="search" id="search" class="form-control" placeholder="TÌM KIẾM">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <thead>
                                <th scope="">Product</th>
                                <th scope="">Inventory</th>
                                <th scope="">In Stock</th>
                                <th scope="">Out of Stock</th>
                                <th scope="">Total Import</th>
                                <th scope="">Total Export</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($inventory as $inventory)
                                <tr>


                                <td>{{ $inventory->productname }}</td>

                                <td>{{ $inventory->inventoryinstock }}</td>

                                <td>{{ $inventory->inventoryquanlity_of_import }}</td>
                                <td>{{ $inventory->inventoryquanlity_of_export }}</td>
                                <td>{{ $inventory->totalimport }}</td>
                                <td>{{ $inventory->totalexport }}</td>
                                <td><button class="btn btn-outline-success"><a
                                    href="/admin/inventory/update/{{ $inventory->inventoryid }}">Update</a></button></td>
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
                    url: '{{ URL::to('/report/inventory/search') }}',
                    data: {
                        'search': $value
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
