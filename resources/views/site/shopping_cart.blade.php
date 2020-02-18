@extends(config('view.SITE_LAYOUT'))

@section('content_header')
{{ Breadcrumbs::render('shopping_cart') }}
@stop

@section('content')
<div class="container">
  <div class="row">
	@if ($cart_items)
	<div class="col-sm-12">
<br />
<br />

      <!-- Shopping Cart-->
      <div class="table-responsive" id="shopping_cart">
        <table class="table">
          <thead>
            <tr>
              <th>Product Name</th>
              <th class="text-center">Quantity</th>
              <th class="text-center">Subtotal</th>
              <th class="text-center">Options Total</th>
              <th class="text-center">Product Total</th>
              <th class="text-center"><a class="btn btn-danger" href="{{ route('empty_cart') }}">Clear Cart</a></th>
            </tr>
          </thead>
          <tbody>
				@foreach($cart_items as $item)
            <tr>
              <td>
					<h4 class="product-title"><a href="{{ route('site.product', [$item->category_slug, $item->product_slug])}}">{{ $item->product_name }}</a></h4>
                <div class="product-item"><a class="product-thumb" href="{{ route('site.product', [$item->category_slug, $item->product_slug])}}"><img src="{{ $item->product_image }}" width="100" height="100"></a>
                  <div class="product-info">
							@foreach($item->product_options as $k => $v)
								<span><em>{{ $k }}:</em> {{ $v }}</span><br />
							@endforeach
                  </div>
                </div>
              </td>
              <td class="text-center">
                <div class="count-input">
                  <select class="form-control">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                </div>
              </td>
              <td class="text-center text-lg">${{ number_format($item->item_total,2) }}</td>
              <td class="text-center text-lg">${{ number_format($item->option_total,2) }}</td>
              <td class="text-center text-lg">${{ number_format($item->product_total,2) }}</td>
              <td class="text-center"><a class="" href="{{ route('remove_cart_item', $loop->index) }}" title="Remove item"><button type="button" class="btn btn-warning">Remove</button></a></td>
            </tr>
				@endforeach
          </tbody>
        </table>
      </div>
      <div class="">
        <div class="column">
			<form>
				<div class="form-row">
					<div class="col-sm-10">
						<input type="text" class="form-control" placeholder="Coupon Code">
					</div>
					<div class="col-sm">
						<button class="btn btn-primary" type="submit">Apply Coupon</button>
					</div>
				</div>
			</form>
        </div>
        <div class="column text-right"><br /><span class="text-muted">Cart Total:&nbsp; </span><span class="text-gray-dark">${{ number_format($cart->cart_total,2) }}</span></div>
      </div>
      <div class="">
        <div class="column"><a class="btn btn-secondary" href="{{ route('site.home') }}">&nbsp;Back to Shopping</a></div>
        <div class="column"><br /><a class="btn btn-secondary" href="#" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-check-circle" data-toast-title="Your cart" data-toast-message="is updated successfully!">Update Cart</a> <a class="btn btn-primary" href="{{ route('checkout') }}">Checkout</a></div>
      </div>
	</div>
	@else
		<div class="col-sm-12" style="height:200px;">
			<div class="row h-100 justify-content-center align-items-center">Nothing in your cart</div>
		</div>
	@endif
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
// alert('xxx');
</script>
@parent
@endsection
