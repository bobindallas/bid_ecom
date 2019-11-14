<div style="margin-bottom:10px;">
@if ($product->product_attribute->count())
	<h5>Product Features</h5>
	<hr />
	@foreach($product->product_attribute->sortBy('display_order') as $option)
		<div class="form-group">
			<label for="{{ $option->slug }}">{{ $option->name }}</label>
				<div style="padding-left:20px;"><strong>{{ $option->attr_value }}</strong></div>
	@endforeach
@endif
</div>
