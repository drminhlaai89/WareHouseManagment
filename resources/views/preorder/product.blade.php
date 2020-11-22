@extends('layout.master');
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
@push('plugin-style')
@endpush
@section('content')

@php
use Carbon\Carbon;
$dt = Carbon::now();
echo $dt->toDateString();     
@endphp
    <div class="card">
       <div class="card-body">
             <a href="/product/create" class="btn btn-primary">
                <i class="mdi mdi-account-plus-outline"></i>Add new</a> 
                <i class="d-inline-flex mdi mdi-account-search-outline" style="width: 50% ;padding-left:12%">
                    <input type="search" class="form-control form-control-sm" id="search" name ="search"  placeholder="Search...">
                </i>
          <div>
              <br>
            <div class="row">
                <div class="col-sm-12">
                  <table class="table dt-responsive">
             <thead class="thead-light">
                <tr role="row">
                    <th style="width: 70px;" >ID</th>
                    <th style="width: 300px;">Name</th>
                    <th style="width: 300px;">Branch</th>
                    <th style="width: 100px;">Price</th>
                    <th style="width: 100px;">Img</th>
                    <th style="width: 200px;">Status</th>
                    <th style="width: 110px;">Action</th>
                </tr>
             </thead>    
             <tbody>       
               @if ($products)     
             @foreach($products as $product)
             <tr role="row">
                   <td>{{$product ->productid  }}</td>
                   <td><strong>{{$product->productname}}</strong></td>
                   <td>{{$product->productbrand}}</td>
                   <td>{{$product->productprice}}</td>
                   <td><img src="{{$product->productimage}}"></td>

                   @php
                                if ($product->productstatus == 1){
                                    echo '<td class="text-success"> Online </td>';
                                } else {
                                    echo '<td class="text-danger"> Offline </td>';
                                }
                            @endphp
                <td>
                <a href="{{url('preorder/export/')}}/{{$id}}/{{$product->productid}}" class="btn btn-info text-light" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Select">
                       <i class="mdi mdi-eye"></i>
                    </a>
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