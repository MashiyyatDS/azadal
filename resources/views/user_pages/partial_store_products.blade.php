<table class="responsive-table bordered centered striped">
  <thead>
    <tr>
      <th>Status</th>
      <th>Name</th>
      <th>Original Price</th>
      <th>Stock</th>
      <th>Discount</th>
      <th>View</th>
      <th>Option</th>
    </tr>
  </thead>

  <tbody>
    @foreach($store->products as $product)
    <tr>
      <td>
        <div class="switch">
          <label>
            Disable
            <input type="checkbox" checked>
            <span class="lever"></span>
            Active
          </label>
        </div>
      </td>
    	<td>{{ $product->name }}</td>
    	<td>₱ {{ $product->original_price }}.00</td>
      <td>{{$product->quantity}} pcs</td>
      <td>-{{$product->discount}}%</td>
    	<td>
    		<button class="btn-flat waves-effect waves-light blue white-text" onclick="viewProduct('{{$product->id}}')">
    			<span class="fa fa-eye"></span>
    		</button>
    	</td>
    	<td>
    		<button class="btn-flat waves-effect waves-light red white-text" onclick="deleteProduct('{{ $product->id }}')">
    			<span class="fa fa-trash"></span>
    		</button>
        <a class="btn-flat btn waves-effect waves-light green white-text modal-trigger" href="#editProduct" onclick="findProduct('{{ $product->id }}')">
          <span class="fa fa-pencil"></span>
        </a>
    	</td>
    </tr>
    @endforeach
  </tbody>
</table>