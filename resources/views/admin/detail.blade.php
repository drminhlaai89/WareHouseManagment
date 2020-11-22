@extends('admin.master')

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
<div class="container">
    <div class=" row justify-content-center">
        <div class="col-9">
            <div class="card">

                <div class="card-body">
                    <div class="card-title mb-4">
                        <div class="d-flex justify-content-start">
                            <div class="image-container">
                            <img src="{{ $user->image }}" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />
                                
                            </div>
                            <div class="userData ml-3">
                            <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a href="javascript:void(0);"> Detail Profile {{ $user->fullname }}</a></h2>
                                <h4 class="d-block" style="color:red">Role :  {{ $user->role == 1 ? 'Admin' : 'Member' }}</h4>
                            </div>
                            <div class="ml-auto">
                                <input type="button" class="btn btn-primary d-none" id="btnDiscard" value="Discard Changes" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Basic Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="connectedServices-tab" data-toggle="tab" href="#connectedServices" role="tab" aria-controls="connectedServices" aria-selected="false">Connected Services</a>
                                </li>
                            </ul>
                            <div class="tab-content ml-1" id="myTabContent">
                                <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                    

                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Username :</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{ $user->fullname }}
                                        </div>
                                    </div>
                                    <hr />

                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Password :</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{ $user->password }}
                                        </div>
                                    </div>
                                    <hr />
                                    
                                    
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Fullname :</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{ $user->fullname }}
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Date of birth :</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{ $user->dob }}
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Address :</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{ $user->address }}
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;"> Phone :</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{ $user->phone }}
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Role :</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{ $user->role == 1 ? 'Admin' : 'Member' }}
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Status :</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{ $user->status == 1 ? 'Đang làm việc' : 'Nghỉ việc' }}
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Note :</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{ $user->note }}
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Created Date :</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{ $user->createddate }}
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Modifed Date :</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{ $user->modifieddate }}
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Created By :</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{ $user->createdby }}
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Modified By :</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{ $user->modifiedby }}
                                        </div>
                                    </div>
                                    <hr/>
                                    
                                    <div class="row mt-4">

                                        <div class="col-12" style="text-align: center;">
                                            <a href="/admin/changepassword/{{ $user->id }}" class="btn btn-warning">Change Password</a>
                                            <a href="/admin/resetpassword/{{ $user->id }}" class="btn btn-danger">Reset Password</a>
                                        </div>
                                    </div>
                                
                                </div>
                                <div class="tab-pane fade" id="connectedServices" role="tabpanel" aria-labelledby="ConnectedServices-tab">
                                    Facebook, Google, Twitter Account that are connected to this account
                                </div>
                            </div>
                        </div>
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
