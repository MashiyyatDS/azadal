@extends('partials.sidenav_admin')

@section('admin_content')
	<h1>Store requests</h1>
	@foreach($storeRequests as $store)
		<ul>
			<li>{{$store->name}}</li>
			<li><p>{!!$store->description!!}</p></li>
			<li><img src="/storage/images/store_profiles/{{$store->profile}}" width="10%"></li>
			<li>
				<button class="btn-flat red white-text" onclick="refuseStore('{{$store->id}}')">Refuse</button>
				<button class="btn-flat blue white-text" onclick="acceptStore('{{$store->id}}')">Accept</button>
			</li>
		</ul>
	@endforeach
	<script type="text/javascript" src="{{asset('js/admin/admin.js')}}"></script>	
@endsection