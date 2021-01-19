@extends('partials.sidenav')

@section('sidenav_content')

<h1>My orders</h1>
	@foreach($orders as $order)
		<ul>
			<li>{{$order->product->name}}</li>
			<li>{!!$order->product->description!!}</li>
			<li>{{$order->quantity}}</li>
		</ul>
	@endforeach	
@endsection