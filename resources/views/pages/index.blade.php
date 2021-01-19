<link rel="stylesheet" type="text/css" href="{{ asset('css/index.css') }}">
@extends('layouts.app')
@section('content')
<ul class="side-nav" id="mobile-demo">
	<li class="side-nav-cover">
		<a href="{{route('shop')}}" class="btn-flat white-text waves-effect waves-light orange accent-5 shop-now-btn">SHOP NOW</a>
	</li>
	@guest
	  <li><a href="{{ route('login') }}">Login</a></li>
	  <li><a href="{{ route('register') }}">Register</a></li>
	@else
		<li><a href="{{ route('profile') }}">Profile</a></li>
		<li>
      <a class="dropdown-item" href="{{ route('logout') }}"
         onclick="event.preventDefault();document.getElementById('logout-form').submit();">
          {{ __('Logout') }}
      </a>
    </li>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
	@endguest
</ul>

<div class="header">
	<div class="buttons right">
		<a href="#" data-activates="mobile-demo" class="right button-collapse hide-on-med-and-up btn-flat orange accent-5 waves-light waves-effect white-text">
			<i class="fa fa-bars" aria-hidden="true"></i>
		</a>
		<a href="{{ route('mycart') }}" class="btn-flat orange accent-5 waves-light waves-effect white-text tooltipped" data-delay="50" data-tooltip="Cart">
			<i class="fa fa-shopping-cart fa-5x" aria-hidden="true"></i>
		</a>
		@guest
			<a href="{{ route('login') }}" class="btn-flat orange accent-5 waves-effect waves-light white-text hide-on-small-only">Login</a>
			<a href="{{ route('register') }}" class="btn-flat orange accent-5 waves-effect waves-light white-text hide-on-small-only">Register</a>
		@else
			<a href="{{ route('profile') }}" class="btn-flat orange accent-5 waves-effect waves-light white-text hide-on-small-only">
				<i class="fa fa-user-circle fa-5x" aria-hidden="true"></i>
			</a>
		  <a href="{{ route('logout') }}" class="btn-flat orange accent-5 waves-effect waves-light white-text hide-on-small-only" onclick="event.preventDefault();
         document.getElementById('logout-form').submit();">Logout
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	      @csrf
	    </form>
		@endguest
	</div>
	<div class="greetings">
		<div class="row">
			<div class="col l6 greets">
				<p class="greet-title">Azadal</p>
				<p class="greet-content">Buy Items, Create your own Store, Sell your Products</p>
				<a href="{{route('shop')}}" class="btn-flat orange accent-5 waves-light waves-effect white-text center hide-on-small-only">Shop Now</a>
			</div>
		</div>
	</div>
</div>
<div class="header2">
	<div class="row azadal-headers">
		<div class="col l6">
			<i class="fa fa-shopping-basket fa-5x blue-text" aria-hidden="true" style="font-size: 150px"></i>
			<h3>Create your Own Store</h3><hr>
			<p class="">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			</p>
		</div>
		<div class="col l6">
			<i class="fa fa-money fa-5x green-text" aria-hidden="true" style="font-size: 150px;"></i>
			<h3>Sell Your Products</h3><hr>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		</div>
		<div class="col offset-l4 l4">
			<i class="fa fa-shopping-cart fa-5x orange-text" aria-hidden="true" style="font-size: 150px"></i>
			<h3>Buy Items</h3><hr>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	</div>
</div>

<footer class="page-footer deep-orange lighten-1">
  <div class="container">
    <div class="row">
      <div class="col l6 s12">
        <h5 class="white-text">Azadal</h5>
        <p class="grey-text text-lighten-4">This web app is for presentation purposes only</p>
      </div>
      <div class="col l4 offset-l2 s12">
        <h5 class="white-text">Links</h5>
        <ul>
          <li><a class="grey-text text-lighten-3" href="#!">Facebook</a></li>
          <li><a class="grey-text text-lighten-3" href="#!">Twitter</a></li>
          <li><a class="grey-text text-lighten-3" href="#!">Instagram</a></li>
          <li><a class="grey-text text-lighten-3" href="#!">Gmail</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="footer-copyright black">
    <div class="container">
    © 2019 Copyright Azadal
    </div>
  </div>
</footer>

<script type="text/javascript">
	$(document).ready(function() {
		$(".button-collapse").sideNav();
	});
</script>

@endsection