@extends('partials.sidenav_admin')

@section('admin_content')

<div class="row">
  <div class="col s12">
    <ul class="tabs">
      <li class="tab col s3"><a class="active" href="#test1">Product List</a></li>
      <li class="tab col s3"><a href="#test2">Search Product</a></li>
    </ul>
  </div>
  <div id="test1" class="col s12">
    <table class="responsive-table bordered centered striped">
      <thead>
        <tr>
            <th>Name</th>
            <th>Original Price</th>
            <th>Discount</th>
            <th>Delivery Fee</th>
            <th>Store Name</th>
            <th>Options</th>
        </tr>
      </thead>

      <tbody id="product-container">

      </tbody>
    </table>
    <div id="view-more-container" style="margin-top: 10px" class="center">

    </div>
  </div>
  <div id="test2" class="col s12">
    <br>
    <center>
      <button class="btn-flat waves-effect waves-light light-green white-text" id="search-product-list">
        Search Product
      </button>  
    </center>

    <table class="responsive-table bordered centered striped">
      <thead>
        <tr>
            <th>Name</th>
            <th>Original Price</th>
            <th>Discount</th>
            <th>Delivery Fee</th>
            <th>Store Name</th>
            <th>Options</th>
        </tr> 
      </thead>

      <tbody id="searched-product-container">

      </tbody>
    </table>
    <div id="view-more-search-list" class="center" style="margin-top: 10px;">
      
    </div>
  </div>
</div>  


<script type="text/javascript" src="{{asset('js/admin/admin.js')}}"></script>
<script type="text/javascript" src="{{asset('js/admin/product_list.js')}}"></script>
@endsection