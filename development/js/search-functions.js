/*
Autofocus search field after opening it
*/

function autoFocusSearchField()
{
	document.getElementById("search-field").focus();

	closeMobileMenu();

	var contentDimmingElement = document.getElementById("dimmer-content");
	contentDimmingElement.className = "dimming-active";
}

function closeMobileSearchField(event)
{
	event.preventDefault();
	document.getElementById('search-box-toggle').checked = false;

	var contentDimmingElement = document.getElementById("dimmer-content");
	contentDimmingElement.className = "";

	document.getElementById("search-field").value = "";
}


// event listeners
document.getElementById("show-search-toggle").addEventListener('click', autoFocusSearchField);
document.getElementById("dimmer-content").addEventListener('click', closeMobileSearchField);
document.getElementById("hide-search-toggle").addEventListener('click', closeMobileSearchField);
