@extends('admin.master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">Register</div>
                                <div class="card-body">
    
                                    <form class="form-horizontal" method="POST" action="">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="name" class="cols-sm-2 control-label">Username</label>
                                            <div class="cols-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                                    <input type="text" class="form-control" name="txtUsername" placeholder="Enter your Name" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="cols-sm-2 control-label">Password</label>
                                            <div class="cols-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                                    <input type="text" class="form-control" name="txtPassword" placeholder="********" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="username" class="cols-sm-2 control-label">Full Name</label>
                                            <div class="cols-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                                    <input type="text" class="form-control" name="txtFullname" placeholder="Enter your Full Name" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="cols-sm-2 control-label">Day of birth</label>
                                            <div class="cols-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                    <input type="date" class="form-control" name="txtDob" id="password" placeholder="Enter your Date of birth" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm" class="cols-sm-2 control-label">Address</label>
                                            <div class="cols-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                    <input type="password" class="form-control" name="txtAddress" placeholder="Address" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm" class="cols-sm-2 control-label">Phone</label>
                                            <div class="cols-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                    <input type="password" class="form-control" name="txtPhone" placeholder="0xxxxxxxx" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm" class="cols-sm-2 control-label">Images</label>
                                            <div class="cols-sm-10">
                                                <div class="input-group">
                                                    <input onchange="myFunctiion()" id="image" name="txtImage" width="80" height="80" required class="form-control" />
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            
                                            <div class="cols-sm-10">
                                                <div class="input-group">
                                                    <a id="loadimage"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm" class="cols-sm-2 control-label">Role</label>
                                            <div class="cols-sm-10">
                                                <div class="input-group">
                                                    <select name="txtRole">
                                                        <option value="1">Admin</option>
                                                        <option value="0">Member</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm" class="cols-sm-2 control-label">Note</label>
                                            <div class="cols-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                    <input type="password" class="form-control" name="txtNote" placeholder="Address" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Register</button>
                                        </div>
                                    </form>
                                </div>
    
                            </div>
                        </div>
                    </div>
    </div>
    <script>
        $(document).ready(function(){
          $("input").change(function(){
            $value = $('#image').val();
            if($value != null && $value != ''){
            var row = '<img src="' + $value+ '" alt="Girl in a jacket" width="300" height="300">';
            $('#loadimage').html(row);
            }
            
          });
        });
    </script>

@endsection

@push('plugin-scripts')
    {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
    {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush

@push('custom-scripts')
    {!! Html::script('/assets/js/dashboard.js') !!}
@endpush
