@extends(config('view.ADMIN_LAYOUT'))

@section('content_header')
	{{ Breadcrumbs::render('product_attributes.create') }}
@stop

@section('content')
	<div class="container">
		<div id="plist">
		<div class="card">
			<div class="card-header">Add New Product Attribute</div>
			<div class="card-body">
				<form method='POST' action="{{ route('product_attributes.store') }}" name="F1" id="F1">
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
						<input type="text" name="name" value="" class='form-control' v-model="fdata.name" v-on:keyup="check_form" placeholder='Product Attribute Name'>
					</div>
					<div class="form-group">
						<label for="attr_value">Value</label>
						<textarea name="attr_value" value="" class='form-control' placeholder=''></textarea>
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
					<input type="hidden" name="product" id="product" value="{{ $product->id }}">
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
				name            : "{{ old('name') }}",
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
