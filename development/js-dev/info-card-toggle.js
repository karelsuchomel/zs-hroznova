$(document).ready(function(){
	$("#hide-info-card").click(function(){
		var cardHeight = $("#info-card-wrap").outerHeight()
		var translateBy = "translate3d(0,-" + (cardHeight + 34) + "px,0)";

		$("#content").css({'transform': translateBy});
		$("#content").css({'transition': '0.5s'});

		setTimeout(function(){
			$("#content").css({'transition': '0s'});
			$("#content").css({'transform': 'translate3d(0,0,0)'});
			$("#info-card-wrap").css({'display': 'none'});
			$("#show-info-card").css({
				'display': 'block',
				'transform': 'translate3d(0,-50px,0)',
				'opacity': 0
			});
		}, 501);

		setTimeout(function(){
			$("#show-info-card").css({
				'transform': 'translate3d(0,0px,0)',
				'opacity' : 1
			});
		}, 520);

		var d = new Date();
		d.setTime(d.getTime() + (31536000));
		var expires = "expires="+ d.toUTCString();
		document.cookie = "info-card-closed=TRUE;" + expires + ";path=/";
	});

	$("#show-info-card").click(function(){
		// TODO - Ajax?

		$("#info-card-wrap").css({'display': 'block'});

		var cardHeight = $("#info-card-wrap").outerHeight()
		var translateBy = "translate3d(0,-" + (cardHeight + 35) + "px,0)";

		$("#content").css({'transform': translateBy});

		setTimeout(function(){
			$("#content").css({'transition': '0.5s'});
			$("#content").css({'transform': 'translate3d(0,0,0)'});
			$("#show-info-card").css({'opacity': 0});
		}, 20);

		setTimeout(function(){
			$("#content").css({'transition': '0s'});
			$("#show-info-card").css({'display': 'none'});
		}, 530);

		var d = new Date();
		d.setTime(d.getTime() + (31536000));
		var expires = "expires="+ d.toUTCString();
		document.cookie = "info-card-closed=FALSE;" + expires + ";path=/";
	});
});