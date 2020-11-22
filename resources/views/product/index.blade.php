@extends('layout.master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush


@section('content')
    <div class="container">
        <div class="card-body">
            <a href="product/create" class="btn btn-primary">
               <i class="mdi mdi-account-plus-outline"></i>Add new</a> 
               <i class="d-inline-flex mdi mdi-account-search-outline" style="width: 50% ;padding-left:12%">
                   <input type="search" class="form-control form-control-sm" id="search" name ="search"  placeholder="Search...">
               </i>

                <!-- Collapse buttons -->
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-format-align-justify"></i>Categories</button>
              <!-- Collapsible element -->
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">@foreach ($catalogs as $catalog)
                <div class="col">
                        <a href="/catalog/{{$catalog->productcatalogid}}/product"> {{$catalog->productcatalogname}}</a>
                </div>
               @endforeach
              
            </div>
        <div class="col-lg-11 mt-5">
            <div class="row" id="tbody">
                @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <a href="/product/detail/{{$product->productid}}">
                                <img class="card-img-top" src="{{ $product->productimage }}" alt="">
                            </a>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="/product/detail/{{$product->productid}}">{{ $product->productname }}</a>
                                    </h4>
                                    <h5>{{ $product->productprice }}</h5>
                                    <p class="card-text">{{ $product->productdescription }}</p>
                                </div>
                                
                        </div>
                    </div>
                @endforeach
                
            </div>
            {{$products->links("pagination::bootstrap-4")}}
        </div>
        <div>
         
    </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                $value = $(this).val();
                $.ajax({
                    type: 'get',
                    url: '{{ URL::to('/product/search') }}',
                    data: {
                        'search': $value,
                    },
                    success: function(data) {
                        $('#tbody').html(data);
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
