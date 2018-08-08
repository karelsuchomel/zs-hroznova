/* 
toggle info card state (found on the homepage)
*/

if(!localStorage.getItem('infoCardState')) {
	localStorage.setItem('infoCardState', 'visible');
}

function toggleInfoCardState() 
{
	var contentEl = document.getElementById("content");
	var cardWrapEl = document.getElementById("info-card-wrap");
	var showInfoCardButtonEl = document.getElementById("show-info-card");
	var cardWrapMarginBottom = window.getComputedStyle(cardWrapEl, null).getPropertyValue("margin-bottom");
	var cardHeight = cardWrapEl.offsetHeight + parseInt(cardWrapMarginBottom);

	// if it's hidden, show it
	if ( localStorage.getItem('infoCardState') === 'visible') 
	{
		contentEl.style.transition = '0.5s';
		
		contentEl.style.transform = "translate3d(0,-" + (cardHeight) + "px,0)";

		setTimeout(function(){
			contentEl.style.transition = '0s';
			cardWrapEl.style.display = 'none';
			contentEl.style.transform = 'translate3d(0,0,0)';
			showInfoCardButtonEl.style.display = 'block';
			showInfoCardButtonEl.style.transform = 'translate3d(0,-50px,0)';
			showInfoCardButtonEl.style.opacity = '0';
		}, 501);

		setTimeout(function(){
			showInfoCardButtonEl.style.transform = 'translate3d(0,0px,0)';
			showInfoCardButtonEl.style.opacity = '1';
		}, 520);

		localStorage.setItem('infoCardState', 'hidden');

	// if it's open, hide it
	} else 
	{
		cardWrapEl.style.display = 'block';

		// height has to be recalculated because display: none; has no height.
		cardWrapMarginBottom = window.getComputedStyle(cardWrapEl, null).getPropertyValue("margin-bottom");
		cardHeight = cardWrapEl.offsetHeight + parseInt(cardWrapMarginBottom);

		contentEl.style.transform = "translate3d(0,-" + (cardHeight) + "px,0)";

		setTimeout(function(){
			contentEl.style.transition = '0.5s';
			contentEl.style.transform = 'translate3d(0,0,0)';
			showInfoCardButtonEl.style.opacity = '0';
		}, 16);

		setTimeout(function(){
			contentEl.style.transition = '0s';
			showInfoCardButtonEl.style.display = 'none';
		}, 530);

		localStorage.setItem('infoCardState', 'visible');
	}
}

// add event listeners
var toggleInfoCardElements = document.getElementsByClassName("toggle-info-card")
for (var i = toggleInfoCardElements.length - 1; i >= 0; i--) {
	toggleInfoCardElements[i].addEventListener("click", toggleInfoCardState); 
}