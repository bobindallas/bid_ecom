<ul class="nav nav-tabs" role="tablist">
	<li class="nav-item">
		<a @if($active == 'details') class="nav-link active" @else class="nav-link" @endif href="{{ route('products.edit', $product) }}" role="tab" aria-controls="details">Details</a>
	</li>
	<li class="nav-item">
		<a @if($active == 'images') class="nav-link active" @else class="nav-link" @endif href="{{ route('product_images.index_grid', $product) }}" role="tab" aria-controls="images">Images</a>
	</li>
	<li class="nav-item">
		<a @if($active == 'options') class="nav-link active" @else class="nav-link" @endif href="{{ route('product_options.index', $product) }}" role="tab" aria-controls="options">Options</a>
	</li>
</ul>
