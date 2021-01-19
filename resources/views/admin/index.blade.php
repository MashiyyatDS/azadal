@extends('partials.sidenav_admin')

@section('admin_content')
<center><h3>Admin panel</h3></center>
	<div class="row">
		<div class="col l4 m6 s12">
			<div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title center">Stores</span>
          <h4>{{count($stores)}} stores</h4>
        </div>
        <div class="card-action">
          <a href="#" class="btn-flat white-text waves-effect waves-light light-green">View stores</a>
        </div>
      </div>
		</div>
		<div class="col l4 m6 s12">
			<div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title center">Products</span>
          <h4>{{count($products)}} products</h4>
        </div>
        <div class="card-action">
          <a href="#" class="btn-flat white-text waves-effect waves-light light-green">View products</a>
        </div>
      </div>
		</div>
		<div class="col l4 m6 s12">
			<div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title center">Users</span>
          <h4>{{count($users)}} users</h4>
        </div>
        <div class="card-action">
          <a href="#" class="btn-flat white-text waves-effect waves-light light-green">View users</a>
        </div>
      </div>
		</div>
	</div>

<style type="text/css">
	.card-action a {
		width: 100%!important;
		text-align: center;
	}
</style>
@endsection