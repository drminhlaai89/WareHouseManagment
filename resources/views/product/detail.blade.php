@extends('layout.master')

@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush


@section('content')
<div class="container">

    <!-- Portfolio Item Heading -->
    <h2 style="text-align: center; color: red" class="my-4">{{$product->productname}}
      
    </h2>
    
  
    <!-- Portfolio Item Row -->
    <div class="row mt-5">
  
        <div class="col-md-7">
            <img class="img-fluid" src="{{ $product->productimage }}" height="750" width="600" alt="">
        </div>
    
  
      
    
        <div class="col-md-5">
            <table class="table">
                
                <tr>
                    <th>Catalog</th>
                    <td>{{ $product->productcatalogname }}</td>
                </tr>
                <tr>
                    <th>Brand</th>
                    <td>{{ $product->productbrand }}</td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td>{{ $product->productprice }}</td>
                </tr>
                <tr>
                    <th>Descriptopn</th>
                    <td>{{ $product->productdescription }}</td>
                </tr>
                <tr>
                    <th>Note</th>
                    <td>{{ $product->productnote }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    @php
                                if ($product->productstatus == 1){
                                    echo '<td class="text-success"> Online </td>';
                                } else {
                                    echo '<td class="text-danger"> Offline </td>';
                                }
                            @endphp
                </tr>
                <tr>
                    <th>Created date</th>
                    <td>{{ $product->productcreateddate }}</td>
                </tr>
                <tr>
                    <th>Modifided Date</th>
                    <td>{{ $product->productmodifieddate }}</td>
                </tr>
                <tr>
                    <th>Created By</th>
                    <td>{{ $product->productcreatedby }}</td>
                </tr>
                <tr>
                    <th>Modified By</th>
                    <td>{{ $product->productmodifiedby }}</td>
                </tr>
                <tr>
                    
                    <td>
                        <div style="padding-left:40%" class="mt-2">
                            <button type="submit" class="btn btn-success"><a class="text-white" href="{{url('product/update')}}/{{$product->productid}}">Update</a></button>
                            <button type="reset" class="btn btn-info"><a class="text-white" href="{{url('product')}}">Cancel</a></button>
                        </div>
                     </td>
                </tr>
              
            </table>
      </div>
  
    </div>
</div>
    <!-- /.row -->
  
    <!-- Related Projects Row -->
    
    <!-- /.row -->
  
  
  <!-- /.container -->

@endsection
@push('plugin-scripts')
{!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
{!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush

@push('custom-scripts')
{!! Html::script('/assets/js/dashboard.js') !!}
@endpush
