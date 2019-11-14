@extends(config('view.SITE_LAYOUT'))

@section('content_header')
   {{ Breadcrumbs::render('site.home') }}
@stop

@section('content')
<style>
   .card { margin-bottom: 20px; }
   #card-img { min-height: 200px; }
</style>
  <div class="row">
   @foreach($product_categories as $category)
   <div class="col-sm-4" style="padding-bottom:10px;">
      <div class="card h-100">
         <div class="card-body">
            <a href="{{ route('site.product_category', $category->slug) }}">
               <h4 class="card-title text-center">{{ $category->name }}</h4>
            </a>
<div id="card-img">
            @if (count($category->media))
            <a href="{{ route('site.product_category', $category->slug) }}">
               <img class="card-img-top" src="{{ $category->media->sortBy('order_column')->first()->getUrl('small') }}" alt="Image">
            </a>
            @endif
</div>
            <p class="card-text">{!! $category->description !!}</p>
         </div>
      </div>
   </div>
   @endforeach
  </div>
@stop
