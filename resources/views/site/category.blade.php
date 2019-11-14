@extends(config('view.SITE_LAYOUT'))

@section('content_header')
	{{-- Breadcrumbs::render('site.home') --}}
	{{ Breadcrumbs::render('site.product_category', $product_category) }}
@stop

@section('content')
<style>
	.card { margin-bottom: 20px; }
	#card-img { min-height: 200px; }
</style>
<div class="container">
	<div class="row">
		@foreach($product_category->category_has_product as $category_product)
			@if(! $category_product->product->active)
				@continue
			@endif
			<div class="col-sm-4">
			  <div class="card h-100">
				 <div class="card-body">
					<a href="{{ route('site.product', [$product_category->slug, $category_product->product->slug]) }}">
						<h4 class="card-title text-center">{{ $category_product->product->name }}</h4>
					</a>
<div id="card-img">
					<a href="{{ route('site.product', [$product_category->slug, $category_product->product->slug]) }}">
						<img class="card-img-top" src="{{ $category_product->product->media->sortBy('order_column')[0]->getUrl('small') }}" alt="{{ $category_product->product->media->sortBy('order_column')[0]->getCustomProperty('alt_tag') }}">
					</a>
</div>
					<p class="card-text">{!! $category_product->product->description !!}</p>
					<a href="{{ route('site.product', [$product_category->slug, $category_product->product->slug]) }}" class="mt-auto btn btn-lg btn-block btn-primary">Shop Now</a>
				 </div>
			  </div>
			</div>
		@endforeach
	</div>
</div>
@stop
