@extends('partials.sidenav_admin')

@section('admin_content')

  <div class="row">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s5"><a href="#test3">Store list</a></li>
        <li class="tab col s5"><a href="#test4">Search store</a></li>
      </ul>
    </div>
    <div id="test3" class="col s12">
    	@include('admin.partial_store_list')
    </div>

    <div id="test4" class="col s12">
  		@include('admin.partial_store_search')
    </div>
  </div>
<style type="text/css">
  table{
    margin-top: 10px;
    box-shadow: 0px 0px 0.1px grey;  
  }
</style>
	<script type="text/javascript" src="{{asset('js/admin/admin.js')}}"></script>
@endsection