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
                    echo('<span class="btn btn-success">Accpet</span>');
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
                                    <label >Status Transaction</label>
                            <div>
                                <select class="browser-default custom-select" name="importstatus_transaction">
                                    <option value="0" class="text-warning">Processing</option>
                                    <option value="1" class="text-success">Done</option>
                                    <option value="2" class="text-danger">Cancel</option>
                                  </select>
                            </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status Shipping</label>
                            <div>
                                <select class="browser-default custom-select" name="importstatus_shipping">
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
                                echo('<button type="submit" class="btn btn-success">Update</button>');
                            }
                        @endphp
                        <button type="reset" class="btn btn-info"><a class="text-white" href="{{url('import')}}">Cancel</a></button>
                        </div>
                    </form>
                            
                </div>
            </div>
        </div>
    </div>
</div>

                        {{-- <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">OrderID</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="txtUsername" readonly
                                    value="ABC00{{ $import->importid }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Supplier Name :</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="txtPassword" readonly
                                    value="{{ $supplier->suppliername }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" readonly name="txtFullname" placeholder="Full Name"
                                    value="{{ $supplier->supplieraddress }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Product </label>
                            <div class="col-sm-5">
                                <input type="date" class="form-control" readonly name="txtDob"
                                    value="{{ $product->productname }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" readonly name="txtAddress"
                                    value="{{ $product->productprice }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Quantity </label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control" readonly name="txtPhone"
                                    value="{{ $detailimport->detailimportquantity }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Amount </label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control" readonly name="txtPhone"
                                    value="{{ $detailimport->detailimportamount }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Amount </label>
                            <div class="col-sm-5">
                                @php
                                if($import->importstatus_order==0){
                                echo('<span class="btn btn-warning">Đang xử lý</span>');
                                }else if($import->importstatus_order==1){
                                echo('<span class="btn btn-success">đã duyệt</span>');
                                }else{
                                echo('<span class="btn btn-danger">hủy</span>');
                                }
                                @endphp
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Status Order</label>
                            <div class="col-sm-4 mt-1">
                                <select name="importstatus_order">
                                    <option value="0">Đang Xử Lý</option>
                                    <option value="1">Đã duyệt</option>
                                    <option value="1">Hủy</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Status Transaction</label>
                            <div class="col-sm-4 mt-1">
                                <select name="importstatus_transaction">
                                    <option value="0">Đang Xử Lý</option>
                                    <option value="1">Đã Hoàn Thành</option>
                                    <option value="2">Hủy</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Status Shipping</label>
                            <div class="col-sm-4 mt-1">
                                <select name="importstatus_shipping">
                                    <option value="0">Đang Xử Lý</option>
                                    <option value="1">Đã Hoàn Thành</option>
                                    <option value="2">Hủy</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Note </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="txtNote" value="{{ $import->importnote }}">
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-8" style="text-align: center;">
                                <button type="submit" class="btn btn-success">Update Account</button>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div> --}}

@endsection

@push('plugin-scripts')
    {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
    {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush

@push('custom-scripts')
    {!! Html::script('/assets/js/dashboard.js') !!}
@endpush
