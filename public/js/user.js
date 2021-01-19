$(document).ready(function() {
	$('#update-profile-form').on('submit', function(e) {
		var formData = new FormData(this);
		e.preventDefault();
		$.ajax({	
      url: url+'/profile/update',
      method:'POST',
      data: formData,
      headers: { 'X-CSRF-TOKEN': token },
			dataType: 'JSON',
			contentType: false,
			cache: false,
			processData: false
		}).done(function(res) {
			swal("Success","Profile updated","success");
			$('.profile-photo').remove();
			$('.greet').remove();
			$('#user-details').prepend(`
				<p class="greet">Hello, `+ res.name +` `+ res.lastname +`</p>
			`);
			$('.profile-row').append(`
				<img src="storage/images/user_profiles/`+res.id+`/`+res.profile+`" width="100%" class="profile-photo responsive-img">	
			`);
			$('#updateProfile').modal('close');
			console.log(res);
		}).fail(function(err) {
			swal({
				title:"Failed",
				text:"Please fill up all required fields",
				icon:"error"
			});
			for(var x in err.responseJSON.errors) {
				Materialize.toast(err.responseJSON.errors[x],10000,'red');
			}
		});
	})

	$('#updateModal').on('click', function() {
		$.ajax({
			type:'GET',
			url:url+'/profile/json'
		}).done(function(res) {
			$('#firstname').val(res.account.name);
			$('#middlename').val(res.account.middlename);
			$('#lastname').val(res.account.lastname);
			$('#email').val(res.account.email);
			$('#contact').val(res.account.contact);
		}).fail(function(err) {
			console.log(err);
		})
	});

});/*document.ready*/