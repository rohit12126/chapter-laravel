@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="page-title">@lang('global.products.title')</h4>
        </div>
        <div class="panel-body table-responsive" style="position: relative;">
            <div class="row">
                <!-- right column -->
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="box box-warning">
                        <div class="box-header">
                            <h3 class="box-title">Add Product</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <form role="form" method="POST" action="{{ route('admin.products.store') }}" >
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label>Name </label>
                                    <input type="text"  name="name" id='name' class="form-control" placeholder="Enter Name"/ value="{{ old('name') }}">
                                    @if($errors->has('name'))
                                      <p class="help-block" style="color:red;">
                                          {{ $errors->first('name') }}
                                      </p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Price </label>
                                    <input type="number" step="any" min='1' name="price" id='price' class="form-control" placeholder="0.00" value="{{ old('price') }}" />
                                    @if($errors->has('price'))
                                      <p class="help-block" style="color:red;">
                                          {{ $errors->first('price') }}
                                      </p>
                                    @endif
                                </div>
                                <div class="form-group">
                                  <label>Stock</label>
                                  <select id='in_stock' name="in_stock" class="form-control" >
                                      <option value="Out Of Stock">Out Of Stock</option>
                                      <option value="In stock">In stock</option>
                                  </select>
                                  @if($errors->has('in_stock'))
                                      <p class="help-block">
                                          {{ $errors->first('in_stock') }}
                                      </p>
                                  @endif
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                                    <a class="btn btn-danger" href="{{route('admin.products.index')}}"> Cancel</a>
                                </div>
                            </form>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!--/.col (right) -->
           </div>   <!-- /.row -->
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
