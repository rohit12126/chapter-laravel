@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="page-title">
                <span style="font-size: initial;" >@lang('global.products.title')</span>
                <a style="margin:10px;" href="{{route('admin.products.create')}}" class="btn btn-primary ">Add Product</a>
            </div>
        </div>
        <div class="panel-body table-responsive" style="position: relative;">
              <label class="pull-right status_filter " > Status: <select id="statusFilter" >
                <option value="">Both</option>
                <option value="In stock">In stock</option>
                <option value="Out Of Stock">Out Of Stock</option>
               </select></label>  
            <table id="product_data" class="table table-bordered table-striped  ">
                <thead>
                    <tr>
                        <th>@lang('global.products.fields.sno')</th>
                        <th>@lang('global.products.fields.name')</th>
                        <th>@lang('global.products.fields.price')</th>
                        <th>@lang('global.products.fields.in_stock')</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
var dtList = $('#product_data').DataTable({
    processing: true,
    serverSide: true,
    ajax:{url: '{{ route('getProductsData') }}',
          type: "GET",
          data: function (d) {
              d.filter_value = $('#statusFilter').val();
            }
          } ,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex',"searchable": false,"orderable":false},
        {data: 'name', name: 'name'},
        {data: 'price', name: 'price'},
        {data: 'in_stock', name: 'in_stock'},
    ]
});
$('#statusFilter').on('change', function(){
  $('#product_data').DataTable().draw(true);
});

</script>
@endsection
