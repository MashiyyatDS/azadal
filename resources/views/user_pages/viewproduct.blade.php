@extends('partials.shopnav')

@section('shopnav_content')

<div class="row">
	<div class="col l6 m12 s12">
		<div class="carousel">
			@foreach($product->images()->get() as $image)
	    	<a class="carousel-item" href="#one!">
	    		<img src="/storage/images/product_images/{{$product->id}}/{{$image->image}}">
	    	</a>
			@endforeach
	  </div>
	</div>
	<div class="col l6 m12 s12">
		<h4>{{$product->name}}</h4>
		<p>{!! $product->description !!}</p>
		<div id="price">
			<h5>₱ {{$discounted}}.00</h5> 
			<strike>₱ {{$product->original_price}}.00</strike> / {{$product->discount}}% off
		</div>
		@foreach($product->tags()->get() as $tag)
			<a href="{{ route('view_tag',['tag' => $tag->tag]) }}">#{{$tag->tag}} </a> | 
		@endforeach
		<div id="buttons">
			<a class="btn-opt waves-effect yellow darken-1 waves-light btn-flat modal-trigger" href="#addReviews">
	    	<span class="fa fa-star white-text"></span>
	    </a><!-- add reviews -->
	    <button class="btn-opt btn-flat waves-effect waves-light red white-text" onclick="addToFavorite('{{$product->id}}')">
	    	<span class="fa fa-heart"></span>
	    </button>
			<button class="btn-flat light-green waves-effect waves-light white-text" 
		    onclick="addToCart('{{$product->id}}','{{ $product->store->id }}')" id="addCartBtn">
	    	Add to cart
	    </button><!-- add to cart -->
		</div><!-- buttons -->
	</div>
</div>

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
</div><!-- add reviews modal -->

<div class="row" id="reviews">
	<h4>Reviews</h4>
	<div class="col s12">
		<ul class="collection" id="review-collection">
			@foreach($product->reviews()->orderBy('created_at','DESC')->get() as $review)
				<li class="collection-item avatar">
		      @foreach($review->user()->get() as $user)
			      <img src="/storage/images/user_profiles/no-image.jpg" alt="" class="circle">
		      	<span class="title">{{$user->name}} {{$user->lastname}}</span>
		      @endforeach
		      <br>
		      @for($i = 0;$i < $review->rate;$i++)
		      	<span class="fa fa-star yellow-text"></span>
		      @endfor
		      | <small>{{$review->created_at}}</small>
		      <br>
		        {{$review->content}}
		      </p>
			    @Auth
			    	@if($review->user_id == Auth::user()->id)
				      <a href="#!" class="secondary-content" onclick="swal({title:'Review removed',icon:'success'})">
				      	<span class="fa fa-trash red-text"></span>
				      </a>
			      @endif
		      @endguest
		    </li>
			@endforeach
	  </ul>
	</div>
</div><!-- row -->

<link rel="stylesheet" type="text/css" href="{{ asset('css/cards.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/stars.css') }}">
<script type="text/javascript" src="{{ asset('js/reviews.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/store.js') }}"></script>

<style type="text/css">
	#addCartBtn {
		width: 100%;
		margin: 5px;
	}
</style>

@endsection
