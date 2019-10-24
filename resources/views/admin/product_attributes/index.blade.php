@extends(config('view.ADMIN_LAYOUT'))
@section('title', 'product_categories')

@section('content_header')
   {{ Breadcrumbs::render('product_categories.index') }}
@stop

@section('content')
	<div class="container">
		<div class="card">
		<div class="card-body" style="background-color:white;">
	@can('create_product_categories')
		<a href="#" title="Grid View"><i class="fa fa-th fa-2x" style="color: #ccc;"></i></a>
		<span style="padding-left:10px;"></span>
		<a href="#" title="List View"><i class="fa fa-bars fa-2x"></i></a>
		<div style="float:right;padding-right:20px;"><a href="{{ route('product_categories.create') }}" title="Add New product"><i class="fa fa-plus-circle fa-2x"></i></a></div><br /><br />
	@endcan
			@if (count($product_categories))
		<table id="product_categories" class="table table-hover table-responsive-sm table-sm">
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
				@foreach($product_categories as $product_category)
				<tr>
					<td>{{ $product_category->id }}</td>
					<td>{{ $product_category->display_order }}</td>
					<td>{{ $product_category->slug }}</td>
					<td>{{ $product_category->name }}</td>
					<td>@if($product_category->active ) <i class="fa fa-check-square-o fa-lg" style="color:green;"></i> @else <i class="fa fa-square-o fa-lg" style="color:red;"></i> @endif</td>
					<td>
					{{-- <a href="{{ route('product_categories.show', ['product_category' => $product_category->id]) }}" title="View Product Category Details"><i class="fa fa-info-circle fa-2x"></i></a>&nbsp;&nbsp; --}}
					@can('edit_product_categories')
					<button><a href="{{ route('product_categories.edit', ['product_category' => $product_category->id]) }}" title="Edit Product Category Details"><i class="fa fa-pencil-square fa-2x"></i></a></button>&nbsp;&nbsp;
					@endcan
				{{-- <a href="{{ route('product_categories.destroy', ['product_category' => $product_category->id]) }}" title="Remove Product Category"><i class="fa fa-trash fa-2x"></i></a> --}}
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
		$('#product_categories').DataTable({
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
