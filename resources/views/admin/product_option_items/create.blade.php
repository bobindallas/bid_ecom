@extends(config('view.ADMIN_LAYOUT'))

@section('content_header')
	{{ Breadcrumbs::render('product_option_items.create', $product_option) }}
@stop

@section('content')
	<div class="container">
		<div id="plist">
		<div class="card">
			<div class="card-header">{{ $product_option->name }} : Add New Option Item</div>
			<div class="card-body">
				<form method='POST' action="{{ route('product_option_items.store', $product_option) }}" name="F1" id="F1">
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
						<input type="text" name="name" value="" class='form-control' v-model="fdata.name" v-on:keyup="check_form" placeholder='Product Option Item Name'>
					</div>
					<div class="form-group">
						<label for="slug">Slug</label>
						<input type="text" name="slug_dsp" value="" class='form-control' v-model="fdata.slug" placeholder='Slug' tabindex="-1" readonly>
						<input type="hidden" name="slug" id="slug" v-model="fdata.slug">
					</div>
					<div class="form-group">
						<label for="value">Value *</label>
						<input type="text" name="value" value="" class='form-control' v-model="fdata.value" v-on:keyup="check_form" placeholder='Product Option Item Value'>
					</div>
					<div class="form-group">
						<label for="price_type">Option Item Price Type</label>
						<select id="price_type" name="price_type" class="form-control">
							<option value="F">Free</option>
							<option value="L">Flat Rate</option>
							<option value="P">Percent of Product Price</option>
							<option value="W">Priced by Width</option>
							<option value="H">Free</option>
							<option value="G">Free</option>
						</select>
					</div>
					<div class="form-group">
						<label for="price_value">Price</label>
						<input type="text" name="price_value" value="" class='form-control' v-model="fdata.price_value" v-on:keyup="check_form" placeholder='Product Option Item Price'>
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<textarea name="description" value="" class='form-control' placeholder=''></textarea>
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
					<input type="submit" value="Submit" class="btn btn-primary" :disabled=fdata.disabled>
					<input type="hidden" name="product" id="product" value="{{ $product_option->product_id }}">
					<input type="hidden" name="product_option" id="product_option" value="{{ $product_option->id }}">
				</form>
			</div>
		</div>
		</div>
	</div>

<script>

	// a really simple vue model with form validation
	var fu1 = _.range(1,31);
	var plist = new Vue({
		el: '#plist',
		data: {
	
			'dsp_ord' : fu1,

			fdata : {
				slug            : "{{ old('slug') }}",
				name            : "{{ old('name') }}",
				value           : "{{ old('value') }}",
				price_type      : "{{ old('price_type') }}",
				price_value     : "{{ old('price_value') }}",
				display_order   : "{{ old('display_order') }}",
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
	
			check_value: function(event) {
				if (! this.fdata.value.length) {
					this.errors.push('Value is required');
				}
			},

			check_description: function(event) {
				if (this.fdata.description.length < 5) {
					// this.errors.push('Description must be at least 5 chars');
				}
			},

			check_form: function(event) {
				this.errors = [];
				this.check_name();
				this.check_value();
	
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
