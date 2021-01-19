@extends('layouts.app')

@section('content')
	<ul id="slide-out" class="side-nav fixed"">
		<li>
			<div class="user-view center" style="height: 120px;">
	      <div class="background">
	      </div>
	      <a href="{{route('root')}}"><span class="grey-text name" style="font-size: 50px;">Azadal</span></a>
	  	</div>
	  </li>
	  <li class="no-padding">
	  	<a href="{{route('admin')}}" class="waves-effect waves-orange">
	  		<i class="fa fa-home" aria-hidden="true"></i>Home
	  	</a>
	  	@if(Auth::user())
		  	@if(Auth::user()->type == 'admin')
		  	<a href="/admin" class="waves-effect waves-orange">
		  		<i class="fa fa-user-circle green-text" aria-hidden="true"></i>Admin Panel
		  	</a>
		  	@endif
	  	@endif
	  	<a href="{{route('profile')}}" class="waves-effect waves-orange">
	  		<i class="fa fa-user-circle green-text" aria-hidden="true"></i>Account
	  	</a>
	  	<a href="{{route('mycart')}}" class="waves-effect waves-orange">
	  		<i class="fa fa-shopping-cart orange-text" aria-hidden="true"></i>My cart
	  	</a>
	  	<a href="{{route('root')}}" class="waves-effect waves-orange">
	  		<i class="fa fa-bookmark blue-text" aria-hidden="true"></i>Item Categories
	  	</a>
	  </li>
	  <li class="no-padding">
	    <ul class="collapsible collapsible-accordion">
	      <li class="bold">
	      	<a class="collapsible-header waves-effect waves-orange active" style="border-top: .1px solid #e0e0e0">
	      		<i class="fa fa-sort-desc" aria-hidden="true"></i>Shop Now
	      	</a>
	        <div class="collapsible-body">
	          <ul>
	            <li>
	            	<a href="{{route('shop')}}">
		            	<i class="fa fa-star orange-text" aria-hidden="true"></i>Items
		            </a>
		          </li>
	            <li>
	            	<a href="{{route('storelist')}}">
	            		<i class="fa fa-list blue-text" aria-hidden="true"></i>Store List
	            	</a>
	            </li>
	          </ul>
	        </div>
	      </li>
	    </ul>
	  </li>
	</ul>

	<div class="body-container">
		<nav class="orange accent-5 profile-nav">
			<a href="{{ route('root') }}" class="btn-flat waves-light waves-effect hide-on-large-only white-text">
				Azadal
			</a>
			<a href="#" data-activates="slide-out" class="btn-flat orange accent-5 button-collapse hide-on-large-only right waves-light waves-effect">
				<i class="fa fa-bars" aria-hidden="true"></i>
			</a>
		</nav>
	  <div class="item-container">
			@yield('shopnav_content')
	  </div>
	  <div class="fixed-action-btn horizontal">
	    <a class="btn-floating btn-large red waves-light waves-effect" href="{{route('shop')}}">
	      <span class="fa fa-shopping-basket"></span>
	    </a>
	  </div>
	</div>

@endsection