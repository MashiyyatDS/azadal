var id = 0;
var token = $('input[name=_token]').val();
var url = location.protocol +'//'+location.host;
$(document).ready(function() {
	$('ul.tabs').tabs();
  $(".button-collapse").sideNav();
  $('.carousel').carousel({
  	fullWidth:true
  });
  $('.modal').modal();
});