@extends('layout.master')

@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
<div class="container-fluid">
    <div class="card mb-0">
        <div class="card-header">
            <h4 style="color: rgb(68, 219, 212)">Update Import Order  <span>#</span>ABC00{{ $import->importid }}</h4>
            <button class="btn btn-primary float-right"><a class="text-white" href="/import/detail/{{ $import->importid }}">Back</a></button>
                <h6 style="color: rgb(68, 219, 212)"><strong>Bill Total :</strong> {{ $detailimport->detailimportamount }}</h6>
                <h4><strong style="color: rgb(68, 219, 212)">Order Status : </strong>@php
                    if($import->importstatus_order==0){
                    echo('<span class="btn btn-warning">Processing</span>');
                    }else if($import->importstatus_order==1){
                    echo('<span class="btn btn-success">Accept</span>');
                    }else{
                    echo('<span class="btn btn-danger">Cancel</span>');
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
                                    <label>Supplier Name</label>
                                    <input class="form-control" name ="txtname" value="{{ $supplier->suppliername }}" type="text" readonly>
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
                                    <input class="form-control" name ="txtaddress" value="{{ $supplier->supplieraddress }}" type="text" readonly>
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
                                    <input class="form-control" name ="txtemail" value="{{ $detailimport->detailimportquantity }}" type="text" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                            <label>Note</label>
                            <textarea class="form-control" rows="3" name ="txtdescription" value="{{ $import->importnote }}" ></textarea>
                             </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label >Status Shipping</label>
                            <div>
                                <h4 type="button" class="btn btn-success btn-lg">Done</h4>
                                
                            </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status Transaction</label>
                            <div>
                                <select class="browser-default custom-select" name="importstatus_transaction">
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
                            if($import->importstatus_order == 1) {
                                echo ('<button type="button" class="btn btn-warning"><a class="text-white" href="/import/update/'.$import->importid.'/cancel-shipping">Cancel Shipping</a></button>');
                                
                            }
                            
                        @endphp
                        @php
                        if($import->importstatus_shipping == 1){
                            echo('<button type="submit" class="btn btn-success">Update Transaction </button>');}
                        @endphp
                        
                        <button type="reset" class="btn btn-primary"><a class="text-white" href="{{url('import')}}">Cancel</a></button>
                        
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
