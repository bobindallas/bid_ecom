@extends(config('view.ADMIN_LAYOUT'))

@section('content_header')
	{{ Breadcrumbs::render('product_categories.create') }}
@stop

@section('content')
	<div class="container">
		<div id="plist">
		<div class="card">
			<div class="card-header">Add New Product Category</div>
			<div class="card-body">
				<form method='POST' action="{{ route('product_categories.store') }}" name="F1" id="F1">
					@csrf
					@method('POST')
					<div v-if="errors.length" class="alert alert-warning">
						<span class="lead">Some required data...</span>
							<ul>
								<li v-for="error in errors" class="list-unstyled"> @{{ error }}</li>
							</ul>
					</div>
					<div class="form-group">
						<label for="name">Name *</label>
						<input type="text" name="name" value="" class='form-control' v-model="fdata.name" v-on:keyup="check_form" placeholder='Product Category Name'>
					</div>
					<div class="form-group">
						<label for="slug">Slug</label>
						<input type="text" name="slug_dsp" value="" class='form-control' v-model="fdata.slug" placeholder='Slug' tabindex="-1" readonly>
						<input type="hidden" name="slug" id="slug" v-model="fdata.slug">
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<textarea name="description" value="" class='form-control' placeholder=''>{!! old('description') !!}</textarea>
					</div>
					<div class="form-group">
						<label for="display_order">Display Order</label>
						<input type="text" name="display_order" value="" class='form-control' v-model="fdata.display_order" v-on:keyup="check_form" placeholder='Display Order'>
					</div>
					<div class="form-group">
						<label for="active">Active</label>
						<input type="checkbox" id="active" name="active" value="1" v-model="fdata.active">
					</div>
					<input type="submit" value="Submit" class="btn btn-primary" :disabled=fdata.disabled>
				</form>
			</div>
		</div>
		</div>
	</div>

<script>

	// a really simple vue model with form validation
	var plist = new Vue({
		el: '#plist',
		data: {
	
			fdata : {
				slug            : "{{ old('slug') }}",
				name            : "{{ old('name') }}",
				display_order   : "{{ old('price_type') }}",
				active          : 1,
				disabled        : true,
			},

			computed: {
			},
	
			errors : [],
			checkedCats : []
		},
	
		methods: {

			check_name: function(event) {
				if (this.fdata.name.length < 3) {
					this.errors.push('Name must be at least 3 chars');
				}
				this.fdata.slug = this.slugify(this.fdata.name);
			},
	
			check_description: function(event) {
				if (this.fdata.description.length < 5) {
					// this.errors.push('Description must be at least 5 chars');
				}
			},

			check_form: function(event) {
				this.errors = [];
				this.check_name();
	
				this.fdata.disabled = (this.errors.length) ? true : false;
			},

			slugify: function (text) {
			
				return text.toString().toLowerCase()
					.replace(/\s+/g, '-')           // Replace spaces with -
					.replace(/[^\w\-]+/g, '')       // Remove all non-word chars
					.replace(/\-\-+/g, '-')         // Replace multiple - with single -
					.replace(/^-+/, '')             // Trim - from start of text
					.replace(/-+$/, '');            // Trim - from end of text
			}
	
		}, // methods
	
		// init form on page load
		created: function() {
			this.check_form();
		},
	});

	CKEDITOR.replace('description');
</script>
@endsection
