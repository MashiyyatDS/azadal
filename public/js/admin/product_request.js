$(document).ready(function(res) {
	getProductRequest();
});

/*================ GET PRODUCT REQUEST ================*/
var productRequestPage = 1;
function getProductRequest() {
	swal({
		content:loader,
		title:"Getting products data...",
		button:false
	});
	$.ajax({
		type:'GET',
		url:url+'/admin/product-request/json'
	}).done(function(res) {
		productRequestPage = productRequestPage + 1;
		swal.close();
		console.log(res);
		for(var x in res.product.data) {
			$('#product-requests').append(`
				<tr id='product-${res.product.data[x].id}' class="product-request">
	        <td>${res.product.data[x].name}</td>
	        <td>₱ ${res.product.data[x].original_price}.00</td>
	        <td>- ${res.product.data[x].discount}% off</td>
	        <td>₱ ${res.product.data[x].delivery_fee}.00</td>
	        <td>
	        	<button class="btn-flat waves-effect waves-light blue white-text">
						  <span class="fa fa-eye"></span> 
						</button>
	        </td>
	        <td>
	        	<button class="btn-flat waves-effect waves-light light-green white-text" onclick="acceptRequest(${res.product.data[x].id})">
						  Accept 
						</button>
						<button class="btn-flat waves-effect waves-light red white-text" onclick="refuseRequest(${res.product.data[x].id})">
						  Refuse 
						</button>
	        </td>
	      </tr>
			`);	
		}
		if (res.product.total > 10) {
      $('#view-more-container').append(`
        <button class="btn-flat waves-effect waves-light white-text blue" id="view-more-products" onclick="viewMoreRequest()">View more</button>
      `);
    }
	}).fail(function(err) {
		console.log(err);
	});
}

/*================ VIEW MORE PRODUCT REQUEST ================*/
function viewMoreRequest() {
	swal({
		content:loader,
		title:"Getting products data...",
		button:false
	});
	$.ajax({
		type:'GET',
		url:url+'/admin/product-request/json?page='+productRequestPage
	}).done(function(res) {
		swal.close();
		productRequestPage = productRequestPage + 1;
		if(jQuery.isEmptyObject(res.product.data)) {
			swal({title:"All products loaded",icon:'info'});
		}
		for(var x in res.product.data) {
			$('#product-requests').append(`
				<tr id="product-${res.product.data[x].id}">
	        <td>${res.product.data[x].name}</td>
	        <td>₱ ${res.product.data[x].original_price}.00</td>
	        <td>- ${res.product.data[x].discount}% off</td>
	        <td>₱ ${res.product.data[x].delivery_fee}.00</td>
	        <td>
	        	<button class="btn-flat waves-effect waves-light blue white-text">
						  <span class="fa fa-eye"></span> 
						</button>
	        </td>
	        <td>
	        	<button class="btn-flat waves-effect waves-light light-green white-text" onclick="acceptRequest(${res.product.data[x].id})">
						  Accept 
						</button>
						<button class="btn-flat waves-effect waves-light red white-text" onclick="refuseRequest(${res.product.data[x].id})">
						  Refuse 
						</button>
	        </td>
	      </tr>
			`);	
		}
		console.log(res);
	}).fail(function(err) {
		console.log(err);
	});
}

/*================ ACCEPT PRODUCT REQUEST ================*/
function acceptRequest(id) {
	swal({
		title: "Are you sure ?",
    text: "Accept Selected Product",
    icon: "warning",
    buttons: true,
    dangerMode: true
	}).then((willAccept) => {
		if(willAccept) {
			$.ajax({
				type:'PUT',
				url:url+'/admin/product-request/accept/'+id,
				data: {
					_token: token
				}
			}).done(function(res) {
				$('.product-request').remove();
				$('#view-more-products').remove();
				getProductRequest();
				Materialize.toast("Product accepted",2000);
			}).fail(function(err) {
				console.log(err);
			});	
		}/*if willAccept*/
	});
}

/*================ REFUSE PRODUCT REQUEST ================*/
function refuseRequest(id) {
	swal({
		title: "Are you sure ?",
    text: "Refuse product request",
    icon: "warning",
    buttons: true,
    dangerMode: true
	}).then((willRefuse) => {
		if (willRefuse) {
			$.ajax({
				type:'PUT',
				url:url+'/admin/product-request/refuse/'+id,
				data: {
					_token: token
				}
			}).done(function(res) {
				$(`#product-${id}`).hide('slow');
				Materialize.toast("Product refused",2000);
			}).fail(function(err) {
				console.log(err);
			});		
		}
	})
}