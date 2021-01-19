@extends('partials.sidenav')

@section('sidenav_content')
	<center>
		<h3>Favorites</h3>

		@foreach($favorites as $favorite)
			<ul>
				<li>{{$favorite->product->name}}</li>
				@foreach($favorite->product->images()->get() as $image)
					<img src="/storage/images/product_images/{{$favorite->product->id}}/{{$image->image}}" width="10%">
				@endforeach
				<li>
					<button class="btn-flat red waves-effect waves-light white-text" onclick="deleteFavorite('{{$favorite->id}}')">
						Delete
					</button>
				</li>
			</ul>
		@endforeach
	</center>

<script type="text/javascript">
	function deleteFavorite(id) {
		$.ajax({
			url:url+'/favorite/delete/'+id,
			type:'DELETE',
			data:{
				_token:token
			}
		}).done(function(res) {
			alert("Deleted");
		}).fail(function(err) {
			console.log(err);	
		});
	}
</script>
@endsection