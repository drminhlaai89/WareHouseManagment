@extends('layout.master')

@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')

<div class="card-body">
    <div class="invoice-title">
      <h4 class="float-right font-size-20">Order #{{$import->importorderid}}</h4>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-6">
        <address>
          <strong style="padding-left: 20%">Import Profile</strong><br>
          <strong>Suppiler Name : </strong>{{ $supplier->suppliername }}<br>
          <strong>Suppiler Phone : </strong>{{ $supplier->supplierphone }}<br>
          <strong>Supplier Address : </strong>{{ $supplier->supplieraddress }}<br>
          <strong>Supplier Email : </strong>{{ $supplier->supplieremail }}<br>
          <strong>Note : </strong>{{ $detailimport->detailimportnote }}<br>
        </address>
      </div>
      <div class="col-md-3">
        <address>
          <strong style="padding-left: 20%">Date Time</strong><br>
          <strong>Created Date : </strong>{{ $import->importcreateddate }}<br>
          <strong>Modified Date : </strong>{{ $import->importmodifieddate }}<br>
        </address>
      </div>
      <div class="col-md-3">
        <address>
          <strong style="padding-left: 20%">Staff in charge</strong><br>
          <strong>Created By : </strong>{{ $import->importcreatedby }}<br>
          <strong>Modified By : </strong>{{ $import->importmodifiedby }}<br>
        </address>
      </div>
    </div>
    <div class="py-2 mt-3">
      <h3 class="font-size-15 font-weight-bold">Order summary</h3>
    </div>
    <div class="table-responsive">
      <table class="table mt-4 table-centered">
        <thead class="thead-dark">
          <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Order</th>
            <th>Transaction</th>
            <th >Shipping</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ $product->productname }} </td>
            <td>{{ $detailimport->detailimportquantity }}</td>
            <td>{{ $product->productprice }}</td>
            <td>
                @php
                        if($import->importstatus_order==0){
                            echo('<span class="btn btn-warning">Processing</span>');
                        }else if($import->importstatus_order==1){
                            echo('<span class="btn btn-success">Accept</span>');
                        }else{
                            echo('<span class="btn btn-danger">Cancel</span>');
                        }
                    @endphp
            </td>
            <td>
                @php
                        if($import->importstatus_transaction==0){
                            echo('<span class="btn btn-warning">Processing</span>');
                        }else if($import->importstatus_transaction==1){
                            echo('<span class="btn btn-success">Done</span>');
                        }else{
                            echo('<span class="btn btn-danger">Cancel</span>');
                        }
                    @endphp
            </td>
            <td>
                @php
                        if($import->importstatus_shipping==0){
                            echo('<span class="btn btn-warning">Processing</span>');
                        }else if($import->importstatus_shipping==1){
                            echo('<span class="btn btn-success">Done</span>');
                        }else{
                            echo('<span class="btn btn-danger">Cancel</span>');
                        }
                    @endphp
            </td>
           </tr>
          <tr>
            <td colspan="4" class="border-0 text-right">
              <strong>Total</strong></td>
            <td class="border-0 text-right">
              <h4 class="m-0">{{ $detailimport->detailimportamount }} VNĐ</h4>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="float-right">
        <a href="/import/invoice/{{ $import->importid }}" class="btn btn-info text-light" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View Profile">
          <i class="mdi mdi-printer"></i>Print</a>
          @php
                            if($import->importstatus_order == 1) {
                                echo('<a href="/import/update/'.$import->importid .'" class="btn btn-primary text-light" data-toggle="tooltip" data-placement="bottom" data-original-title="Update Profile">
          <i class="mdi mdi-account-edit"></i>Update</a>');
                            }
                        @endphp
        
      </div>
    </div>
  </div>
    {{-- <div class="row">
        <div class="container">
            <div class="row mb-2 mt-5">
                <div class="col-12">
                <h2 style="text-align: center">Detail Order {{$import->importorderid}}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Supplier Name :
                </div>
                <div class="col-6">
                    {{ $supplier->suppliername }}
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Address :
                </div>
                <div class="col-6">
                    {{ $supplier->supplieraddress }}
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Product :
                </div>
                <div class="col-6">
                    {{ $product->productname }}
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: right">
                   Price
                </div>
                <div class="col-6">
                    {{ $product->productprice }}
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Quantity :
                </div>
                <div class="col-6">
                    {{ $detailimport->detailimportquantity }}
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Amount :
                </div>
                <div class="col-6">
                    {{ $detailimport->detailimportamount }}
                </div>
            </div>
            
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Note :
                </div>
                <div class="col-6">
                    {{ $detailimport->detailimportnote }}
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Status Order :
                </div>
                <div class="col-6">
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
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Status Giao dịch :
                </div>
                <div class="col-6">
                    @php
                        if($import->importstatus_transaction==0){
                            echo('<span class="btn btn-warning">Đang xử lý</span>');
                        }else if($import->importstatus_transaction==1){
                            echo('<span class="btn btn-success">đã duyệt</span>');
                        }else{
                            echo('<span class="btn btn-danger">hủy</span>');
                        }
                    @endphp
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Status Shipping :
                </div>
                <div class="col-6">
                    @php
                        if($import->importstatus_shipping==0){
                            echo('<span class="btn btn-warning">Đang xử lý</span>');
                        }else if($import->importstatus_shipping==1){
                            echo('<span class="btn btn-success">đã duyệt</span>');
                        }else{
                            echo('<span class="btn btn-danger">hủy</span>');
                        }
                    @endphp
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Created Date :
                </div>
                <div class="col-6">
                    {{ $import->importcreateddate }}
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Modifed Date :
                </div>
                <div class="col-6">
                    {{ $import->importmodifieddate }}
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Created By :
                </div>
                <div class="col-6">
                    {{ $import->importcreatedby }}
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Modified By :
                </div>
                <div class="col-6">
                    {{ $import->importmodifiedby }}
                </div>
            </div>
            

            <div class="row mt-4">

                <div class="col-12" style="text-align: center;">
                    <a href="/import/update/{{ $import->importid }}" class="btn btn-warning">Update</a>
                    <a href="/import/invoice/{{ $import->importid }}" class="btn btn-danger">Xuat Invoice</a>
                </div>
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
