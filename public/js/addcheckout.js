var totalPrice = [];
var totalShipping = [];
var loader = document.createElement('div');
loader.innerHTML = `
	<div class="preloader-wrapper big active">
    <div class="spinner-layer spinner-blue-only">
      <div class="circle-clipper left">
        <div class="circle"></div>
      </div><div class="gap-patch">
        <div class="circle"></div>
      </div><div class="circle-clipper right">
        <div class="circle"></div>
      </div>
    </div>
  </div>	
`;

$(document).ready(function() {
	getCarts();
});

function getCarts() {
	swal({
    title:"Getting Carts Data",
    content:loader,
    button:false
  });
	$.ajax({
		type:'GET',
		url:url+'/cart/mycart/json'
	}).done(function(res) {
		if (res.total == 0) {
			swal({
				title: "No items on cart",
				icon: 'warning'
			})
			$('.checkout-btn').addClass('disabled');
		}else {
			swal.close();
			console.log(res);
			for(var x in res.carts) {
				$('#cart-container').append(`
					<div class="col l12 cart-item" id="cart-${res.carts[x].id}">
						<div class="col l4">
							<img src="/storage/images/product_images/${res.carts[x].product.id}/${res.carts[x].product.images[0].image}">
						</div>
						<div class="col l4">
							<p>${res.carts[x].product.name}</p>
							<p>${res.carts[x].product.description}</p>
						</div>
						<div class="col l4 cart-item-info">
							<p>
								Store name: <span class="right">${res.carts[x].store.name}</span><br>
								Original price: <span class="right">₱ ${res.carts[x].product.original_price.toLocaleString()}.00</span><br>
								Discount: <span class="right">${res.carts[x].product.discount}% off</span><br>
								Quantity: <span class="right">${res.carts[x].quantity} pcs</span><br>
								Delivery Fee: <span class="right">₱ ${res.carts[x].product.delivery_fee.toLocaleString()}.00 </span><br>
							</p>
							<button class="btn-flat waves-effect waves-light red white-text remove-btn" onclick="removeCart('${res.carts[x].id}')">
								Remove
							</button>
						</div>
					</div>
				`).fadeIn();
				totalPrice.push(res.carts[x].product.original_price * res.carts[x].quantity);
				totalShipping.push(res.carts[x].product.delivery_fee);
			}/* append carts in cart container */
			const sumOfTotalPrice = totalPrice.reduce(add);
			const sumOfTotalShippingFee = totalShipping.reduce(add);
			
			$('.cart-info').append(`
				<p id="cart-info">
					Items total: <span class="right">${res.total} item/s</span><br>
					Items price: <span class="right">₱ ${sumOfTotalPrice.toLocaleString()}.00</span><br>
					Delivery fee: <span class="right">₱ ${sumOfTotalShippingFee.toLocaleString()}.00 </span><br>
					<b><i>Total price:</i></b> <span class="right orange"><b>₱ ${(sumOfTotalPrice + sumOfTotalShippingFee).toLocaleString()}.00</b></span>
				</p> 
			`);/* total price append */
		}/* if cart is empty */

	}).fail(function(err) {
		console.log(err);
	});
}

function add(accumulator, a) {
	return parseInt(accumulator) + parseInt(a);
}

function addcheckout($id,$cart) {
	$.ajax({
		type:'POST',
		url:url+'/checkout/validate_checkout',
		data: {
			product_id: $id,
			cart_id: $cart,
			_token:token
		}
	}).done(function(res) {
		$('#checkout-'+$id).remove();
		$('#buttons-'+$id).prepend(`
			<button class="btn-flat waves-light waves-effect orange darken-4 white-text view-btn">undo</button>
		`);
		console.log(res);
		swal({
			title:"Added to checkout!",
			icon:'success'
		});
		totalPrice.push(res.total_price);
	}).fail(function(err) {
		console.log(err)
	});
}

$(document).ready(function() {
	$('.carousel.carousel-slider').carousel({fullWidth: true});
	$('#checkOutBtn').on('click', function() {
		console.log(totalPrice)
		const sum = totalPrice.reduce(add);
		function add(accumulator, a) {
			return parseInt(accumulator) + parseInt(a);
		}
		swal({
			title:"Total price: ₱"+sum+".00",
			icom:'info'
		})
	});
});

function findProduct(id) {
	$.ajax({
		type:'GET',
		url:url+'/product/find/id='+id
	}).done(function(res) {
		var description = document.createElement(`div`);
		description.innerHTML = `
			<div id="product-images"></div>
			<p>`+res.product.description+`</p>
			<ul>
				<li>Original price: ₱ `+ res.product.original_price  +`.00</li>
				<li>Warranty: `+res.product.warranty+` days warranty</li>
				<li>₱ `+res.product.delivery_fee+`.00 delivery fee</li>
				<li>`+res.product.quantity+` pcs available</li>
			</ul>
		`;
		swal({
			title:res.product.name,
			content:description
		});
		console.log(res);
	}).fail(function(err) {
		console.log(er)
	});
}

function removeCart($id) {
	swal({
		title: "Are you sure ?",
		text: "The selected product will be deleted",
		icon: "warning",
		buttons: true,
		dangerMode: true
	}).then((willDelete) => {
		if(willDelete) {
				$.ajax({
					url:url+'/cart/destroy/'+$id,
					type:'DELETE',
					data: {
						'_token':token
					}
				}).done(function(res) {
					$('#cart-'+$id).fadeOut('slow',function() {
						$(this).remove();
					});
					swal("Product removed to cart",{ icon:"success" });
					console.log(res)
					$('#cart-info').remove();
					$('.cart-item').remove();
					getCarts();
				}).fail(function(err) {
					console.log(err);
					Materialize.toast("Failed",1000,'red');
				});
		}else {

		}/* if Willdelete*/
	});	
}