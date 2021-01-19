<table class="responsive-table bordered centered striped">
  <thead>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Owner</th>
      <th>View</th>
      <th>Option</th>
    </tr>
  </thead>

  <tbody id="stores-container">
  	@foreach($stores as $store)
      <tr class="store-data">
      	<td>{{$store->name}}</td>
      	<td>{{$store->email}}</td>
        	@foreach($store->user()->get() as $user)
        		<td>{{$user->name}} {{$user->lastname}}</td>
        	@endforeach
    		<td>
    			<button class="btn-flat green white-text" onclick="viewStore('{{$store->id}}')">View store</button>
    		</td>
      	<td id="buttons-{{$store->id}}">
        	@if($store->status == 'closed')
        		<button class="btn-flat blue white-text" onclick="acceptStore('{{$store->id}}')" id="btn-{{$store->id}}">Re-open store</button>
        	@else
      			<button class="btn-flat orange white-text" onclick="closeStore('{{$store->id}}')" id="btn-{{$store->id}}">Close store</button>
        	@endif<!-- if store status == closed -->	
      	</td>
      </tr>
  	@endforeach
  </tbody>
</table>

@if(count($stores) >= 2)
	<center>
		<button id="showMore" class="btn-flat green white-text waves-effect waves-light" style="margin-top: 20px">
		 Show more
		</button>
	</center>
@endif