@extends('layout.master')

@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')

<div class="row">
  <div class="col-lg-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Orders</h4>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th> # </th>
                <th> ID </th>
                <th> Supplier Name </th>
                <th> Status </th>
                <th> Amount(VNĐ) </th>
                <th> Created Date </th>
              </tr>
            </thead>
            <tbody>
            @foreach($importdashboards as $importdashboard)
            <tr>
              <td class="font-weight-medium"> {{ $importdashboard->importid}} </td>
              <td>{{ $importdashboard->importorderid}}</td>
              <td>{{ $importdashboard->suppliername}}</td>
              <td> @php
                      if($importdashboard->importstatus_order==0){
                      echo('<span class="btn btn-warning">Pending</span>');
                      }else if($importdashboard->importstatus_order==1){
                      echo('<span class="btn btn-success">Success</span>');
                      }else{
                      echo('<span class="btn btn-danger"> Cancel </span>');
                      }
                    @endphp</td>
              <td>{{ $importdashboard->detailimportamount}}</td>
              <td>{{ $importdashboard->importcreateddate}}</td>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Sales</h4>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th> # </th>
                <th> ID</th>
                <th> Customer Name </th>
                <th> Status </th>
                <th> Amount(VNĐ) </th>
                <th> Created Date </th>
              </tr>
            </thead>
            <tbody>
            @foreach($exportdashboards as $exportdashboard)
            <tr>
              <td class="font-weight-medium"> {{ $exportdashboard->exportid}} </td>
              <td>{{ $exportdashboard->exportorderid}}</td>
              <td>{{ $exportdashboard->customername}}</td>
              <td> @php
                      if($exportdashboard->exportstatus_order==0){
                      echo('<span class="btn btn-warning">Pending</span>');
                      }else if($exportdashboard->exportstatus_order==1){
                      echo('<span class="btn btn-success">Success</span>');
                      }else{
                      echo('<span class="btn btn-danger">Cancel</span>');
                      }
                    @endphp</td>
              <td>{{ $exportdashboard->detailexportamount}}</td>
              <td>{{ $exportdashboard->exportcreateddate}}</td>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body py-5">
        <div class="d-flex flex-row justify-content-center align-items">
          <i class="mdi mdi-facebook text-facebook icon-lg"></i>
          <div class="ml-3">
            <h6 class="text-facebook font-weight-semibold mb-0">2.62 Subscribers</h6>
            <p class="text-muted card-text">You main list growing</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body py-5">
        <div class="d-flex flex-row justify-content-center align-items">
          <i class="mdi mdi-google-plus text-google icon-lg"></i>
          <div class="ml-3">
            <h6 class="text-google font-weight-semibold mb-0">3.4k Followers</h6>
            <p class="text-muted card-text">You main list growing</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body py-5">
        <div class="d-flex flex-row justify-content-center align-items">
          <i class="mdi mdi-twitter text-twitter icon-lg"></i>
          <div class="ml-3">
            <h6 class="text-twitter font-weight-semibold mb-0">3k followers</h6>
            <p class="text-muted card-text">You main list growing</p>
          </div>
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