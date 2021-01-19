@extends('partials.sidenav')

@section('sidenav_content')

<div id="storeContainer">
	@if($mystore->isEmpty())
		<div id="addStoreModal">
			<a class="waves-effect waves-light btn-flat light-green modal-trigger white-text addstore" href="#addStore" id="addstorebtn">Create Store</a>
		  <div id="addStore" class="modal modal-fixed-footer addstore" enctype="multipart/form-data">
		  	<form id="addStoreForm">
		  		{{ csrf_field() }}
			  	<div class="modal-content">
			      <h4>Create your own store</h4>
			      <div class="input-field">
			      	<label>Store name</label>
			      	<input type="text" name="name" id="store_name">
			      </div>
			      <div class="input-field">
			      	<label>Store description</label>
			      	<textarea name="description" id="store_description" class="materialize-textarea"></textarea>
			      </div>
			      <div class="input-field">
			      	<label>Store email</label>
			      	<input type="email" name="email" id="store_email">
			      </div>
			      <div class="input-field">
			      	<label>Store contact</label>
			      	<input type="number" name="contact" id="store_contact">
			      </div>
			      <div class="file-field input-field">
				      <div class="btn">
				        <span>Profile</span>
				        <input type="file" name="profile">
				      </div>
				      <div class="file-path-wrapper">
				        <input class="file-path validate" type="text">
				      </div>
				    </div>
			    </div>
			    <div class="modal-footer">
			      <a href="#!" class="modal-action modal-close waves-effect waves-light btn-flat ">close</a>
			      <button class="btn-flat waves-light waves-effect light-green white-text" type="submit">Submit</button>
			    </div>	
		  	</form>
		  </div>	
		</div>
	@else
		@foreach($mystore as $store)
			@if($store->status == 'pending')
				<blockquote>
				<img src="/storage/images/store_profiles/{{ $store->profile }}" style="width: 100%;" class="left">
				(Store name: {{ $store->name }}) Store request Waiting for approval....
			</blockquote>
			@elseif($store->status == 'refused')
				<blockquote>
					<span class="fa fa-remove red-text"></span>
					 Store request refused.(Store name: {{ $store->name }})
				</blockquote>
				<form method="POST" action="{{route('deleteStore',['sid' => Crypt::encryptString($store->id)])}}" id="deleteStoreForm">
					<button type="submit">Delete request</button>
					{{csrf_field()}}
				</form>
			@elseif($store->status == 'closed')	
				<blockquote>
					<span class="fa fa-remove red-text"></span>
					 Store was closed.(Store name: {{ $store->name }})
				</blockquote>
			@else
				<div class="row">
					<div class="col l6 s12">
						<img src="/storage/images/store_profiles/{{ $store->profile }}" style="width: 50%;">
					</div>
					<div class="col l6 s12">
						<h4>{{ $store->name }}</h4><hr>
						<p>{!! $store->description !!}</p>
						<h6>Email: {{ $store->email }}</h6>
						<h6>Contact: {{ $store->contact }}</h6>
						<h5>{{ count($store->products()->get()) }} products</h5>
						<a class="waves-effect waves-light btn modal-trigger" href="#updateStore" onclick="findStore('{{ $store->id }}')">Edit store</a>
					</div>
				</div>
			@endif
			<div id="updateStore" class="modal modal-fixed-footer">
				<form id="updateStoreForm" enctype="multipart/form-data">
			    <div class="modal-content">
			    	{{ csrf_field() }}
			      <h4>Update Store</h4>
			      <label>Product name</label>
			      <div class="input-field">
			      	<input type="text" name="name" id="name">
			      </div>
			      <label>Product description</label>
			      <div class="input-field">
			      	<textarea name="description"></textarea>
			      </div>
			      <label>Product email</label>
			      <div class="input-field">
			      	<input type="email" name="email" id="email">
			      </div>
			      <label>Product contact</label>
			      <div class="input-field">
			      	<input type="number" name="contact" id="contact">
			      </div>
			      <div class="file-field input-field">
				      <div class="btn light-green">
				        <span>File</span>
				        <input type="file" name="profile">
				      </div>
				      <div class="file-path-wrapper">
				        <input class="file-path validate" type="text">
				      </div>
				    </div>
			    </div>
			    <div class="modal-footer">
			    	<button class="btn-flat light-green white-text" type="submit">Save</button>
			      <a href="#!" class="modal-action modal-close waves-light waves-green btn-flat red">Close</a>
			    </div>
				</form>
		  </div>

		@endforeach
	@endif
</div><!-- #storeContainer -->
<script type="text/javascript" src="{{ asset('js/store.js') }}"></script>
@endsection
