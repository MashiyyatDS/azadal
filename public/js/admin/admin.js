function closeStore(sid) {
	swal("Loading...",{
		icon:'info'
	});
	$.ajax({
		url:url+'/admin/close-store/',
		type:'PUT',
		data:{
			'_token':token,
			'sid':sid
		}
	}).done(function(res) {
		swal("Closed",'Store is now closed','success');
		$('#btn-'+sid).remove();
		$('#buttons-'+res.store.id).append(`
			<button class="btn-flat blue white-text" onclick="acceptStore('`+res.store.id+`')" id="btn-`+res.store.id+`">
				Re-open store
			</button>
		`);
		console.log(res);
	}).fail(function(err) {
		console.log(err);
	});
}/* close store function */

function refuseStore(sid) {
	swal("Loading...",{
		icon:'info',
		buttons:false
	});
	$.ajax({
		url:url+'/admin/refuse-store',
		type:'PUT',
		data: {
			'_token':token,
			'sid':sid
		}
	}).done(function(res) {
		console.log(res);
	}).fail(function(err) {
		console.log(err);
	});
}/* refuse store function */

function acceptStore(sid) {
	swal("Loading...",{
		icon:'info',
		button:false
	});
	$.ajax({
		url:url+'/admin/accept-store',
		type:'PUT',
		data: {
			'_token':token,
			'sid':sid
		}
	}).done(function(res) {
		swal("Success",'Store is now open','success');
		$('#btn-'+sid).remove();
		$('#buttons-'+res.store.id).append(`
			<button class="btn-flat orange white-text" onclick="closeStore('`+res.store.id+`')" id="btn-`+res.store.id+`">
				Close store
			</button>
		`);
		console.log(res);
	}).fail(function(err) {
		console.log(err);
	});
}/* accept store funciton */

function viewStore(id) {
	swal({title:'Loading...',content:loader,buttons:false});
	$.ajax({
		url:url+'/store/find/id='+id,
		type:'GET'
	}).done(function(res) {
		console.log(res);
		var searchedData = document.createElement('div');
		if(res.store.status == 'closed') {
			searchedData.innerHTML = `
				<img src="/storage/images/store_profiles/${res.store.profile}" width="50%" class="hoverable">
				<h4>${res.store.name}</h4>
				<h6>Owner: ${res.user[0].name} ${res.user[0].lastname}</h6>
				<h6>Contact owner: ${res.user[0].contact}</h6>
				<small>${res.store.description}</small>
				<button class="btn-flat blue white-text" onclick="acceptStore('${res.store.id}')">Re-Open shop</button>
			`;
		}else {
			searchedData.innerHTML = `
				<img src="/storage/images/store_profiles/${res.store.profile}" width="50%" class="hoverable">
				<h4>${res.store.name}</h4>
				<h6>Owner: ${res.user[0].name} ${res.user[0].lastname}</h6>
				<h6>Contact owner: ${res.user[0].contact}</h6>
				<small>${res.store.description}</small>
				<button class="btn-flat orange white-text" onclick="closeStore('${res.store.id}')">Close shop</button>
			`;
		}
		swal({
			content:searchedData
		})
	}).fail(function(err) {
		console.log(err);
	});
}/*view store function */


$(document).ready(function() {
	var page = 2;
	$('#showMore').on('click', function() {
		swal("Loading....",{icon:'info'});
		$.ajax({
			type:'GET',
			url:url+'/store/showmore?page='+page,
		}).done(function(res) {
			swal.close();
			console.log(res.store.data);
			for(var x in res.store.data) {
				if (res.store.data[x].status == 'closed') {
					$('#stores-container').append(`
						<tr class="store-data">
		        	<td>${res.store.data[x].name}</td>
		        	<td>${res.store.data[x].email}</td>
	        		<td>${res.store.data[x].user.name} ${res.store.data[x].user.lastname}</td>	
		      		<td>
			    			<button class="btn-flat green white-text" onclick="viewStore('${res.store.data[x].id}')">View store</button>
			    		</td>
		        	<td id="buttons-${res.store.data[x].id}">
		        		<button class="btn-flat blue white-text" onclick="acceptStore('${res.store.data[x].id}')" id="btn-${res.store.data[x].id}">
		        			Re-open store
		        		</button>
		        	</td>
		        </tr>
					`);	
				}else {
					$('#stores-container').append(`
						<tr class="store-data">
		        	<td>${res.store.data[x].name}</td>
		        	<td>${res.store.data[x].email}</td>
	        		<td>${res.store.data[x].user.name} ${res.store.data[x].user.lastname}</td>	
		      		<td>
			    			<button class="btn-flat green white-text" onclick="viewStore('${res.store.data[x].id}')">View store</button>
			    		</td>
		        	<td id="buttons-${res.store.data[x].id}">
		        		<button class="btn-flat orange white-text" onclick="closeStore('${res.store.data[x].id}')" id="btn-${res.store.data[x].id}">
		        			Close store
	        			</button>
		        	</td>
		        </tr>
					`);
				}
			}/* for var x in res.store.data */
			if(jQuery.isEmptyObject(res.store.data)) {
				swal({title:"All Stores are loaded",icon:'info'});
			}
			page = page + 1;
		}).fail(function(err) {
			console.log(err);
		});
	});/* show more stores */
});/* document.ready | show more stores */

