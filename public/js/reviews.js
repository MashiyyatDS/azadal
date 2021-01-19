$(document).ready(function() {
	$('.carousel').carousel({
  	fullWidth:false,
  	dist:-110,
  	indicators:true
  });
})

$('.rating input').change(function () {
  var $radio = $(this);
  $('.rating .selected').removeClass('selected');
  $radio.closest('label').addClass('selected');
});

$(document).ready(function() {
	$('#reviewsForm').on('submit', function(e) {
		e.preventDefault();
		var data = new FormData(this);
		$.ajax({
			type:'POST',
			url:url+'/product-reviews/create',
			data:data,
      contentType: false,
      cache: false,
      processData: false
		}).done(function(res) {
			$('#noreview').remove();
			$('#content').val('');
			swal({
				title:"Review added",
				icon:'success'
			});
			$('#addReviews').modal('close');	
			var rate = [];
			for(var x = 0;x < res.review.rate;x++) {
				rate.push('<span class="fa fa-star yellow-text"></span>');
			}
			console.log(res)
			$('#review-collection').prepend(`
				<li class="collection-item avatar">
			      <img src="/storage/images/user_profiles/no-image.jpg" alt="" class="circle">
		      	<span class="title">${res.user[0].name} ${res.user[0].lastname}</span>
		      <br>
		      	${rate}
		      	<small>${res.review.created_at}</small>
		      <br>
		        ${res.review.content}
		      </p>
		      <a href="#!" class="secondary-content">
		      	<span class="fa fa-trash red-text"></span>
		      </a>
		    </li>	
			`);
		}).fail(function(err) {
			console.log(err.responseJSON);
			if(err.responseJSON.message=="Unauthenticated.") {
				$('#addReviews').modal('close');
				const login = document.createElement('div');
				login.innerHTML = '<a href="'+url+'/login" class="btn-flat light-blue white-text waves-effect waves-light">Login</a>'
				swal({
					title:"Please login first!",
					icon:"info",
					text:'You must login your account to make reviews',
					content:login
				});
			}
		});
	});
})

function addToFavorite(id) {
	$.ajax({
		url:url+'/favorite/create',
		type:'POST',
		data:{
			_token:token,
			product_id: id
		}
	}).done(function(res) {
		alert(res.message);
		console.log(res);
	}).fail(function(err) {
		console.log(err);
		if(err.responseJSON.message=="Unauthenticated.") {
			$('#addReviews').modal('close');
			const login = document.createElement('div');
			login.innerHTML = '<a href="'+url+'/login" class="btn-flat light-blue white-text waves-effect waves-light">Login</a>'
			swal({
				title:"Please login first!",
				icon:"info",
				text:'You must login your account to make reviews',
				content:login
			});
		}
	});
}