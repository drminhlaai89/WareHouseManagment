@extends('layout.master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
    <div class="container-fluid">
        <div class="card mb-0">
            <div class="card-header">
                <h2 style="text-align: center">{{ $cus->customername }} Detail Profile</h2>
                <h4 style="color: rgb(68, 219, 212)">{{ $cus->customername }} now is @php
                    if ($cus->customerstatus == 1){
                    echo '<td class="text-success"> Online </td>';
                    } else {
                    echo '<td class="text-danger"> Offline </td>';
                    }
                    @endphp
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Name : </strong>{{ $cus->customername }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Phone : </strong>{{ $cus->customerphone }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Address : </strong>{{ $cus->customeraddress }}</span></strong>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Email : </strong>{{ $cus->customeremail }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Note : </strong>{{ $cus->customernote }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Type : </strong>{{ $cus->customertype }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Created Date : </strong>{{ $cus->customercreateddate }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Modified Date : </strong>{{ $cus->customermodifieddate }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Created By : </strong>{{ $cus->customercreatedby }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Modified By : </strong>{{ $cus->customermodifiedby }}
                                </div>
                            </div>
                        </div>
                        <div style="padding-left:40%">
                            <button type="submit" class="btn btn-success"><a class="text-white"
                                    href="{{ url('customer/update') }}/{{ $cus->customerid }}">Update</a></button>
                            <button type="reset" class="btn btn-info"><a class="text-white"
                                    href="{{ url('customer') }}">Cancel</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    @endsection @push('plugin-scripts') 
    {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!} {!!
        Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!} 
        @endpush @push('custom-scripts') {!!
    Html::script('/assets/js/dashboard.js') !!} 
    @endpush
