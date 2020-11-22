@extends('layout.master')

@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
<div class="card-body">
    <div class="invoice-title ml-5">
      <h4 class="float-right font-size-20">Order #{{$export->exportid}}</h4>
      
    </div>
    <hr>
    <div class="row">
      <div class="col-md-6">
        <address>
          <strong style="padding-left: 20%">Billed To</strong><br>
          <strong>Name : </strong>{{ $customer->customername }}<br>
          <strong>Address : </strong>{{ $customer->customeraddress }}<br>
          <strong>Phone : </strong>{{ $customer->customerphone }}<br>
          <strong>Email : </strong>{{ $customer->customeremail }}<br>
          <strong>Note : </strong>{{ $detailexport->detailexportnote }}
        </address>
      </div>
      <div class="col-md-3">
        <address>
          <strong style="padding-left: 20%">Date Time</strong><br>
          <strong>Created Date : </strong>{{ $export->exportcreateddate }}<br>
          <strong>Modified Date : </strong>{{ $export->exportmodifieddate }}<br>
        </address>
      </div>
      <div class="col-md-3">
        <address>
          <strong style="padding-left: 20%">Staff in charge</strong><br>
          <strong>Created By : </strong>{{ $export->exportcreatedby }}<br>
          <strong>Modified By : </strong>{{ $export->exportmodifiedby }}<br>
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
            <td>{{ $detailexport->detailexportquantity }}</td>
            <td>{{ $product->productprice }}</td>
            <td>
              @php
                      if($export->exportstatus_order==0){
                          echo('<span class="btn btn-warning">Processing</span>');
                      }else if($export->exportstatus_order==1){
                          echo('<span class="btn btn-success">Accept</span>');
                      }else{
                          echo('<span class="btn btn-danger">Cancel</span>');
                      }
                  @endphp
          </td>
            <td>
                @php
                if($export->exportstatus_transaction==0){
                    echo('<span class="btn btn-warning">Processing</span>');
                }else if($export->exportstatus_transaction==1){
                    echo('<span class="btn btn-success">Done</span>');
                }else{
                    echo('<span class="btn btn-danger">Cancel</span>');
                }
                @endphp
            </td>
            <td>
                @php
                  if($export->exportstatus_shipping==0){
                   echo('<span class="btn btn-warning">Processing</span>');
                  }else if($export->exportstatus_shipping==1){
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
              <h4 class="m-0">{{ $detailexport->detailexportamount}} VNĐ</h4>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="float-right">
        <a href="/export/invoice/{{ $export->exportid }}" class="btn btn-info text-light" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View Profile">
          <i class="mdi mdi-printer"></i>Print</a>
          @php
          if($export->exportstatus_order == 1) {
              echo('<a href="/export/update/'.$export->exportid .'" class="btn btn-primary text-light" data-toggle="tooltip" data-placement="bottom" data-original-title="Update Profile">
<i class="mdi mdi-account-edit"></i>Update</a>');
          }
      @endphp
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