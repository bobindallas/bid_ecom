<div style="margin-bottom:10px;">
@if ($product->product_option->count())
	<h5>Product Options</h5>
	<hr />
	@foreach($product->product_option->sortBy('display_order') as $option)
		<div class="form-group">
			<label for="{{ $option->slug }}">{{ $option->name }}</label>
				<select class="form-control" id="{{ $option->slug }}" name="options[{{ $option->slug }}]">
					@if($option->product_option_item->count())
						@foreach($option->product_option_item->sortBy('display_order') as $item)
							<option value="{{ $item->value }}">{{ $item->name }}</option>
						@endforeach
					@endif
				</select>
		</div>
	@endforeach
@endif
</div>
