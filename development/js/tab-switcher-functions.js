/*
toggle tabs for posts and agenda (found on the homepage in mobile view)
*/

function switchToPostsTab (e)
{
	e.currentTarget.className = "tab-button opened";
	document.getElementById("agenda").className = "tab-button";
	document.getElementById("posts-wrap").style.display = 'block';
	document.getElementById("agenda-container").style.display = 'none';
}

function switchToAgendaTab (e)
{
	e.currentTarget.className = "tab-button opened";
	document.getElementById("posts").className = "tab-button";
	document.getElementById("posts-wrap").style.display = 'none';
	document.getElementById("agenda-container").style.display = 'block';
}

// add event listeners
var postsTabElement =  document.getElementById("posts");
var agendaTabElement =  document.getElementById("agenda");
if (typeof(postsTabElement) != 'undefined' && postsTabElement != null)
{
  if (typeof(agendaTabElement) != 'undefined' && agendaTabElement != null)
  {
		postsTabElement.addEventListener("click", switchToPostsTab);
		agendaTabElement.addEventListener("click", switchToAgendaTab);
  }
}