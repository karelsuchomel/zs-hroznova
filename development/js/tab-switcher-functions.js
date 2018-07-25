/*
toggle tabs for posts and agenda (found on the homepage in mobile view)
*/

function switchToPostsTab (e)
{
	e.currentTarget.className = "tab-button opened";
	document.getElementById("agenda").className = "tab-button";
	document.getElementById("posts-wrap").style.display = 'block';
	document.getElementById("agenda-list-wrap").style.display = 'none';
}

function switchToAgendaTab (e)
{
	e.currentTarget.className = "tab-button opened";
	document.getElementById("posts").className = "tab-button";
	document.getElementById("posts-wrap").style.display = 'none';
	document.getElementById("agenda-list-wrap").style.display = 'block';
}

// add event listeners
document.getElementById("posts").addEventListener("click", switchToPostsTab);
document.getElementById("agenda").addEventListener("click", switchToAgendaTab);