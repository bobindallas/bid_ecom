@extends(config('view.ADMIN_LAYOUT'))

@section('content_header')
	{{ Breadcrumbs::render('products.create') }}
@stop

@section('content')
	<div class="container">
		<div id="plist">
		<div class="card">
			<div class="card-header">Add New Product</div>
			<div class="card-body">
				<form method='POST' action="{{ route('products.store') }}" name="F1" id="F1">
					@csrf
					@method('POST')
					<div v-if="errors.length" class="alert alert-warning">
						<span class="lead">Some required data...</span>
							<ul>
								<li v-for="error in errors" class="list-unstyled"> @{{ error }}</li>
							</ul>
					</div>
					<div class="form-group">
						<label for="slug">Slug</label>
						<input type="text" name="slug_dsp" value="" class='form-control' v-model="fdata.slug" v-on:keyup="check_form" placeholder='Slug' readonly>
						<input type="hidden" name="slug" id="slug" v-model="fdata.slug">
					</div>
					<div class="form-group">
						<label for="name">Name *</label>
						<input type="text" name="name" value="" class='form-control' v-model="fdata.name" v-on:keyup="check_form" placeholder='Product Name'>
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<textarea name="description" value="" class='form-control' v-model="fdata.description" placeholder='Product Description'></textarea>
					</div>
					<div class="form-group">
						<label for="cost">Cost *</label>
						<input type="text" name="cost" value="" class='form-control' v-model="fdata.cost" v-on:keyup="check_form" placeholder='cost'>
					</div>
					<div class="form-group">
						<label for="cost_multiplier">Cost Multiplier *</label>
						<input type="text" name="cost_multiplier" value="" class='form-control' v-model="fdata.cost_multiplier" v-on:keyup="check_form" placeholder=''>
					</div>
					<div class="form-group">
						<label for="email">Price (computed)</label>
						<div name="price" id="price">@{{ fdata.price }}</div>
					</div>
					<div class="form-group">
						<label for="sku">SKU</label>
						<input type="text" name="sku" value="" class='form-control' placeholder='SKU'>
					</div>
					<div class="form-group">
						<label for="active">Active</label>
						<input type="text" name="active" value="" class='form-control'>
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
				description     : "{{ old('description') }}",
				cost            : "{{ old('cost') }}",
				cost_multiplier : "{{ old('cost_multiplier') }}",
				sku             : "{{ old('sku') }}",
				price           : 1,
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

			check_cost: function(event) {
				if (! this.fdata.cost.length || isNaN(this.fdata.cost)) {
					this.errors.push('Please enter a cost');
				}
			},

			check_cost_multiplier: function(event) {
				if (! this.fdata.cost_multiplier.length || isNaN(this.fdata.cost_multiplier)) {
					this.errors.push('please enter a cost multiplier');
				}
			},

			check_price: function(event) {
				this.fdata.price = this.fdata.cost * this.fdata.cost_multiplier;
				this.fdata.price = this.fdata.price.toFixed(2);
			},

			check_cats: function(event) {
				if (this.checkedCats.length < 1) {
					this.errors.push('Please select at least one Product Category');
				}
			},
	
			check_form: function(event) {
				this.errors = [];
				this.check_name();
				this.check_cost();
				this.check_cost_multiplier();
				this.check_price();
				this.check_cats();
	
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
