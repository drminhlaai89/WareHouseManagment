@extends('admin.master')

@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
<div class="container-fluid">
    <div class="card mb-0">
        <div class="card-header">
            <h4 style="color: rgb(68, 219, 212)">{{ $user->username }} Profile   <span>#</span>{{$user->id}}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    {{-- ID : {{$c->supplierid}}
                    <input class="form-control" name ="txtid" value="{{$c->supplierid}}" type="text" readonly> --}}
                    <form method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>UserName</label>
                                    <input class="form-control" readonly name ="txtUsername" value="{{ $user->username }}" type="text">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name ="txtPassword" value="{{ $user->password }}" type="text">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>FullName</span></label>
                                    <input class="form-control" name ="txtFullname" value="{{ $user->fullname }}" type="text">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>DateOfBirth</span></label>
                                    <input class="form-control" name ="txtDob" value="{{ $user->dob }}"  type="date">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Address</span></label>
                                    <input class="form-control" value="{{ $user->address }}" name ="txtAddress" type="text">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Phone</span></label>
                                    <input class="form-control" value="{{ $user->phone }}" name ="txtPhone"  type="tel">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Role</span></label>
                                    <div class="input-group">
                                        <select name="txtRole">
                                            <option value="1">Admin</option>
                                            <option value="0">Member</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Status</span></label>
                                    <div class="input-group">
                                        <select name="txtStatus">
                                            <option value="1">Online</option>
                                            <option value="0">Offline</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Image</span></label>
                                <input class="form-control" value="{{ $user->image }}" name ="txtImage"  type="tel">
                            </div>
                        </div>
                        </div>
                        <div class="form-group">
                            <label>Note</label>
                            <textarea class="form-control"  rows="3" name ="txtNote" ></textarea>
                        </div>
                        
                        <div style="padding-left:40%">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="reset" class="btn btn-primary">Reset</button>
                        <button type="reset" class="btn btn-info"><a class="text-white" href="{{url('admin')}}">Cancel</a></button>
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
