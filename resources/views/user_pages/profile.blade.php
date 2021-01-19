@extends('partials.sidenav')

@section('sidenav_content')
	<div class="row">
		<div class="col s4 m3 l2 profile-row">
			@if(Auth::user()->profile == 'no_image.png')
			<img src="storage/images/user_profiles/no-image.jpg" width="100%" class="profile-photo responsive-img materialboxed">		
			@else
			<img src="storage/images/user_profiles/{{Auth::user()->id}}/{{Auth::user()->profile}}" width="100%" class="profile-photo responsive-img">	
			@endif
		</div>
		<div class="col s8 m9 l10" id="user-details">
			<p class="greet">Hello, {{ Auth::user()->name }} {{ Auth::user()->lastname }}</p>
			<a class="waves-effect waves-light btn-flat modal-trigger light-green white-text" href="#updateProfile" id="updateModal">
				<span class="fa fa-cog"></span> 
			</a>
			<a href="{{ route('mystore') }}" class="waves-effect waves-light btn-flat orange white-text">
				<span class="fa fa-shopping-cart"></span> My Store 
			</a>
		</div>
	</div>

	<div class="row">
		<div class="col l6 m6 s12">
			<button class="btn-large btn-flat waves-light waves-effect light-blue white-text options-btn">
				<span class="fa fa-heart"></span> Favorites
			</button>
		</div>
		<div class="col l6 m6 s12">
			<button class="btn-large btn-flat waves-light waves-effect light-green white-text options-btn">
				<span class="fa fa-heart"></span> Followed Stores
			</button>
		</div>
		<div class="col l6 m6 s12">
			<button class="btn-large btn-flat waves-light waves-effect orange lighten-1 white-text options-btn">
				<span class="fa fa-star"></span> Reviews
			</button>
		</div>
		<div class="col l6 m6 s12">
			<button class="btn-large btn-flat waves-light waves-effect red lighten-1 white-text options-btn">
				<span class="fa fa-shopping-basket"></span> Orders
			</button>
		</div>
	</div>

  <!-- Modal Structure -->
  <div id="updateProfile" class="modal modal-fixed-footer">
  	<form id="update-profile-form" enctype="multipart/form-data">
	    <div class="modal-content">
	      <h4>Account settings</h4>
	      {{ csrf_field() }}
      	<label class="inp-label">First Name</label>
	      <div class="input-field">
	      	<input type="text" name="name" id="firstname">
	      </div>
      	<label class="inp-label">Middle Name</label>
	      <div class="input-field">
	      	<input type="text" name="middlename" id="middlename">
	      </div>
      	<label class="inp-label">Last Name</label>
	      <div class="input-field">
	      	<input type="text" name="lastname" id="lastname">
	      </div>
      	<label class="inp-label">Email</label>
	      <div class="input-field">
	      	<input type="email" name="email" id="email">
	      </div>	
      	<label class="inp-label">Contact</label>
	      <div class="input-field">
	      	<input type="number" name="contact" id="contact">
	      </div>
	      <div class="file-field input-field">
		      <div class="btn waves-light waves-light light-green white-text">
		        <span>File</span>
		        <input type="file" name="profile">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text">
		      </div>
		    </div>
	    </div>
	    <div class="modal-footer">
	    	<button type="submit" class="btn-flat light-green waves-effect waves-light white-text">Save</button>
	      <a class="modal-action modal-close waves-effect waves-light btn-flat red white-text">close</a>
	    </div>
  	</form>
  </div>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/user.css') }}">
  <script type="text/javascript" src="{{ asset('js/user.js') }}"></script>
@endsection
