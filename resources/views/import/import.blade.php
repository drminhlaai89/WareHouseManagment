@extends('layout.master')

@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
<form action="" method="POST">
    {{ csrf_field() }}
        <div class=" text-center">
            <h3 style="text-align: center">Supplier Information</h3>
            <div class="col-lg-12">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td>{{ $supplier->supplierid }}</td>
                            <td>{{ $supplier->suppliername }}</td>
                            <td>{{ $supplier->supplieraddress }}</td>
                            <td>{{ $supplier->supplierphone }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <br>
        <div class=" text-center pt-3">
            <h3 style="text-align: center"> Product Information </h3>
            <div class="col-lg-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name Product</th>
                            <th> Image</th>
                            <th>Price</th>
                            <th>Quanlity</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $product->productid }}</td>
                            <td>{{ $product->productname }}</td>
                            <td><a href=" $product->productimage }}"></a></td>
                            <td>{{ $product->productprice }}</td>
                            <td style="width:120px">
                                <input type="number" class="form-control" name="txtQuantity" value="" required></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-8">
                <div class="form-group">
            <label>Note</label>
            <textarea class="form-control" rows="7" name="txtNote" placeholder="Note" value="" ></textarea>
             </div>
            </div>
            <div class="col">
            <div class="col-md-12">
                    <label >Payment Method</label>
            <div>
                <select class="browser-default custom-select">
                        <option >Cash</option>
                        <option >Visa Card</option>
                  </select>
                </div>
            </div>
            <div class="col-md-12">
                    <label>Shipping Method</label>
            <div>
                <select class="browser-default custom-select">
                    <option>Aliexpress</option>
                    <option>UPS</option>
                    <option>DHL</option>
                    <option>USPS</option>
                      </select>
            </div>
            </div>
        </div>
        </div>
                <div class="form-group row mt-3">
                    <div class="col-12" style="text-align: center;">
                        <button type="submit" class="btn btn-success">Create</button>
                        <button type="button" class="btn btn-primary"><a href="/import/create">Cancel</a></button>
                    </div>
                </div>
</form>

@endsection

@push('plugin-scripts')
    {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
    {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush

@push('custom-scripts')
    {!! Html::script('/assets/js/dashboard.js') !!}
@endpush
