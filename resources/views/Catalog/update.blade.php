@extends('layout.master')

@push('plugin-styles')
@endpush

@section('content')
<div class="container-fluid">
    <div class="card mb-0">
        <div class="card-header">
            <h4 style="color: rgb(68, 219, 212)">{{$cat->productcatalogname}} Profile   <span>#</span>{{$cat->productcatalogid }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    {{-- ID : {{$c->supplierid}}
                    <input class="form-control" name ="txtid" value="{{$c->supplierid}}" type="text" readonly> --}}
                    <form method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" name ="txtname" value="{{$cat->productcatalogname}}" type="text">
                                </div>
                            </div>
                            
                        
                        
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Image</span></label>
                                    <input class="form-control" name ="txtimage" value="{{$cat->productcatalogimage}}" type="text">
                                </div>
                            </div>
                            <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="3" name ="txtdes" value="{{$cat->productcatalogdescription}}" ></textarea>
                            </div>
                            </div>
                            
                        
                        
                        <div style="padding-left:40%">
                            <button type="submit" class="btn btn-success">Update</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                            <button type="reset" class="btn btn-info"><a class="text-white" href="{{url('supplier')}}">Cancel</a></button>
                        </div>
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