@extends(config('view.ADMIN_LAYOUT'))

@section('content_header')
	{{ Breadcrumbs::render('store_details.create') }}
@stop

@section('content')
	<div class="container">
		<div id="plist">
		<div class="card">
			<div class="card-header">Add New Store</div>
			<div class="card-body">
				<form method='POST' action="{{ route('store_details.update', $store_details) }}" name="F1" id="F1">
					@csrf
					@method('PUT')
					<div v-if="errors.length" class="alert alert-warning">
						<span class="lead">Some required data...</span>
							<ul>
								<li v-for="error in errors" class="list-unstyled"> @{{ error }}</li>
							</ul>
					</div>
					<div class="form-group">
						<label for="name">Name *</label>
						<input type="text" name="name" value="" class='form-control' v-model="fdata.name" v-on:keyup="check_form" placeholder='Store Name'>
					</div>
					<div class="form-group">
						<label for="address1">Address 1 *</label>
						<input type="text" name="address1" value="" class='form-control' v-model="fdata.address1" v-on:keyup="check_form" placeholder='Address 1'>
					</div>
					<div class="form-group">
						<label for="address2">Address 2</label>
						<input type="text" name="address2" value="" class='form-control' v-model="fdata.address2" v-on:keyup="check_form" placeholder='Address 2'>
					</div>
					<div class="form-group">
						<label for="city">City</label>
						<input type="text" name="city" value="" class='form-control' v-model="fdata.city" v-on:keyup="check_form" placeholder='City'>
					</div>
					<div class="form-group">
						<label for="state">State</label>
						<input type="text" name="state" value="" class='form-control' v-model="fdata.state" v-on:keyup="check_form" placeholder='State'>
					</div>
					<div class="form-group">
						<label for="country">Country</label>
						<input type="text" name="country" value="" class='form-control' v-model="fdata.country" v-on:keyup="check_form" placeholder='Country'>
					</div>
					<div class="form-group">
						<label for="postal_code">Postal / ZIP Code</label>
						<input type="text" name="postal_code" value="" class='form-control' v-model="fdata.postal_code" v-on:keyup="check_form" placeholder='Postal / ZIP Code'>
					</div>
					<div class="form-group">
						<label for="phone1">Phone 1</label>
						<input type="text" name="phone1" value="" class='form-control' v-model="fdata.phone1" v-on:keyup="check_form" placeholder='Phone 1'>
					</div>
					<div class="form-group">
						<label for="phone2">Phone 2</label>
						<input type="text" name="phone2" value="" class='form-control' v-model="fdata.phone2" v-on:keyup="check_form" placeholder='Phone 2'>
					</div>
					<div class="form-group">
						<label for="fax">Fax</label>
						<input type="text" name="fax" value="" class='form-control' v-model="fdata.fax" v-on:keyup="check_form" placeholder='Fax'>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" name="email" value="" class='form-control' v-model="fdata.email" v-on:keyup="check_form" placeholder='Email'>
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<textarea name="description" class='form-control'>{{ $store_details->description }}</textarea>
					</div>
					<div class="form-group">
						<label for="enable_taxes">Enable Taxes</label>
						<input type="checkbox" id="enable_taxes" name="enable_taxes" value="1" v-model="fdata.enable_taxes">
					</div>
					<div class="form-group">
						<label for="enable_shipping">Enable Shipping</label>
						<input type="checkbox" id="enable_shipping" name="enable_shipping" value="1" v-model="fdata.enable_shipping">
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
				name            : "{{ old('name', $store_details->name) }}",
				address1        : "{{ old('address1', $store_details->address1) }}",
				address2        : "{{ old('address2', $store_details->address2) }}",
				city            : "{{ old('city', $store_details->city) }}",
				state           : "{{ old('state', $store_details->state) }}",
				country         : "{{ old('country', $store_details->country) }}",
				postal_code     : "{{ old('postal_code', $store_details->postal_code) }}",
				phone1          : "{{ old('phone1', $store_details->phone1) }}",
				phone2          : "{{ old('phone2', $store_details->phone2) }}",
				fax             : "{{ old('fax', $store_details->fax) }}",
				email           : "{{ old('email', $store_details->email) }}",
				enable_taxes    : {{ old('enable_taxes', $store_details->enable_taxes) }},
				enable_shipping : {{ old('enable_sipping', $store_details->enable_shipping) }},
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
				// this.fdata.slug = this.slugify(this.fdata.name);
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
