@extends('partials.shopnav')

@section('shopnav_content')

<center>
	<b style="font-size: 50px;">Store List</b>
</center>
<div id="macy">
	@foreach($stores as $store)
		<div class="box">
			<div class="card">
        <div class="card-image">
					<img src="/storage/images/store_profiles/{{ $store->profile }}" style="width: 100%;" class="materialboxed">
        </div>
        <div class="card-content center">
          <p>{{$store->name}}</p>
          <small>{{count($store->products()->get())}} Products</small>
        </div>
        <div class="card-action">
          <a href="#" class="btn-flat waves-effect waves-light light-blue white-text">View Store</a>
        </div>
      </div>
		</div>
	@endforeach
</div>

<center>
	{{ $stores->links() }}
</center>
	



<script type="text/javascript" src="{{ asset('js/macy.js') }}"></script>
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

<style type="text/css">
	.card-action a {
		width: 100%!important;
	}
	.card {
    text-align: center;
    padding: 20px;
    box-shadow: -1px -1px 3px 0px #f3f3f3;
    margin: 2px 5px;
	}
	#macy {
		padding: 10px;
	}
</style>
@endsection
