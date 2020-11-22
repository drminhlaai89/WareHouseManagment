@extends('layout.master')

@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
<div class="container-fluid">
    <div class="card mb-0">
        <div class="card-header">
            <h4 style="color: rgb(68, 219, 212)">{{$product->productname}} Profile   <span>#</span>{{$product->productid}}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" name ="txtName" type="text" value="{{$product->productname}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Brand:</label>
                                    <input class="form-control" name ="txtBrand"  type="text" value="{{$product->productbrand}}">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Price:</span></label>
                                    <input class="form-control" name ="txtPrice" type="text" value="{{$product->productprice}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Description:</span></label>
                                    <input class="form-control" name ="txtdes" value="{{$product->productdescription}} " type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Item Type:</span></label>
                                    <div class="input-group">
                                    <select name="catalog">
                                        @foreach ($cat as $cat)
                                            <option value="{{ $cat->productcatalogid  }}">{{ $cat->productcatalogname }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Images:</span></label>
                                    <input name="txtImage" width="80" height="80" required class="form-control" value="{{$product->productimage}}" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label> Note: </label>
                            <input type="text" name="txtNote" width="80" height="80" class="form-control" value="{{$product->productnote}}"/>
                        </div>
                        <div>
                            <input type="submit" value="Submit" name="btOK" class="btn btn-danger" />
                            <input type="reset" value="Reset" name="btOK" class="btn btn-info" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('plugin-scripts')
    {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
    {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush

@push('custom-scripts')
    {!! Html::script('/assets/js/dashboard.js') !!}
@endpush