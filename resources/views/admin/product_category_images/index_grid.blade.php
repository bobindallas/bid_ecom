@extends(config('view.ADMIN_LAYOUT'))
@section('title', 'Product Category Images')

	@section('content_header')
		{{ Breadcrumbs::render('product_category_images.index_grid', $product_category) }}
	@stop

		@section('content')
  <style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
  #sortable li { margin: 5px 5px 5px 0; padding: 1px; float: left; width: 200px; height: 200px; font-size: 1em; text-align: center;}
  </style>
<div class="container">
<div class="panel-primary">
<div class="card">
<div class="card-body">
<div style="float:right;padding-right:20px;">
<a href="{{ route('product_category_images.create', $product_category->id ) }}" title="Add New Product Image"><i class="fa fa-plus-circle fa-2x"></i></a>
</div>
<a href="{{ route('product_category_images.index_grid', $product_category->id ) }}" title="Grid View"><i class="fa fa-th fa-2x"></i></a>
<span style="padding-left:10px;"></span>
<a href="{{ route('product_category_images.index_list', $product_category->id ) }}" title="List View"><i class="fa fa-bars fa-2x" style="color: #ccc;"></i></a>
		<div class="card-body">
		{{-- @if(count($product_category->media)) --}}
		@if(count($media))
			<div id="ud_link" style="visibility:hidden;">
				<form action="{{ route('product_category_images.update_display_order', $product_category->id) }}" name="F1" id="F1" method="POST">
					@csrf
					@method('PUT')
					<input type="hidden" id="product_category_id" name="product_category_id" value="{{ $product_category->id}}">
					<input type="hidden" id="item_order" name="item_order" value="">
					<button type="submit" id="ud_order" class="btn btn-primary">Update Product Category Image Display Order</button>
				</form>
			</div>
			<ul id="sortable">
				{{-- @foreach($product_category->media as $image) --}}
				@foreach($media as $image)
					<li class="ui-state-default" id="itm_{{ $image->id }}">
						 <img class="img-list" src="{{ $image->getUrl('thumb') }}" style="border:solid #ccc 1px;cursor:pointer;" title="{{ $image->name }} : drag to re-order">
					</li>
				@endforeach
			</ul>
		@else
			<center>No Items Found...</center>
		@endif
		</div>
</div>
	@stop

	@section('css')
	@stop

	@section('js')
		<script>
		// done this a bunch of times with jQuery so we're using that for now
		// maybe do some vue version later
	itm_order = {};
  $(function() {
	  $( "#sortable" ).sortable({
        update: function() { 
			$('#ud_link').show();
			$('#ud_link').css('visibility','visible');
			$('#ud_link').show();
			itm_order = {}; // clear array
			var x = 1;

			$('li[id^="itm_"]').each(function() {
				fu = $(this).attr('id');
				jo = fu.match(/^itm_(\d+)/);
				itm_order[x] = jo[1];
				x++;
			});
	  	}
		});
    // $( "#sortable" ).disableSelection();
	});

	// save updated order
	$('#ud_order').click(function() {
		var fu = JSON.stringify(itm_order);
		// alert(fu);
		$('#item_order').val(fu);
		$('#F1').submit();
	});
	</script>
	@stop

@push('css')
@push('js')
