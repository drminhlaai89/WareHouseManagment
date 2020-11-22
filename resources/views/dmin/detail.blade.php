@extends('admin.master')

@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
    <div class="row">
        <div class="container">
            <div class="row mb-2 mt-5">
                <div class="col-12">
                    <h2 style="text-align: center">Your Account Information : </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Username :
                </div>
                <div class="col-6">
                    {{ $user->username }}
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Password :
                </div>
                <div class="col-6">
                    {{ $user->password }}
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Fullname :
                </div>
                <div class="col-6">
                    {{ $user->fullname }}
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Date of birth :
                </div>
                <div class="col-6">
                    {{ $user->dob }}
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Address :
                </div>
                <div class="col-6">
                    {{ $user->address }}
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Phone :
                </div>
                <div class="col-6">
                    {{ $user->phone }}
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Role :
                </div>
                <div class="col-6">
                    {{ $user->role == 1 ? 'Admin' : 'Member' }}
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Status :
                </div>
                <div class="col-6">
                    {{ $user->status == 1 ? 'Đang làm việc' : 'Nghỉ việc' }}
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Note :
                </div>
                <div class="col-6">
                    {{ $user->note }}
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Created Date :
                </div>
                <div class="col-6">
                    {{ $user->createddate }}
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Modifed Date :
                </div>
                <div class="col-6">
                    {{ $user->modifieddate }}
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Created By :
                </div>
                <div class="col-6">
                    {{ $user->createdby }}
                </div>
            </div>
            <div class="row">
                <div class="col-6" style="text-align: right">
                    Modified By :
                </div>
                <div class="col-6">
                    {{ $user->modifiedby }}
                </div>
            </div>
            

            <div class="row mt-4">

                <div class="col-12" style="text-align: center;">
                    <a href="/admin/changepassword/{{ $user->id }}" class="btn btn-warning">Change Password</a>
                    <a href="/admin/resetpassword/{{ $user->id }}" class="btn btn-danger">Reset Password</a>
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
