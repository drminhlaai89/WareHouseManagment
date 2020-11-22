@extends('layout.master')

@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
<div class="container">
    <a href="/product" class="btn btn-primary" class="text-white"><i class="mdi mdi-chevron-double-left"></i>Back</a>
    <a href="/product/create" class="btn btn-primary">
        <i class="mdi mdi-account-plus-outline"></i>Add new</a> 
        <i class="d-inline-flex mdi mdi-account-search-outline" style="width: 50% ;padding-left:12%">
            <input type="search" class="form-control form-control-sm" id="search" name ="search"  placeholder="Search...">
        </i>
        <br><br>
    <h2 style="text-align: center; color: rgb(84, 123, 199)">Product List</h2>
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
                        <div class="card-footer">
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                        </div>
                </div>
            </div>
        @endforeach
        
    </div>
    {{ $products->links() }}
    
@endsection
@push('plugin-scripts')
    {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
    {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush

@push('custom-scripts')
    {!! Html::script('/assets/js/dashboard.js') !!}
@endpush
