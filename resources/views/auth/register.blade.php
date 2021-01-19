@extends('layouts.app')

@section('content')
  @include('pages.nav')
  <div class="row">
    <div class="col l6 hide-on-med-and-down left-body center white-text">
      <p class="greetings">Welcome to Azadal</p>
      <p>Buy Items, Create your own Store, Sell your Products</p>
      <a href='#' class="btn-flat waves-effect waves-light orange white-text">Shop Now</a>
    </div>
    <div class="col l6 right-body right">
        <p class="create-account center">Create Account</p>
        <div class="form-container">
          <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row">
              <div class="input-field col l6 s12">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                  @if ($errors->has('name'))
                      <span class="invalid-feedback red-text">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
                <label for="fname">First Name</label>
              </div>
              <div class="input-field col l6 s12">
                <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" required autofocus>
                <label for="lastname">Last Name</label>
                @if ($errors->has('lastname'))
                    <span class="invalid-feedback red-text">
                        <strong>{{ $errors->first('lastname') }}</strong>
                    </span>
                @endif
              </div>
              <div class="input-field col s12">
                <input type="number" name="contact" value="{{ old('contact') }}">
                <label for="contact">Contact</label>
                @if ($errors->has('contact'))
                    <span class="invalid-feedback red-text">
                        <strong>{{ $errors->first('contact') }}</strong>
                    </span>
                @endif
              </div>
              <div class="input-field col s12">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <span class="invalid-feedback red-text">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <label for="email">Email</label>
              </div>
              <div class="input-field col s12">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback red-text">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <label for="password">Password</label>
              </div>
              <div class="input-field col s12">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                <label for="c-password">Confirm Password</label>
              </div>
              <button type="submit" class="btn-flat waves-effect waves-light light-green white-text">Submit</button>
            </div>
          </form>
        </div>
    </div>
  </div>

<footer class="page-footer hide-on-med-and-up">
  <div class="container">
    <div class="row">
      <div class="col l6 s12">
        <h5 class="white-text">Footer Content</h5>
        <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
      </div>
      <div class="col l4 offset-l2 s12">
        <h5 class="white-text">Links</h5>
        <ul>
          <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
          <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
          <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
          <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="footer-copyright">
    <div class="container">
    © 2018 Copyright@Azadal
    </div>
  </div>
</footer>

<style type="text/css">
  html {
    min-height: 100%;
    position: relative;
  }
  nav {
    box-shadow: none;
  }
  body {
    height: 100%;
    width: 100%;
    font-family: Quicksand!important;
  }
  .left-body {
    height:100%;
    position: absolute;
    padding: 0px;
    background: linear-gradient(to bottom, #feccb1 0%,#d37e00 0%,#c12889 100%,#ff6060 100%);
  }
  .left-body:before {
    content: '';
    position: relative;
    bottom: 0px;
    left: 312px;
    height: 100%;
    width: 100%;
    background: url(wave3.png);
    background-size: cover;
    background-repeat: no-repeat;
  }
  .right-body {
    padding: 20px 30px 50px 30px!important;
    z-index: -1;
  }
  .row {
    margin-bottom: 0px!important;
  }
  .greetings {
    font-family: Quicksand;
    font-size: 65px;
    padding-top: 150px;
    margin-bottom: 0px;
  }
  .create-account {
    font-size:50px;
    margin-top: 20px;
  }
  footer {
    position: absolute;
    width: 100%;
  }
</style>  
@endsection