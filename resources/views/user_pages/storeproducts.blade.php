@extends('partials.sidenav')

@section('sidenav_content')
	@foreach($mystore as $store)
		@include('user_pages.partial_store_products')
	@endforeach
<div id="editProduct" class="modal modal-fixed-footer">
	<form id="updateProductForm">
  	<div class="modal-content">
      <h4>Edit Product</h4>
      {{ csrf_field() }}
      <div class="product-data">
    		<label class="active">Product name</label>
      	<div class="input-field active">
      		<input type="text" name="name" id="name">
      	</div>
    		<label for="type">Product type</label>
      	<div class="input-field">
      		<input type="text" name="type" id="type">
      	</div>
    		<label for="type">Product description</label>
      	<div class="input-field">
      		<textarea name="description" id="description"></textarea>
      	</div>
    		<label for="quantity">Quanity</label>
      	<div class="input-field">
      		<input type="number" name="quantity" id="quantity">
      	</div>
    		<label for="original_price">Original Price</label>
      	<div class="input-field">
      		<input type="number" name="original_price" id="original_price">
      	</div>
    		<label for="srp">S.R.P</label>
      	<div class="input-field">
      		<input type="number" name="srp" id="srp">
      	</div>
    		<label for="delivery_fee">Delivery fee</label>
      	<div class="input-field">
      		<input type="number" name="delivery_fee" id="delivery_fee">
      	</div>
    		<label for="warranty">Warranty</label>
      	<div class="input-field">
      		<input type="number" name="warranty" id="warranty">
      	</div>
    		<label class="active">Discount</label>
      	<div class="input-field">
      		<input type="number" name="discount" id="discount">
      	</div>
      	<div class="col s12 file-field input-field">
          <div class="btn waves-light waves-effect light-green">
            <span>Image</span>
            <input type="file" name="image[]" multiple>
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
        </div>
        <div class="col s12 input-field"> 
        	<label class="active">Product Categories</label>
          <div class="chips update-category-chips"></div> 
        </div>
        <div class="col s12 input-field">
        	<label class="active">Product Tags</label>
          <div class="chips update-tag-chips"></div> 
        </div>
      </div>
    </div>
    <div class="modal-footer">
    	<button type="submit" class="btn-flat light-green white-text">Save</button>
      <a href="#!" class="modal-action modal-close waves-effect waves-light btn-flat red white-text">Close</a>
    </div>	
	</form>
</div>
<link rel="stylesheet" type="text/css" href="{{ asset('css/user.css') }}">
<script src="{{ asset('js/product.js') }}"></script>

@endsection