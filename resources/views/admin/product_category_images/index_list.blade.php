@extends(config('view.ADMIN_LAYOUT'))
@section('title', 'Product Category Images')

	@section('content_header')
		{{ Breadcrumbs::render('product_category_images.index_list', $product_category) }}
	@stop

		@section('content')
<div class="container">
	<div class="panel-primary">
		<div class="card">
		<div class="card-body">
			<div style="float:right;padding-right:20px;">
			<a href="{{ route('product_category_images.create', $product_category->id ) }}" title="Add New Product Image"><i class="fa fa-plus-circle fa-2x"></i></a>
			</div>
			<a href="{{ route('product_category_images.index_grid', $product_category->id ) }}" title="Grid View"><i class="fa fa-th fa-2x" style="color: #ccc;"></i></a>
			<span style="padding-left:10px;"></span>
			<a href="{{ route('product_category_images.index_list', $product_category->id ) }}" title="List View"><i class="fa fa-bars fa-2x"></i></a>
					<div class="card-body">
					@if (count($product_category->media))
						<table id="product_category_images" class="table table-hover table-responsive-sm table-sm">
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
								@foreach($product_category->media as $image)
								 <tr>
								 <td>{{ $image->id }}</td>
								 <td>{{ $image->order_column }}</td>
								 <td>{{ $image->name }}</td>
								 <td>{{ $image->getCustomProperty('title') }}</td>
								 <td>{{ $image->getCustomProperty('alt_tag') }}</td>
								 <td>@if($image->getCustomProperty('active', false) ) <i class="fa fa-check-square-o fa-lg" style="color:green;"></i> @else <i class="fa fa-square-o fa-lg" style="color:red;"></i> @endif</td>
								 <td>
									<a href="{{ route('product_category_images.edit', ['product_category' => $product_category->id, 'media_id' => $image->id]) }}" title="Edit Product Option Image"><i class="fa fa-pencil-square fa-2x"></i></a>
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
		$('#product_category_images').DataTable({
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
