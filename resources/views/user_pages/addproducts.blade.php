@extends('partials.sidenav')

@section('sidenav_content')

@if($mystore->isEmpty())
  <h5>You must have a store first before selling your products</h5>
  <a href="{{route('mystore')}}" class="btn-flat green waves-effect waves-light white-text">Create Store</a>
@else
  @foreach($mystore as $store)
    <form id="product-form" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="hidden" name="store_id" value="{{ Crypt::encryptString($store->id) }}">
      <div class="row form-container">
        <div class="col l6 m6 s12 input-field">
          <i class="fa fa-pencil prefix" aria-hidden="true"></i>
          <input type="text" name="name" id="product-name">
          <label>Product Name</label>
        </div>
        <div class="col l6 m6 s12 input-field">
          <i class="fa fa-pencil prefix" aria-hidden="true"></i>
          <input type="text" name="type" id="product-type">
          <label>Product Type</label>
        </div>
        <div class="col l6 m6 s12 input-field">
          <i class="fa fa-pencil prefix" aria-hidden="true"></i>
          <input type="number" name="quantity" id="product-quantity">
          <label>Product Quantity</label>
        </div>
        <div class="col l6 m6 s12 input-field">
          <i class="fa fa-pencil prefix" aria-hidden="true"></i>
          <input type="number" name="original_price" id="original-price">
          <label>Product Original Price</label>
        </div>
        <div class="col l6 m6 s12 input-field">
          <i class="fa fa-pencil prefix" aria-hidden="true"></i>
          <input type="number" name="srp" id="product-srp">
          <label>Product SRP</label>
        </div>
        <div class="col l6 m6 s12 input-field">
          <i class="fa fa-pencil prefix" aria-hidden="true"></i>
          <input type="number" name="delivery_fee" id="delivery-fee">  
          <label>Product Delivery Fee</label>
        </div>
        <div class="col l6 m6 s12 input-field">
          <i class="fa fa-pencil prefix" aria-hidden="true"></i>
          <input type="number" name="warranty" id="product-warranty">
          <label>Product Warranty</label> 
        </div>
        <div class="col l6 m6 s12 input-field">
          <i class="fa fa-pencil prefix" aria-hidden="true"></i>
          <input type="number" name="discount" id="product-discount">
          <label>Product Discount</label>
        </div>
        <label>Product Description</label>
        <div class="col s12 input-field">
          <textarea class="materialize-textarea" name="description" id="product-description"></textarea>
        </div>
        <div class="col s12 file-field input-field">
          <div class="btn waves-light waves-effect light-green">
            <span>Product Image</span>
            <input type="file" name="image[]" multiple>
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
        </div>
        <div class="col s12 input-field"> 
          <label>Product Categories</label>
          <div class="chips category-chips"></div> 
        </div>
        <div class="col s12 input-field">
          <label>Product Tags</label>
          <div class="chips tag-chips"></div> 
        </div>
      <button class="btn-flat light-green waves-effect waves-effect white-text right" type="submit">Save Product</button>
      </div>
    </form>
    
  @endforeach
<script src="{{ asset('js/product.js') }}"></script>
<style type="text/css">
  .autocomplete-content {
    position: absolute!important;
    width: 77%!important;
  }
  .form-container {
    border: .5px solid #b5b5b5!important;
    margin: 10px!important;
    padding: 10px!important;
    border-radius: 10px;
  }
</style>
@endif

@endsection
