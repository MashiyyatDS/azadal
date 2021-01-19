$(document).ready(function() {
	getStoreOrders();
});

function getStoreOrders() {
	$.ajax({
		type:'GET',
		url: url+'/orders/json'
	}).done(function(res) {
		console.log(res);
	}).fail(function(err) {
		console.log(err);
	});
}