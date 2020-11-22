@extends('layout.master');
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
@push('plugin-style')
@endpush
@section('content')

    <div class="card">
       <div class="card-body">
             <a href="catalog/create" class="btn btn-primary">
                <i class="mdi mdi-account-plus-outline"></i>Add new</a> 
                <i class="d-inline-flex mdi mdi-account-search-outline" style="width: 50% ;padding-left:12%">
                    <input type="search" class="form-control form-control-sm" id="search" name ="search"  placeholder="Search...">
                </i>
          <div>
              <br>
            <div class="row">
                <div class="col-sm-12">
                  <table class="table dt-responsive">
             <thead class="thead-light">
                <tr role="row">
                    <th style="width: 70px;" >ID</th>
                    <th style="width: 300px;">Name</th>
                    <th style="width: 100px;">Description</th>
                    <th style="width: 100px;">Image</th>
                    
                    <th style="width: 110px;">Action</th>
                </tr>
             </thead>    
             <tbody id="tbody">       
               @if ($cat)     
             @foreach($cat as $cat)
             <tr role="row">
             <td>{{$cat ->productcatalogid }}</td>
                   <td><strong><a href="/catalog/{{$cat ->productcatalogid}}/product">{{$cat->productcatalogname}}</a></strong></td>
                   <td>{{$cat->productcatalogdescription}}</td>
                   <td><img src="{{$cat->productcatalogimage}}"></td>
                   
                <td>
                    <a href="{{url('catalog/detail')}}/{{$cat->productcatalogid}}" class="btn btn-info text-light" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View Profile">
                       <i class="mdi mdi-eye"></i>
                    </a>
                    <a href="{{url('catalog/update')}}/{{$cat->productcatalogid}}" class="btn btn-primary text-light" data-toggle="tooltip" data-placement="bottom" data-original-title="Update Profile">
                        <i class="mdi mdi-account-edit"></i>
                     </a>
                 </td>
                </tr>
                    @endforeach
                @endif
            </tbody>
         </table>
         </div>
       </div>
     </div>
  </div>
</div>
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                $value = $(this).val();
                $id = $('#id').val();
                $.ajax({
                    type: 'get',
                    url: '{{ URL::to('/catalog/search') }}',
                    data: {
                        'search': $value,
                        'id' : $id
                    },
                    success: function(data) {
                        $('#tbody').html(data);
                    }
                });
            })
            $.ajaxSetup({
                headers: {
                    'csrftoken': '{{ csrf_token() }}'
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




