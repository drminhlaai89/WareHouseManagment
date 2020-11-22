@extends('admin.master')

@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header" style="text-align: center">Cập Nhập Tồn Kho</div>
                    <div class="card-body">

                        <form class="form-horizontal" method="POST" action="">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Tên Sản Phẩm</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user fa"
                                                aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" readonly
                                            value="{{ $inventory->productname }}" name="txtUsername"
                                            placeholder="Enter your Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="cols-sm-2 control-label">Số Lượng Tồn Kho</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock fa-lg"
                                                aria-hidden="true"></i></span>
                                        <input type="number" class="form-control" required name="txtinstock"
                                            placeholder="Số Lượng Tồn Kho" value="{{ $inventory->inventoryinstock }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="confirm" class="cols-sm-2 control-label">Số Lượng Đang Nhập</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock fa-lg"
                                                aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" 
                                            value="{{ $inventory->inventoryquanlity_of_import }}" name="txtimport"
                                            placeholder="Số Lượng Đang Nhập" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="confirm" class="cols-sm-2 control-label">Số Lượng Đang Xuất</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock fa-lg"
                                                aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="txtexport"
                                            placeholder="Số Lượng Đang Xuất" 
                                            value="{{ $inventory->inventoryquanlity_of_export }}" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-lg btn-block login-button">Update</button>
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
