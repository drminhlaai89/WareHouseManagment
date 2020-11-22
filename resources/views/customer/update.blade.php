@extends('layout.master')

@push('plugin-styles')
@endpush

@section('content')
<div class="container-fluid">
    <div class="card mb-0">
        <div class="card-header">
            <h4 style="color: rgb(68, 219, 212)">{{$c->customername}} Profile   <span>#</span>{{$c->customerid}}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    {{-- ID : {{$c->customerid}}
                    <input class="form-control" name ="txtid" value="{{$c->customerid}}" type="text" readonly> --}}
                    <form method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" name ="txtname" value="{{$c->customername}}" type="text">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Phone No</label>
                                    <input class="form-control" name ="txtphone" value="{{$c->customerphone}}" type="text">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Address</span></label>
                                    <input class="form-control" name ="txtaddress" value="{{$c->customeraddress}}" type="text">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Email</span></label>
                                    <input class="form-control" name ="txtemail" value="{{$c->customeremail}}" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Note</label>
                                    <textarea type="text" class="form-control" rows="3" name ="txtnote" value="{{$c->customeremail}}" ></textarea>
                                </div>
                            </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Type</label>
                                        <textarea type="text" class="form-control" rows="3" name ="txttype" value="{{$c->customertype}}" ></textarea>
                                    </div>
                                </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                <label>Status</label>
                                <textarea class="form-control" rows="3" name="txtstatus" value="{{$c->customerstatus}}"></textarea>
                                </div>
                            </div>
                            </div>
                        <div style="padding-left:40%">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="reset" class="btn btn-primary">Reset</button>
                        <button type="reset" class="btn btn-info"><a class="text-white" href="{{url('customer')}}">Cancel</a></button>
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