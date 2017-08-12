$(document).ready(function(){
	$("#posts.tab-button").click(function(){
		$(this).addClass("opened");
		$("#agenda.tab-button").removeClass("opened");
		$("#posts-wrap").css({'display': 'block'});
		$("#agenda-list-wrap").css({'display': 'none'});
	});

	$("#agenda.tab-button").click(function(){
		$(this).addClass("opened");
		$("#posts.tab-button").removeClass("opened");
		$("#posts-wrap").css({'display': 'none'});
		$("#agenda-list-wrap").css({'display': 'block'});
	});
});