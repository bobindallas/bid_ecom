@extends(config('view.SITE_LAYOUT'))

@section('content_header')
   {{ Breadcrumbs::render('site.product', $product_category, $product) }}
@stop

@push('css')
      <!-- Add the slick-theme.css if you want default styling -->
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
      <!-- Add the slick-theme.css if you want default styling -->
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>
@endpush

@section('content')
<div class="container">
   <div class="row">
      <div class="col-6">
         <div class="slider-for">
            @foreach($product->media->sortBy('order_column') as $image)
	            <img src="{{ $image->getUrl('small') }}" alt="{{ $image->getCustomProperty('alt_tag') }}" title="{{ $image->getCustomProperty('alt_tag') }}" width="200" height="400">
            @endforeach
         </div>
         <br><br>
         <div class="slider-nav">
         @foreach ($product->media->sortBy('order_column') as $image)
            <div>
            <img src="{{ $image->getUrl('small') }}" alt="{{ $image->getCustomProperty('alt_tag') }}" title="{{ $image->getCustomProperty('alt_tag') }}" width="100" height="100">
            </div>
         @endforeach
         </div>
      </div>
      <div class="col-6" v-cloak id="prod_itm">
         <hr>
         {!! $product->description !!} 
         <h5>Price - &#36;@{{ fdata.item_price }}</h5>
         <hr>
         <form action="{{ route('add_to_cart') }}" name="F1" id="F1" method="POST">
            @csrf
            @method('PUT')
            <div class="form-row">
               <div class="form-group col-md-6">
                  <label for="quantity">Quantity</label>
                  <select class="form-control" name="quantity" id="quantity" v-model="fdata.qty" v-on:change="check_form">
                     <option v-for="qty in prod_qty">@{{ qty }}</option>
                  </select>
               </div>
            </div>
				@include('inc.site.product.product_options') 
				@include('inc.site.product.product_attributes') 
            <input type="hidden" id="category" name="category" value="{{ $product_category->slug }}">
            <input type="hidden" id="product" name="product" value="{{ $product->slug }}">
            <input type="submit" value="Add to Cart" class="btn btn-primary">
            <input type="button" onclick="alert('coming soon...');" value="Add to Wishlist" class="btn btn-secondary">
         </form>
      </div>
   </div>
</div>
@endsection

@push('js')
	@parent
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
	<script type="text/javascript">
	
	$('.slider-for').slick({
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  arrows: false,
	  fade: true,
	  speed: 1000,
	  asNavFor: '.slider-nav'
	});
	$('.slider-nav').slick({
	  slidesToShow: 3,
	  slidesToScroll: 1,
	  autoplay: true,
	  autoplaySpeed: 10000,
	  asNavFor: '.slider-for',
	  dots: true,
	  centerMode: true,
	  focusOnSelect: true
	});
	</script>
	<script>
	var fu1 = _.range(1,11);

	Vue.component('todo-item', {
	  template: '<li>This is a todo</li>'
	});

	var plist = new Vue({
		el: '#prod_itm',
		data: {
	
			'prod_qty' : fu1,
	
			fdata : {
				'prod_price' : {{ $product->price }},
				'item_price' : {{ $product->price }},
				'qty'      : 1,
				'disabled' : true
			},
	
			errors       : []
		},
	
		methods: {
	
			check_price: function() {
				this.fdata.item_price = new Number(this.fdata.prod_price * this.fdata.qty).toFixed(2);
			},
	
			check_form: function(event) {
				// this.errors = [];
				this.check_price();
	
				/***
				if (this.errors.length) {
					this.fdata.disabled = true;
				} else {
					this.fdata.disabled = false;
				}
			***/
			}
	
		}, // methods

		watch: {
			'fdata': {
				'handler' : function (v) {
					alert('xxx');
				}
			},
			deep: true
		},

		// init form on page load
		created: function() {
			this.check_form();
		},
	});
	</script>

@endpush
