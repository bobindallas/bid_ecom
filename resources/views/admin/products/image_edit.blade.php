@extends(config('view.ADMIN_LAYOUT'))

@section('title', 'Edit Product Image')

@section('content_header')
	{{ Breadcrumbs::render('products.edit_image', $product) }}
@stop

@section('content')
<div class="container">
			<div id="plist">
			<form action="{{ route('products.update_image', [$product->id, $image->id]) }}" name="F1" id="F1" enctype="multipart/form-data" method="POST">
				@csrf
				@method('PUT')
				<div class="card">
				<div class="panel panel-primary">
					<div class="card-header">Update Product Image</div>
					<div class="card-body">
						<div v-cloak v-if="errors.length" class="alert alert-warning">
							<span class="lead">Some required data...</span>
							<ul>
								<li v-for="error in errors" class="list-unstyled"> @{{ error }}</li>
							</ul>
						</div>
						<div>
							<img src="{{ $image->getUrl('small') }}" style="border:solid #ccc 1px;">
						</div>
						<div class="form-group">
							<label for="name">Name</label>
							<input disabled type="text" name="name" id="name" v-model="fdata.name" v-on:keyup="check_form" class='form-control' placeholder='Title'>
						</div>
						<div class="form-group">
							<label for="title">Title *</label>
							<input type="text" name="title" id="title" v-model="fdata.title" v-on:keyup="check_form" class='form-control' placeholder='Title'>
						</div>
						<div class="form-group">
							<label for="alt_tag">Alt Tag *</label>
							<input type="text" name="alt_tag" id="alt_tag" v-model="fdata.alt_tag" v-on:keyup="check_form" class='form-control' placeholder='Alt Tag'>
						</div>
						<div class="form-group">
							<label for="caption">Caption</label>
							<textarea rows="3" name="caption" id="caption" class='form-control' placeholder='Caption'>{{ $image->getCustomProperty('caption') }}</textarea>
						</div>
						<div class="form-group">
							<label for="display_order">Display Order *</label>
							<select class="form-control" id="display_order" name="display_order" v-model="fdata.display_order" v-on:keyup="check_form">
								<option v-for="ord in dsp_ord">@{{ ord }}</option>
							</select>
						</div>
						<div class="form-group">
							<label for="active">Active</label>
							<input type="checkbox" id="active" name="active" value="1" v-model="fdata.active">
						</div>
				</div>
			</div>
			</div>
			<input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
			<input type="hidden" name="product_image_id" id="product_image_id" value="{{ $image->id }}">
			<input type="hidden" name="product_image_delete" id="product_image_delete" v-model="fdata.delete" value=0>
			<button type="submit" id="F1.submit" class="btn btn-primary" :disabled=fdata.disabled>Save</button>
			<button type="button" name="delete" id="delete" class="btn btn-danger" :disabled=fdata.disabled
 onclick="if(window.confirm('Really delete this product image?')){ document.getElementById('product_image_delete').value = 1; F1.submit();}">delete</button>
			</form>
<br />
	</div>
</div>
@endsection

@section('css')
@stop
@section('js')
	<script>
// a really simple vue model with form validation
   var fu1 = _.range(1,31);
var plist = new Vue({
	el: '#plist',


	data: {

	  'dsp_ord' : fu1,

		fdata : {
			name          : '{{ $image->name }}',
			title         : '{{ $image->getCustomProperty('title') }}',
			alt_tag       : '{{ $image->getCustomProperty('alt_tag') }}',
			caption       : '{{ $image->getCustomProperty('caption') }}',
			display_order : '{{ $image->order_column }}',
			active        : '{{ $image->getCustomProperty('active') }}',
			delete        : 0,
			disabled      : true,
		},

		errors : []
	},

	methods: {

		check_title: function(event) {
			if (this.fdata.title.length < 3) {
				this.errors.push('Title must be at least 3 chars');
			}
		},

		slugify: function (text) {

		  return text.toString().toLowerCase()
		    .replace(/\s+/g, '-')           // Replace spaces with -
		    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
		    .replace(/\-\-+/g, '-')         // Replace multiple - with single -
		    .replace(/^-+/, '')             // Trim - from start of text
		    .replace(/-+$/, '');            // Trim - from end of text
		},

		check_form: function(event) {
			this.errors = [];
			this.check_title();

			if (this.errors.length) {
				this.fdata.disabled = true;
			} else {
				this.fdata.disabled = false;
			}
		}

	}, // methods

	// init form on page load
	created: function() {
		this.check_form();
	},
})
	</script>
@stop

@push('css')
@push('js')
