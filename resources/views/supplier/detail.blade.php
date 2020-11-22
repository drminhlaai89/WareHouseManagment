@extends('layout.master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
<div class="container-fluid">
    <div class="card mb-0">
        <div class="card-header">
            <h2 style="text-align: center">{{ $sup->suppliername }} Detail Profile</h2>
            <h4 style="color: rgb(68, 219, 212)">{{ $sup->suppliername }} now is @php
                if ($sup->supplierstatus == 1){
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
                                    <strong>Name : </strong>{{ $sup->suppliername }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Phone : </strong>{{ $sup->supplierphone }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Address : </strong>{{ $sup->supplieraddress }}</span></strong>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <strong>Email : </strong>{{ $sup->supplieremail }}
                                </div>
                            </div>
                        </div>
                            <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                            <strong>Note : </strong>{{ $sup->suppliernote }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                        <strong>Description : </strong>{{ $sup->supplierdescription }}
                    </div>
                    </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                            <strong>Created Date : </strong>{{ $sup->suppliercreateddate }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                        <strong>Modified Date : </strong>{{ $sup->suppliermodifieddate }}
                    </div>
                    </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                            <strong>Created By : </strong>{{ $sup->suppliercreatedby }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                        <strong>Modified By : </strong>{{ $sup->suppliermodifiedby }}
                    </div>
                    </div>
                        </div>
                            <div style="padding-left:40%">
                                <button type="submit" class="btn btn-success"><a class="text-white" href="{{url('supplier/update')}}/{{$sup->supplierid}}">Update</a></button>
                                <button type="reset" class="btn btn-info"><a class="text-white" href="{{url('supplier')}}">Cancel</a></button>
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



