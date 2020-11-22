@extends('layout.master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
    <div class="container-fluid">
        <div class="card mb-0">
            <div class="card-header">
                <h2 style="text-align: center">Detail Return Order {{ $import->importorderid }}</h2>
                
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="col-lg-12">
                        <form method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <strong>Name : </strong>{{ $import->suppliername }}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <strong>Phone : </strong>{{ $import->supplierphone }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <strong>Address : </strong>{{ $import->supplieraddress }}</span></strong>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <strong>Email : </strong>{{ $import->supplieremail }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <strong>Note : </strong>{{ $import->supplierdescription }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <strong>Product name : </strong>{{ $product->productname }}</span></strong>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <strong>Price : </strong>{{ $product->productprice }}
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <strong>Quanlity : <input type="number" name="quantity" required value="{{ $detailimport->detailimportquantity}}">
                                            </strong>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Note</label>
                                        <textarea class="form-control" rows="3" name ="note" value="{{$detailimport->detailimportnote}}" ></textarea>
                                    </div>
                                    </div>
                                    <div style="padding-left:40%">
                                    <button type="submit" class="btn btn-success">Create</button>
                                    <button type="reset" class="btn btn-primary">Reset</button>
                                    <button type="reset" class="btn btn-info"><a class="text-white" href="{{url('/return/import')}}">Cancel</a></button>
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
{!!
        Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!} 
        @endpush @push('custom-scripts') {!!
    Html::script('/assets/js/dashboard.js') !!} 
    @endpush
