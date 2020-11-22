@extends('layout.master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush
@section('content')
<div class="container-fluid">
    <div class="card mb-0">
        <div class="card-header">
            <h4 style="color: rgb(68, 219, 212)">New Customer Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <form method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" name="txtname" placeholder="Catalog Name" required>
                                </div>
                            </div>
                            
                        
                        
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Images</label>
                                    <input class="form-control" id="image" name="txtimage" placeholder="Address" required>
                                    <a class="mt-2" id="loadimage"></a>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" rows="3" name ="txtdes"  ></textarea>
                                </div>
                            </div>
                        
                        
                        
                            <div style="padding-left:40%">
                                <button type="submit" class="btn btn-success" name="txtsubmit">Submit</button>
                                <button type="reset" class="btn btn-primary">Reset</button>
                                <button type="reset" class="btn btn-info"><a class="text-white" href="{{url('catalog')}}">Cancel</a></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
      $("#image").change(function(){
        $value = $('#image').val();
        var row = '<img src="' + $value+ '" alt="" width="300" height="300">';
        console.log($value);
        $('#loadimage').html(row);
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
