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
// Toggle menu-side-list
$(document).ready(function(){
	// menu-side-list roll toggle
	$("ul#menu-bocni-seznam li").click(function(){
		var list = $(this).children("ul");
		if(list.hasClass("open")){
			list.removeClass("open");
			list.css('height', '0px');
		} else {
			// close other unrolled menus
			var other = $("ul#menu-bocni-seznam li ul.open");
			other.removeClass("open");
			other.css('height', '0px');

			// open menu
			list.addClass("open");
			var numOfItems = list.children().length;
			var sum = 0;
			for(var i = 0; i < numOfItems; ++i){
				sum += list.children().eq(i).outerHeight();
			}
			list.css('height', sum + 'px');
		}
	});

	// menu-side-list current-menu-item
	var selectedItem = $("ul#menu-bocni-seznam li ul li.current-menu-item");
	if(selectedItem){
		var list = selectedItem.parent();
		selectedItem.parent().css('transition', '0s');
		selectedItem.parent().addClass("open");
		var numOfItems = list.children().length;
		var sum = 0;
		for(var i = 0; i < numOfItems; ++i){
			sum += list.children().eq(i).outerHeight();
		}
		list.css('transition', '0s');
		list.css('height', sum + 'px');

		setTimeout(function(){ 
			list.css('transition', '0.5s');
			selectedItem.parent().css('transition', '0.5s');
		}, 100);
	}

	// menu-side-list close when clicked on dimmer-content
	$("#dimmer-content").click(function(){
		$("#toggle-menu-checkbox").prop('checked', false);
	});

	// TODO - This is slow and results in menu glitching around,
	// replace with CSS
	// Styles for menu-top-bar with edookit content
	$("ul#menu-horni-lista li a:contains('edookit')").prepend("<div id='edookit-icon'></div>");

	// Make menu-side-list as heigh as #content
	var contentHeight = $("#content").outerHeight();
	console.log(contentHeight);
	$("#side-list").css('height', contentHeight + 'px');
	
});

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