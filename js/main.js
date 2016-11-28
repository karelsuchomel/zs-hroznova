// function fnc() {

// }

// // Event listeners
// window.onload = function() {
//   // Open messages
//   if(document.getElementsByClassName("button")){
//     document.getElementById("button").addEventListener("click", fnc);
//   }
// };


$(document).ready(function(){
	$("ul#menu-bocni-seznam li").click(function(){
		var list = $(this).children("ul");
		if(list.hasClass("open")){
			list.css("max-height", "0px");
			list.removeClass("open");
		} else {
			list.css("max-height", "500px");
			list.addClass("open");
		}
	});
});