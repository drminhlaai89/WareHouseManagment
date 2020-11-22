@extends('layout.master')

@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
<div class="container-fluid">
    <div class="card mb-0">
        <div class="card-header">
            <h4 style="color: rgb(68, 219, 212)">Update Export Order  <span>#</span>ABC00{{ $export->exportid }}</h4>
            <button class="btn btn-primary float-right"><a class="text-white" href="/export/detail/{{ $export->exportid }}">Back</a></button>
                <h6 style="color: rgb(68, 219, 212)"><strong>Bill Total :</strong> {{ $detailexport->detailexportamount }}</h6>
                <h4><strong style="color: rgb(68, 219, 212)">Order Status : </strong>@php
                    if($export->exportstatus_order==0){
                    echo('<span class="btn btn-warning">Đang xử lý</span>');
                    }else if($export->exportstatus_order==1){
                    echo('<span class="btn btn-success">đã duyệt</span>');
                    }else{
                    echo('<span class="btn btn-danger">hủy</span>');
                    }
                    @endphp</h4>
            </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                     <form method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <input class="form-control" name ="txtname" value="{{ $customer->customername }}" type="text" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Product</label>
                                    <input class="form-control" name ="txtphone" value="{{ $product->productname }}" type="text" readonly>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Address</span></label>
                                    <input class="form-control" name ="txtaddress" value="{{ $customer->customeraddress }}" type="text" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Price</span></label>
                                    <input class="form-control" name ="txtprice" value="{{ $product->productprice }}" type="text" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Quantity</span></label>
                                    <input class="form-control" name ="txtemail" value="{{ $detailexport->detailexportquantity }}" type="text" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                            <label>Note</label>
                            <textarea class="form-control" rows="3" name ="txtdescription" value="{{ $export->exportnote }}" ></textarea>
                             </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label >Status Transaction</label>
                            <div>
                                @php
                                    if($export->exportstatus_transaction==0){
                                        echo('<h4 type="button" class="btn btn-warning btn-lg">Processing</h4>');
                                    }else if($export->exportstatus_transaction==1){
                                        echo('<h4 type="button" class="btn btn-success btn-lg">Done</h4>');
                                    }else{
                                        echo('<h4 type="button" class="btn btn-danger btn-lg">Cancel</h4>');
                                    }
                                @endphp
                            </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status Shipping</label>
                            <div>
                                <select class="browser-default custom-select" name="exportstatus_shipping">
                                        <option value="0" class="text-warning">Processing</option>
                                        <option value="1" class="text-success">Done</option>
                                        <option value="2" class="text-danger">Cancel</option>
                                      </select>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div style="padding-left:40%">
                            @php
                            if($export->exportstatus_order == 1) {
                                echo('<button type="submit" class="btn btn-success">Update Shipping</button>');
                            }
                        @endphp
                        @php
                        if($export->exportstatus_shipping == 1){
                            echo ('<button type="button" class="btn btn-info"><a class="text-white" href="/export/update/'.$export->exportid.'/update-transaction">Update Transaction</a></button>');
                        }
                        @endphp
                        <button type="reset" class="btn btn-info"><a class="text-white" href="{{url('export')}}">Cancel</a></button>
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

