$(document).ready(function(){
	$("#hide-info-card").click(function(){
		$("#info-card-wrap").css({'display': 'none'});
		var d = new Date();
		d.setTime(d.getTime() + (31536000));
		var expires = "expires="+ d.toUTCString();
		console.log("info-card-closed=TRUE;" + expires);
		document.cookie = "info-card-closed=TRUE;" + expires;
	});
});