@extends('layouts.app')
@section('content')
  @include('pages.nav')
  <div class="row">
  	<div class="col offset-l4 l4 offset-m2 m8 s12 left-body">
  		<div class="login-form">
  			<div class="login-title center">
  				<p>Login</p>
  			</div>
  			<form method="POST" action="{{ route('login') }}">
  				@csrf
  				<div class="row form-inputs">
  					<div class="col s12 input-field">
  						<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
  						<label>Email</label>
              @if ($errors->has('email'))
                  <span class="invalid-feedback red-text">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
  					</div>
  					<div class="col s12 input-field">
  						<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
  						<label>Password</label>
              @if ($errors->has('password'))
                  <span class="invalid-feedback red-text">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif
  					</div>
  					<p>
  						<input class="filled-in" type="checkbox" id="filled-in-box" name="remember" {{ old('remember') ? 'checked' : '' }}>
  						<label for="filled-in-box">Remember me</label>
				    </p>
  					<button type="submit" class="btn-flat waves-light waves-effect light-green white-text login-btn">Login</button>
  					<a href="#">Forgot Password?</a>
  				</div>	
  			</form>
  		</div>
  	</div>
  </div>

<style type="text/css">
	html {
		min-height: 100%;
		min-width: 100%;
	}
	body {
		height: 100%;
		font-family: Quicksand;
		width: 100%;
	}
	.left-body {
		position: absolute;
		height: 100%;
		width: 100%;
	}
	.login-btn {
		width: 100%;
	}
	.login-form {
    padding: 0px 0px 20px 0px;
    margin-bottom: 50px;
    box-shadow: inset 0px 0px 1px 0px #060606;
    margin-top: 70px;
	}
	.login-title {
		background: linear-gradient(to bottom, #feccb1 0%,#d37e00 0%,#c12889 100%,#ff6060 100%);
    padding: 1px 0px 1px 0px;
    position: relative;
	}
	.login-title:before {
		content: '';
    position: absolute;
    left: .6px;
    bottom: 0;
    height: 80px;
    width: 99.6%;
    background: url(images/wave-mobile.png);
    background-size: cover;
    background-repeat: no-repeat;
	}
	.login-title p {
		font-size:50px;
		color:white;
	}
	.form-inputs {
		padding: 20px;
	}
	footer {
		position: absolute;
    font-family: Quicksand;
    width: 100%;
    top: 100%;
	}
</style>  

<script>
	$(document).ready(function() {
		$(".button-collapse").sideNav();
	});
</script>
@endsection

