@extends(config('view.SITE_LAYOUT'))

@section('content_header')
   {{-- Breadcrumbs::render('site.home') --}}
   {{ Breadcrumbs::render('site.product_category', $product_category) }}
@stop


@section('content')
<div class="container">
   <div class="row">
      <div class="col-6">
         <div class="slider-for">
            @foreach($product->product_images as $image)
               <img src="{{$media_base}}/{{$product->id}}/{{$image_base}}/sm/{{ $image->name }}" alt="{{ $image->alt_tag }}" title="{{ $image->alt_tag }}">
            @endforeach
         </div>
         <br><br>
         <div class="slider-nav">
         @foreach ($product->product_images as $image)
            <div>
            <img src="{{$media_base}}/{{$product->id}}/{{$image_base}}/th/{{ $image->name }}" alt="{{ $image->alt_tag }}" title="{{ $image->alt_tag }}" width="100" height="100">
            </div>
         @endforeach
         </div>
      </div>
      <div class="col-6" v-cloak id="prod_itm">
         {{-- <h4>{{ $product->name }} - &#36;{{$product->price}}</h4> --}}
         <h4>{{ $product->name }} - &#36;@{{ fdata.item_price }}</h4>
         <hr>
         {!! $product->description !!} 
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
<ol>
  <!-- Create an instance of the todo-item component -->
  <todo-item></todo-item>
</ol>
               </div>
            </div>
            @include('inc.product.product_options')
            <input type="hidden" id="category" name="category" value="{{ $product_category->slug }}">
            <input type="hidden" id="product" name="product" value="{{ $product->slug }}">
            <input type="submit" value="Add to Cart" class="btn btn-primary">
            <input type="button" onclick="alert('coming soon...');" value="Add to Wishlist" class="btn btn-secondary">
         </form>
      </div>
   </div>
</div>
@endsection
