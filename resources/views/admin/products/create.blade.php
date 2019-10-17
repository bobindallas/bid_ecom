@extends(config('view.ADMIN_LAYOUT'))

@section('content_header')
	{{ Breadcrumbs::render('products.create') }}
@stop

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body">
				<form method='POST' action="{{ route('products.store') }}">
					@csrf
					<div class="form-group">
						<label for="slug">Slug</label>
						<input type="text" name="slug" value="" class='form-control' placeholder='Slug' readonly>
					</div>
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="name" value="" class='form-control' placeholder='Product Name'>
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<textarea name="description" value="" class='form-control' placeholder='Product Description'></textarea>
					</div>
					<div class="form-group">
						<label for="cost">Cost</label>
						<input type="text" name="cost" value="" class='form-control' placeholder='cost'>
					</div>
					<div class="form-group">
						<label for="cost_multiplier">Cost Multiplier</label>
						<input type="text" name="cost_multiplier" value="" class='form-control' placeholder=''>
					</div>
					<div class="form-group">
						<label for="sku">SKU</label>
						<input type="text" name="sku" value="" class='form-control' placeholder='SKU'>
					</div>
					<div class="form-group">
						<label for="active">Active</label>
						<input type="text" name="active" value="" class='form-control'>
					</div>
					<input type="submit" value="Submit" class="btn btn-primary">
				</form>
			</div>
		</div>
	</div>
	<script>
		CKEDITOR.replace('description');
	</script>
@endsection
