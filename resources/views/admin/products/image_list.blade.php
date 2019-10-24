@extends(config('view.ADMIN_LAYOUT'))
@section('title', 'Product Images')

	@section('content_header')
		{{ Breadcrumbs::render('products.image_list', $product) }}
	@stop

		@section('content')
<div class="container">
@include('inc.admin.product_tabs', ['active' => 'images', 'product' => $product])
<div class="panel-primary">
<div class="card">
<div class="card-body">
<div style="float:right;padding-right:20px;">
<a href="{{ route('products.create_image', $product->id ) }}" title="Add New Product Image"><i class="fa fa-plus-circle fa-2x"></i></a>
</div>
<a href="{{ route('products.image_grid', $product->id ) }}" title="Grid View"><i class="fa fa-th fa-2x" style="color: #ccc;"></i></a>
<span style="padding-left:10px;"></span>
<a href="{{ route('products.image_list', $product->id ) }}" title="List View"><i class="fa fa-bars fa-2x"></i></a>
		<div class="card-body">
		@if (count($product->media))
		  <table id="product_images" class="table table-hover table-responsive-sm table-sm">
			<thead>
			<tr>
			  <th>ID</th>
			  <th>Display Order</th>
			  <th>Name</th>
			  <th>Title</th>
			  <th>Alt Text</th>
			  <th>Active</th>
			  <th>Actions</th>
			</tr>
			</thead>
			<tbody>
					@foreach($product->media as $image)
	 			   <tr>
	 				 <td>{{ $image->id }}</td>
	 				 <td>{{ $image->order_column }}</td>
	 				 <td>{{ $image->name }}</td>
	 				 <td>{{ $image->getCustomProperty('title') }}</td>
	 				 <td>{{ $image->getCustomProperty('alt_tag') }}</td>
	 				 <td>@if($image->getCustomProperty('active', false) ) <i class="fa fa-check-square-o fa-lg" style="color:green;"></i> @else <i class="fa fa-square-o fa-lg" style="color:red;"></i> @endif</td>
					 <td>
						<a href="{{ route('products.show', ['id' => $image->id]) }}" title="View Product Image"><i class="fa fa-info-circle fa-2x"></i></a>&nbsp;&nbsp;
						<a href="{{ route('products.edit_image', ['product' => $product->id, 'media_id' => $image->id]) }}" title="Edit Product Image"><i class="fa fa-pencil-square fa-2x"></i></a>
					</td>
	 			   </tr>
					@endforeach
				</tbody>	
			<tfoot>
			<tr>
			  <th>ID</th>
			  <th>Display Order</th>
			  <th>Name</th>
			  <th>Title</th>
			  <th>Alt Text</th>
			  <th>Active</th>
			  <th>Actions</th>
			</tr>
			</tfoot>
		  </table>
      @else
         <center>No Records Found...</center>
      @endif
		</div>
</div>
</div>
</div>
</div>
	@stop

	@section('css')
	@stop

	@section('js')
		<script>
		$('#product_images').DataTable({
		  "paging": true,
		  "lengthChange": false,
		  "searching": true,
		  "ordering": true,
		  "info": true,
		  "autoWidth": false
		});
		</script>
	@stop

@push('css')
@push('js')
