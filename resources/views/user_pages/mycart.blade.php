@extends('partials.sidenav')

@section('sidenav_content')
<div class="row" style="margin-bottom:10px" id="cart-container">

</div>

<div class="row addcheckout">
	<div class="cart-info col l8">
		
	</div>
	<div class="col l4">
		<button class="btn-flat light-green white-text waves-effect waves-light right checkout-btn">Add to checkout</button>
	</div>
</div>


<style type="text/css">
	body {
		background-color: #f7f7f7;
	}
	.view-btn {
		text-align: center;
		width: 100%!important;
		margin:2px!important;
	}
	.card-content {
		text-align: center;
	}
	.cart-item {
		box-shadow: 0px 0px 1px #d4d4d4;
    padding: 10px;
    margin-bottom: 20px;
	}
	.cart-item img {
		max-height: 250px;
	}
	.addcheckout {
    background-color: white;
    box-shadow: 0px 0px 0.5px #b5b5b5;
    position: relative;
	}
	.checkout-btn {
		bottom: 100%;
		margin: 20px 0px;
		height: 70px;
		width: 100%;
	}
	.cart-info p {
		background-color: white;
		border:darkgrey solid .2px;
		font-family: 'Quicksand';
		padding: 15px;
		font-size: 15px!important;
	}
	.cart-item {
		background-color: white;
		padding: 10px!important;
	}
	.cart-item-info {
		border: .5px solid #cacaca;
    border-radius: 5px;
	}
	.remove-btn {
		margin-bottom: 10px;
		width: 100%;
	}
</style>
<script type="text/javascript" src="{{ asset('js/store.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/macy.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/addcheckout.js') }}"></script>
@endsection
