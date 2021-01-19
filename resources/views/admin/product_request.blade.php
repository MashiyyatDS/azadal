@extends('partials.sidenav_admin')

@section('admin_content')
{{ csrf_field() }}

<table class="responsive-table bordered centered striped">
  <thead>
    <tr>
        <th>Name</th>
        <th>Original Price</th>
        <th>Discount</th>
        <th>Delivery Fee</th>
        <th>View</th>
        <th>Option</th>
    </tr>
  </thead>

  <tbody id="product-requests">

  </tbody>
</table>
<div id="view-more-container" style="margin-top: 10px" class="center">

</div>


<script type="text/javascript" src="{{asset('js/admin/admin.js')}}"></script>
<script type="text/javascript" src="{{asset('js/admin/product_request.js')}}"></script>
@endsection