var searchData = "";
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
	$('#search-btn').click(function() {
		swal({
			title:"Search store",
			content:'input'
		}).then((value) => {
			if (value) {
				searchData = value;
				swal({title:'searching...',content:loader});
				$.ajax({
					url:url+`/store/search/${value}`,
					type:'GET'
				}).done(function(res) {
					if(jQuery.isEmptyObject(res.store.data)) {
						swal({title:"No store found",icon:'info'});
					}else {
						if (res.store.total > 5) {
							$('#viewMoreSearch').show();
						}else {
							$('#viewMoreSearch').hide();
						}
						$('.searched').remove();
						for(var x in res.store.data) {
							if (res.store.data[x].status == 'closed') {
								$('#searched-stores-container').prepend(`
									<tr class="store-data searched">
					        	<td>${res.store.data[x].name}</td>
					        	<td>${res.store.data[x].email}</td>
				        		<td>${res.store.data[x].user.name} ${res.store.data[x].user.lastname}</td>	
				        		<td>${res.store.data[x].contact}</td>
					      		<td>
						    			<button class="btn-flat green white-text" onclick="viewStore('${res.store.data[x].id}')">View store</button>
						    		</td>
					        </tr>
								`);	
							}else {
								$('#searched-stores-container').append(`
									<tr class="store-data searched">
					        	<td>${res.store.data[x].name}</td>
					        	<td>${res.store.data[x].email}</td>
				        		<td>${res.store.data[x].user.name} ${res.store.data[x].user.lastname}</td>	
				        		<td>${res.store.data[x].contact}</td>
					      		<td>
					      			<button class="btn-flat green white-text" onclick="viewStore('${res.store.data[x].id}')">View store</button>
					      		</td>
					        </tr>
								`);
							}
						}/* for var x in res.store.data */	
					}/* if no result in search */
					swal.close();
				}).fail(function(err) {
					if(err.status == 404) {
						swal({title:"No store found",icon:'info'})
					}
				});	
			}/* if search has value */
		});
	});/* search store */
});/* document.ready | search store */

$(document).ready(function() {
	var nextPage = 2;
	$('#searchMore').on('click', function() {
		swal({title:'loading...',content:loader});
		$.ajax({
			url:url+'/store/search/'+searchData+'/?page='+nextPage,
			type:'GET',
			dataType:'JSON'
		}).done(function(res) {
			swal.close();
			console.log(res);
			if(jQuery.isEmptyObject(res.store.data)) {
					swal({title:"All store loaded",icon:'info'});
			}else {
				for(var x in res.store.data) {
					if (res.store.data[x].status == 'closed') {
						$('#searched-stores-container').append(`
							<tr class="store-data">
			        	<td>${res.store.data[x].name}</td>
			        	<td>${res.store.data[x].email}</td>
		        		<td>${res.store.data[x].user.name} ${res.store.data[x].user.lastname}</td>	
		        		<td>${res.store.data[x].contact}</td>
			      		<td>
			      			<button class="btn-flat green white-text" onclick="viewStore('${res.store.data[x].id}')">View store</button>
			      		</td>
			        </tr>
						`);	
					}else {
						$('#searched-stores-container').append(`
							<tr class="store-data">
			        	<td>${res.store.data[x].name}</td>
			        	<td>${res.store.data[x].email}</td>
		        		<td>${res.store.data[x].user.name} ${res.store.data[x].user.lastname}</td>
		        		<td>${res.store.data[x].contact}</td>	
			      		<td>
			      			<button class="btn-flat green white-text" onclick="viewStore('${res.store.data[x].id}')">View store</button>
			      		</td>
			        </tr>
						`);
					}
				}/* for var x in res.store.data */	
			}
			nextPage = nextPage + 1;
		}).fail(function(err) {
			console.log(err);
		});
	});
});/* document.ready | show more on */
