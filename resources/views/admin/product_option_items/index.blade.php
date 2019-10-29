@extends(config('view.ADMIN_LAYOUT'))
@section('title', 'product_option_items')

@section('content_header')
   {{ Breadcrumbs::render('products.product_option_items', $product, $product_option) }}
@stop

@section('content')
	<div class="container">
		<div class="card">
		<div class="card-body" style="background-color:white;">
	@can('create_product_option_items')
		<a href="#" title="Grid View"><i class="fa fa-th fa-2x" style="color: #ccc;"></i></a>
		<span style="padding-left:10px;"></span>
		<a href="#" title="List View"><i class="fa fa-bars fa-2x"></i></a>
		<div style="float:right;padding-right:20px;"><a href="{{ route('product_options.create_product_option_item', $product_option->id) }}" title="Add new product option item"><i class="fa fa-plus-circle fa-2x"></i></a></div><br /><br />
	@endcan
			@if (count($product_option->product_option_item))
		<table id="product_option_items" class="table table-hover table-responsive-sm table-sm">
			<thead>
				<tr>
					<th>ID</th>
					<th>Display Order</th>
					<th>Slug</th>
					<th>Name</th>
					<th>Active</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($product_option->product_option_item as $option_item)
				<tr>
					<td>{{ $option_item->id }}</td>
					<td>{{ $option_item->display_order }}</td>
					<td>{{ $option_item->slug }}</td>
					<td>{{ $option_item->name }}</td>
					<td>@if($option_item->active ) <i class="fa fa-check-square-o fa-lg" style="color:green;"></i> @else <i class="fa fa-square-o fa-lg" style="color:red;"></i> @endif</td>
					<td>
					@can('edit_product_option_items')
					<a href="{{ route('product_options.edit_product_option_item', ['product_option' => $product_option->id,  'product_option_item' => $option_item->id]) }}" title="Edit Product Option Item Details"><i class="fa fa-pencil-square fa-2x"></i></a>&nbsp;&nbsp;
					@endcan
					@can('edit_product_option_item_images')
					<a href="{{ route('product_option_items.edit', ['product_option' => $product_option->id]) }}" title="Edit Product Option Images"><i class="fa fa-file-image-o fa-2x"></i></a>&nbsp;&nbsp;
					@endcan
					@can('delete_product_option_items')
						<form method="post" id="F1" name="F1" action="{{ route('product_option_items.destroy', ['product_option' => $product_option->id]) }}" style="display:inline;">@csrf @method('DELETE')<a onclick="if(confirm('Really delete this product option?')) { this.parentNode.submit(); }" title="Delete this Product Option"><i class="fa fa-trash fa-2x" style="color:red;"></i></a></form>
					@endcan
				</td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>ID</th>
					<th>Display Order</th>
					<th>Slug</th>
					<th>Name</th>
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
		@stop

		@section('css')
		@stop

		@section('js')
		<script>
		$('#product_option_items').DataTable({
		  "paging": true,
		  "lengthChange": true,
		  "searching": true,
		  "ordering": true,
		  "info": true,
		  "autoWidth": false,
		  "order": [[ 1, "asc" ]],
		  'columnDefs' : [{
		  		'targets' : [-1],
				'orderable' : false
			}]
		});
		</script>
		@stop

@push('css')
@push('js')
