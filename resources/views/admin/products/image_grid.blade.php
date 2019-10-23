@extends(config('view.ADMIN_LAYOUT'))
@section('title', 'Product Images')

	@section('content_header')
		{{ Breadcrumbs::render('products.image_grid', $product) }}
	@stop

		@section('content')
  <style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
  #sortable li { margin: 5px 5px 5px 0; padding: 1px; float: left; width: 200px; height: 200px; font-size: 1em; text-align: center;}
  </style>
<div class="container">
@include('inc.admin.product_tabs', ['active' => 'images', 'product' => $product])
<div class="panel-primary">
<div class="card">
<div class="card-body">
<div style="float:right;padding-right:20px;">
<a href="{{ route('products.create_image', $product->id ) }}" title="Add New Product Image"><i class="fa fa-plus-circle fa-2x"></i></a>
</div>
<a href="{{ route('products.image_grid', $product->id ) }}" title="Grid View"><i class="fa fa-th fa-2x"></i></a>
<span style="padding-left:10px;"></span>
<a href="{{ route('products.image_list', $product->id ) }}" title="List View"><i class="fa fa-bars fa-2x" style="color: #ccc;"></i></a>
		<div class="card-body">
		@if(count($media))
			<div id="ud_link" style="visibility:hidden;">
				<form action="{{ route('products.update_image_display_order', $product->id) }}" name="F1" id="F1" method="POST">
					@csrf
					@method('PUT')
					<input type="hidden" id="product_id" name="product_id" value="{{ $product->id}}">
					<input type="hidden" id="item_order" name="item_order" value="xxx">
					<button type="submit" id="ud_order" class="btn btn-primary">Update Product Image Display Order</button>
				</form>
			</div>
			<ul id="sortable">
				@foreach($media as $image)
					<li class="ui-state-default" id="itm_{{ $image->id }}">
						 <img class="img-list" src="{{ $image->getUrl('thumb') }}" style="border:solid #ccc 1px;">
						{{-- <img class="img-list" src="duct_media/{{$image->product->id}}/images/th/{{ $image->name }}" width="200" height="200"> --}}
					</li>
				@endforeach
			</ul>
		@else
			<center>No Records Found...</center>
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
