@extends('partials.shopnav')

@section('shopnav_content')

<div class="row" style="margin-bottom:100px;">
	<div class="col l6 s12">
		<div class="carousel">
			@foreach($product->images()->get() as $image)
	    	<a class="carousel-item">
	    		<img src="/storage/images/product_images/{{$product->id}}/{{$image->image}}">
	    	</a>
			@endforeach
	  </div>
	</div>
	<div class="col l6 s12">
		<h5>{{ $product->name }}</h5>
		<p style="text-align: justify;">
			{!! $product->description !!}
		</p>
		<span class="rating">
      <span class="fa fa-star orange-text"></span>
      <span class="fa fa-star orange-text"></span>
      <span class="fa fa-star orange-text"></span>
      <span class="fa fa-star orange-text"></span>
      <span class="fa fa-star orange-text"></span>
    </span><br>
    @foreach($product->tags()->get() as $tag)
    	<a href="#">#{{ $tag->tag }}</a>
    @endforeach

    @if($product->discount > 0)
	    <h5>₱ {{ $product->original_price - ($product->original_price * ($product->discount * .01)) }}.00</h5>
	    <h6><strike>₱ {{ $product->original_price }}.00</strike> | {{ $product->discount }}% off</h6>
    @else
    	<h5>₱ {{ $product->original_price }}.00</h5>
    @endif<!-- check if product has discount -->
    <i>{{$product->warranty}} days warranty | ₱ {{$product->delivery_fee}}.00 delivery fee | {{$product->quantity}} pcs stock available</i>
    <hr>
    @foreach($product->store()->get() as $store)
    	<div id="productBtn">
	    	@guest
	    		<button class="btn-flat light-green waves-effect waves-light white-text" 
				    onclick="addToCart('{{$product->id}}','{{ $store->id }}')" id="addCartBtn">
			    	<span class="fa fa-shopping-cart"></span>
			    </button>
	    	@else
	    	  @if($cart->isEmpty())
		    		<button class="btn-flat light-green waves-effect waves-light white-text" 
					    onclick="addToCart('{{$product->id}}','{{ $store->id }}')" id="addCartBtn">
				    	<span class="fa fa-shopping-cart"></span>
				    </button>
		    	@else
		    	  @foreach($cart as $mycart)
		    			@if($mycart->product_id == $product->id)
		    				<button class="btn-flat waves-light waves-effect disabled gray">
				    			<span class="fa fa-shopping-cart"></span>
				    		</button>
		    			@endif
		    		@endforeach
		    	@endif<!-- check if product already in cart -->
	    	@endguest	
	    	<a class="waves-effect yellow darken-1 waves-light btn-flat modal-trigger" href="#addReviews">
		    	<span class="fa fa-star white-text"></span>
		    </a>
		    <a href="#" class="btn-flat waves-effect waves-light red white-text">
		    	<span class="fa fa-heart"></span>
		    </a>
	    </div>
    @endforeach
	</div>
</div>

<!-- Modal Structure -->
<div id="addReviews" class="modal bottom-sheet">
	<form id="reviewsForm">
		<div class="modal-content">
			<div class="row">
				{{ csrf_field() }}
				<input type="hidden" name="pid" value="{{ Crypt::encryptString($product->id) }}">
				<label>Stars</label>
				<div class="rating valign-wrapper">
				  <label>
				    <input type="radio" name="rate" value="5" title="5 stars"> 5
				  </label>
				  <label>
				    <input type="radio" name="rate" value="4" title="4 stars"> 4
				  </label>
				  <label>
				    <input type="radio" name="rate" value="3" title="3 stars"> 3
				  </label>
				  <label>
				    <input type="radio" name="rate" value="2" title="2 stars"> 2
				  </label>
				  <label>
				    <input type="radio" name="rate" value="1" title="1 star"> 1
				  </label>
				</div>
				<div class="input-field">
					<input name="content" id="content" placeholder="Add review"></input>
				</div>	
			</div>
				
		</div>
		<div class="modal-footer">
		<button type="submit" class="btn-flat light-green white-text waves-effect waves-light">Submit</button>
		<a class="modal-action modal-close waves-effect waves-light red white-text btn-flat">Close</a>
		</div>
	</form>
</div>

<ul id="tabs-swipe-demo" class="tabs">
  <li class="tab col s3"><a class="active"  href="#relatedProducts">Related Products</a></li>
  <li class="tab col s3"><a href="#reviews">Reviews</a></li>
</ul>
<div id="relatedProducts" class="col s12" style="margin-top: 10px">
	<div class="row gallery-container">
		@foreach($store_products as $store_product)
			@foreach($store_product->products()->limit(4)->get() as $product)		
				<div class="col m6 l3 s12">
					{{ $product->name }}
				</div>
			@endforeach
		@endforeach
	</div>
</div>
<div id="reviews" class="col s12 tab-contents" style="margin-bottom: 50px">
	<ul>
		@if(count($reviews)==0)
			<li id="no-review">No Reviews Yet</li>
		@else
			@foreach($reviews as $review)
				<ul>
			  	<li>
			  		@foreach($review->user()->get() as $user)
			  			<b>{{ $user->name }} {{ $user->lastname }}</b> | 
			  			@for($i = 0; $i < $review->rate; $i++)
			  				<span class="fa fa-star yellow-text"></span>
			  			@endfor
			  		@endforeach
			  	</li>
			  	<li><p style="text-align: justify">{!! $review->content !!}</p></li>
			  </ul>
			@endforeach
		@endif
	</ul>
</div>
<style type="text/css">
	.swal2-input {
		max-width: 100%!important;
		text-align: center!important;
	}
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('css/cards.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/stars.css') }}">
<script type="text/javascript" src="{{ asset('js/reviews.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/store.js') }}"></script>

@endsection
