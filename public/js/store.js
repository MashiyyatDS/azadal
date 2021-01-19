tinymce.init({
  selector:'textarea',
  height:250,
  width:'100%',
  theme:'modern',
  resize:false,
  plugins: "link image code fullscreen paste",
});

function addToCart(prod_id,store_id) {
	swal("Enter Quantity",{
		content:'input',
	}).then(($value) => {
		if($value) {
			$.post(url+'/cart/create', {
				'product_id':prod_id,
				'store_id':store_id,
				'quantity':$value,
				'_token':$('input[name=_token]').val()
			}).done(function(res) {
				console.log(res);
				swal({
					title:res.message,
					icon:res.icon
				});
				if(res.status == "success") {
					$('#addCartBtn').remove();
					$('#buttons').prepend(`
						<button class="btn-flat waves-light waves-effect disabled">
			  			<span class="fa fa-shopping-cart"></span>
			  		</button>
					`);	
				}
			}).fail(function(err) {
				console.log(err);
				for(var x in err.responseJSON.errors){
					Materialize.toast(err.responseJSON.errors[x],10000,'red');
				}
				if(err.responseJSON.message == "Unauthenticated.") {
					swal("Unauthenticated","Please login first",'info');
				}else {
					// console.log(err);
				}
			});	
		}
	});
}

$(document).ready(function(e) {
	$('#addStoreForm').on('submit', function(e) {
		e.preventDefault();
		$.ajax({
			url: url+'/store/create',
			method: 'POST',
			data: new FormData(this),
			dataType: 'JSON',
			contentType: false,
			cache: false,
			processData: false
		}).done(function(res) {
			$('#addStore').modal('close');
			$('#addStoreModal').remove();
			Materialize.toast("Store request sent",1000,'light-green');
			$('#storeContainer').append(`
				<blockquote>
					(Store name: `+ res.name +`) Store request Waiting for approval....
				</blockquote>
				<img src="/storage/images/store_profiles/`+ res.profile +`" style="width: 10%;">
			`);
			console.log(res);
		}).fail(function(err) {
			Materialize.toast("Failed to create store",1000,'red');
			console.log(err);
		});
	});

});

$(document).ready(function() {
	$('#updateStoreForm').on('submit', function(e) {
		e.preventDefault();
		var storeData = new FormData(this);
		$.ajax({
			url:url+'/store/update/'+id,
			type:'POST',
			data: storeData,
			dataType: 'JSON',
			contentType: false,
			cache: false,
			processData: false
		}).done(function(res) {
			Materialize.toast("Success");
			console.log(res);
		}).fail(function(err) {
			Materialize.toast("Failed");
			console.log(err);
		});
	});
});

function findStore($id) {
	$.ajax({
		url:url+'/store/find/id='+$id,
		type:'GET'
	}).done(function(res) {
		console.log(res);
		id = res.store.id;
		$('#name').val(res.store.name);
		$('#contact').val(res.store.contact);
		$('#email').val(res.store.email);
		$(tinymce.get('description').getBody()).html(res.store.description);
	}).fail(function(err) {
		console.log(err);
	});
}