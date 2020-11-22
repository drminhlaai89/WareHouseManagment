@extends('admin.master')

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
                                <label for="name" class="cols-sm-2 control-label">New Password :</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user fa"
                                                aria-hidden="true"></i></span>
                                        <input type="password" class="form-control" name="password" required
                                            placeholder="Enter your new Password" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="" style="text-align: center;">
                                    <button type="submit" class="btn btn-lg btn-success">Update</button>
                                    <button type="reset" class="btn btn-lg btn-primary">Reset</button>
                                </div>
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
