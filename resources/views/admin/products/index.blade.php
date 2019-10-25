@extends(config('view.ADMIN_LAYOUT'))
@section('title', 'products')

@section('content_header')
   {{ Breadcrumbs::render('products.index') }}
@stop

@section('content')
	<div class="container">
		<div class="card">
		<div class="card-body">
	@can('create_products')
		<div style="float:right;padding-right:20px;"><a href="{{ route('products.create') }}" title="Add New product"><i class="fa fa-plus-circle fa-2x"></i></a></div><br /><br />
	@endcan
			@if (count($products))
		<table id="products" class="table table-hover table-responsive-sm table-sm">
			<thead>
				<tr>
					<th>ID</th>
					<th>Slug</th>
					<th>Name</th>
					<th>Created</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($products as $product)
				<tr>
					<td>{{ $product->id }}</td>
					<td>{{ $product->slug }}</td>
					<td>{{ $product->name }}</td>
					<td>{{ $product->created_at->toFormattedDateString() }}</td>
					<td>
					{{-- <a href="{{ route('products.show', ['product' => $product->id]) }}" title="View product Details"><i class="fa fa-info-circle fa-2x"></i></a>&nbsp;&nbsp; --}}
					@can('edit_products')
					<a href="{{ route('products.edit', ['product' => $product->id]) }}" title="Edit product Details"><i class="fa fa-pencil-square fa-2x"></i></a>&nbsp;&nbsp;
					@endcan
					@can('edit_products')
					<form method="post" id="F1" name="F1" action="{{ route('products.destroy', ['product' => $product->id]) }}" style="display:inline;">@csrf @method('DELETE')<a onclick="if(confirm('Really delete this product?\nConsider making it inactive instead.')) { this.parentNode.submit(); }" title="Delete this Product"><i class="fa fa-trash fa-2x" style="color:red;"></i></a></form>
					@endcan
				{{-- <a href="{{ route('products.destroy', ['product' => $product->id]) }}" title="Remove product"><i class="fa fa-trash fa-2x"></i></a> --}}
				</td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>ID</th>
					<th>Slug</th>
					<th>Name</th>
					<th>Created</th>
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
		$('#products').DataTable({
		  "paging": true,
		  "lengthChange": true,
		  "searching": true,
		  "ordering": true,
		  "info": true,
		  "autoWidth": false,
		  'columnDefs' : [{
		  		'targets' : [-1],
				'orderable' : false
			}]
		});
		</script>
		@stop

@push('css')
@push('js')
