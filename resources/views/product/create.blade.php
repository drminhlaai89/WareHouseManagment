@extends('layout.master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">Create Product</div>
                                <div class="card-body">
    
                                    <form class="form-horizontal" method="POST" action="">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="name" class="cols-sm-2 control-label">Name</label>
                                            <div class="cols-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                                    <input type="text" class="form-control" name="txtName" placeholder="Enter Name" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="cols-sm-2 control-label">Brand</label>
                                            <div class="cols-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                                    <input type="text" class="form-control" name="txtBrand" placeholder="Brand" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="username" class="cols-sm-2 control-label">Price</label>
                                            <div class="cols-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                                    <input type="text" class="form-control" name="txtPrice" placeholder="Price" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="cols-sm-2 control-label">Description</label>
                                            <div class="cols-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                    <input type="text" class="form-control" name="txtdes" id="password" placeholder="Description" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm" class="cols-sm-2 control-label">Images</label>
                                            <div class="cols-sm-10">
                                                <div class="input-group">
                                                    <input onchange="myFunctiion()" id="image" name="txtImage" width="80" placeholder="Images" height="80" required class="form-control" />
                                                    <a id="loadimage"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm" class="cols-sm-2 control-label">Item Type</label>
                                            <div class="cols-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                    <select name="catalog">
                                                        @foreach ($cat as $cat)
                                                            <option value="{{ $cat->productcatalogid  }}">{{ $cat->productcatalogname }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm" class="cols-sm-2 control-label">Note</label>
                                            <div class="cols-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                    <input type="text" name="txtNote" width="80" placeholder="Note" height="80" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <input type="submit" value="Submit" name="btOK" class="btn btn-danger" />
                                            <input type="reset" value="Reset" name="btOK" class="btn btn-info" />
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