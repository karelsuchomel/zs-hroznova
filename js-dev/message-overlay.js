// function fnc() {

// }

// // Event listeners
// window.onload = function() {
//   // Open messages
//   if(document.getElementsByClassName("button")){
//     document.getElementById("button").addEventListener("click", fnc);
//   }
// };

// Toggle menu-side-list
$(document).ready(function(){
	$("ul#menu-bocni-seznam li").click(function(){
		var list = $(this).children("ul");
		if(list.hasClass("open")){
			list.removeClass("open");
		} else {
			list.addClass("open");
		}
	});


// Styles for menu-top-bar with edookit content
	$("ul#menu-horni-lista li a:contains('edookit')").addClass("edookit-icon");
	
});
