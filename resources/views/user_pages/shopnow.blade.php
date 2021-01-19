@extends('partials.shopnav')

@section('shopnav_content')
<center>
	<b style="font-size: 50px;">Items</b>
</center>

	<div class="gallery-container" style="padding: 10px">
		<div id="macy">
			@foreach($products as $product)
				<div class="box">
					<div class="card">
			      <div class="card-image" id="image-container-{{$product->id}}">
							@foreach($product->images()->limit(1)->get() as $image)
								<img src="/storage/images/product_images/{{$product->id}}/{{$image->image}}" width="100%" class="materialboxed">
							@endforeach
			      </div>
			      <div class="card-stacked">
			        <div class="card-content">
			          <p>{{ $product->name }}.</p>
			          <p>₱ {{$product->original_price}}.00</p>
			        </div>
			        <div class="card-action">
			          <a href="/shopnow/product/sid={{Crypt::encryptString($product->id)}}" class="btn-flat light-green waves-effect waves-light white-text card-btn" target="_blank">View</a>
			        </div>
			      </div>
			    </div>
				</div>
			@endforeach		
		</div>	
	</div><!-- row-gallery-container -->

	<center>
		{{ $products->links() }}
	</center>

<script type="text/javascript" src="{{ asset('js/shopnow.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/macy.js') }}"></script>

<style type="text/css">
	.image-container {
		height: 300px;
		position: relative;
		overflow: hidden;
	}
	.image-product {
		height: 100%;
		position: absolute;
	}
	.card-btn {
		text-align: center;
		width: 100%!important;
	}
	.card {
		text-align: center;
		box-shadow: 0px 0px .1px #a5a5a5;
	}
</style>


<script>
	var macy = Macy({
		container: '#macy',
		trueOrder: false,
		waitForImages: true,
		margin:5,
		columns:4,
		breakAt: {
			1200: 3,
			940: 3,
			520: 2,
			400: 2
		}
	});
</script>
@endsection
