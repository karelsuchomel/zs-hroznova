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
});
