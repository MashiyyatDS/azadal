<nav class="deep-orange lighten-2">
  <div class="nav-wrapper container">
    <a href="{{ route('root') }}" class="brand-logo">Azadal</a>
    <a href="#" data-activates="mobile-demo" class="button-collapse waves-light waves-effect"><i class="fa fa-bars" aria-hidden="true"></i></a>
    <ul class="right hide-on-med-and-down">
      <li class="waves-effect waves-light"><a href="{{ route('shop') }}">Shop Now</a></li>
      <li class="waves-effect waves-light"><a href="{{ route('mycart') }}">Cart</a></li>
      @guest
        <li class="waves-effect waves-light"><a href="{{ route('login') }}">Login</a></li>
        <li class="waves-effect waves-light"><a href="{{ route('register') }}">Register</a></li>
      @else
        <li class="waves-effect waves-light">
          <a class="dropdown-item" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
      @endguest
    </ul>
    <ul class="side-nav" id="mobile-demo">
      @guest
        <li><a href="{{ route('login') }}" class="waves-effect waves-light">Login</a></li>
        <li><a href="{{ route('register') }}" class="waves-effect waves-light">Register</a></li>
      @else
        <li>
          <a href="#">Show now</a>
        </li>
        <li>
          <a href="{{ route('cart') }}">Cart</a>
        </li>
        <li>
          <a class="dropdown-item" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();" class="waves-effect waves-light">
              {{ __('Logout') }}
          </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
      @endguest
    </ul>
  </div>
</nav>

<style>
  nav {
    box-shadow: none;
  }
</style>
<script type="text/javascript">
  $(document).ready(function() {
    $(".button-collapse").sideNav();
  });
</script>