@extends('admin.master')

@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
    <div class="row">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <h2 style="text-align: center">Create Account</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="txtUsername" placeholder="Username" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-5">
                                <input type="password" class="form-control" name="txtPassword" placeholder="********"
                                    value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Full Name</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="txtFullname" placeholder="Full Name" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Day of birth</label>
                            <div class="col-sm-5">
                                <input type="date" class="form-control" name="txtDob" placeholder="Full Name" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="txtAddress" placeholder="Address" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control" name="txtPhone" placeholder="0xxxxxxxx" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-4 mt-1">
                                <select name="txtRole">
                                    <option value="1">Admin</option>
                                    <option value="0">Member</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Note</label>
                            <div class="col-sm-5">
                                <input type="textarea" class="form-control" name="txtNote" placeholder="Note" value="">
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-8" style="text-align: center;">
                                <button type="submit" class="btn btn-success">Tạo Account</button>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
{{-- @section('content')
    <div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one"
        style="background-image: url({{ url('assets/images/auth/register.jpg') }}); background-size: cover;">
        <div class="row w-100">
            <div class="col-lg-6 mx-auto">
                <h2 class="text-center mb-4">Register</h2>
                <div class="auto-form-wrapper">
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="txtName" placeholder="Username">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-check-circle-outline"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="password" class="form-control" name="txtPassword" placeholder="Password">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-check-circle-outline"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="txtFullname" placeholder="FullName">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-check-circle-outline"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="date" class="form-control" name="txtDob" placeholder="Dob">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-check-circle-outline"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="txtAddress" placeholder="Address">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-check-circle-outline"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="password" class="form-control" name="txtPassword" placeholder="Password">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-check-circle-outline"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="txtPhone" placeholder="Phone">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-check-circle-outline"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-4 mt-1">
                                    <select name="txtRole" class="form-control">
                                        <option value="1">Admin</option>
                                        <option value="0">Member</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="textarea" class="form-control" name="txtNote" placeholder="Note">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-check-circle-outline"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <div class="form-check form-check-flat mt-0">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" checked> I agree to the terms </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary submit-btn btn-block">Register</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
@push('plugin-scripts')
    {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
    {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush

@push('custom-scripts')
    {!! Html::script('/assets/js/dashboard.js') !!}
@endpush
