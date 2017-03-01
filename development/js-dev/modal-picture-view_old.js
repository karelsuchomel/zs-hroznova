// Get the modal
var modal = document.getElementById('modal-wrap');
// Get modal background
var modalBG = document.getElementById('modal-background');


// Get single images, that triggers the modal
//var imagesArr = document.getElementsByTagName('img');
var imagesArr = $("#content-single-page a img");

// When the user clicks on the button, open the modal
$(imagesArr).click(function(e)
{
	e.preventDefault();

	console.log(e);

	// is it a gallery?
	var par = $(this).parent().parent();
	if (par.hasClass('gallery-icon')) {
		drawModalGallery(e);
	} else {
		drawModalSingleImage(e);
	}

	

	//modal.style.display = "block";
	//modalBG.style.display = "block";

});

function drawModalSingleImage (e)
{
	// is already 'size-large'?
	const clickedImg = e.target;
	if ($(clickedImg).hasClass('size-large')) {

		// add placeholder and use the image
		var imgPlaceholder = document.createElement("div");
		imgPlaceholder.style.height = $(clickedImg).height() + "px";
		imgPlaceholder.style.width = $(clickedImg).width() + "px";

		var par = clickedImg.parentElement;
		$(clickedImg).addClass('zoom-picture');
		par.appendChild(imgPlaceholder);

		// get center of the screen
		let widthElNat = clickedImg.naturalWidth;
		let heightElNat = clickedImg.naturalHeight;
		console.log(widthElNat, heightElNat, $(window).width(), $(window).height());
		var center = findCenter (widthElNat, heightElNat, $(window).width(), $(window).height());
		console.log(center);

		// set images natural dimensions; use SCALE
		var curW = $(clickedImg).width();
		var curH = $(clickedImg).height();
		var scaleX = (widthElNat / curW);
		var scaleY = (heightElNat / curH);
		// get image to position
		var offTop = $(clickedImg).offset().top;
		var offLeft = $(clickedImg).offset().left;
		var moveY = ( center[1] - offTop);
		var precalc = (center[0] - offLeft);
		var moveX = Math.abs( precalc ); 

		// clickedImg.style.maxWidth = $(window).width() + "px";
		// clickedImg.style.height = heightElNat + "px";
		// clickedImg.style.width = widthElNat + "px";
		console.log("translate(-" + moveX + "px, " + moveY + "px) scale(" + scaleX +", " + scaleY + ")");

		clickedImg.style.transform = "translate(-" + moveX + "px, " + moveY + "px) scale(" + scaleX +", " + scaleY + ")";



	} else {

		drawSpinner(e);
	}

};

function drawSpinner (e)
{
	// get the images unique CSS in format 'wp-image-123'
	const regex = /wp\-image\-\d+/g;
	const str = e.target.className;
	let m;
	var clickedElementClass;

	while ((m = regex.exec(str)) !== null) {
		// This is necessary to avoid infinite loops with zero-width matches
		if (m.index === regex.lastIndex) {
			regex.lastIndex++;
		}

		// The result can be accessed through the `m`-variable.
		m.forEach((match, groupIndex) => {
			clickedElementClass = match;
		});
	};

	var spinner = document.createElement("div");
	spinner.id = "spinner";

	// set the spiners top and left CSS atributes (centering the spinner)
	let spW = $(spinner).width();
	let spH = $(spinner).height();
	var leftTop = findCenter(spW, spH, e.target.clientHeight, e.target.clientWidth);
	spinner.style.left = leftTop[1] + "px";
	spinner.style.top = leftTop[0] + "px";

	var imageEl = document.getElementsByClassName(clickedElementClass);
	var parentEl = imageEl[0].parentElement;

	parentEl.style.position = "relative";

	parentEl.appendChild(spinner);
};

function findCenter (widthEl, heightEl, widthCont, heightCont)
{
	return [(widthCont / 2) - (widthEl / 2), (heightCont / 2) - (heightEl / 2)];
};

function drawModalGallery(e)
{

	alert('gallery');
};





// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target == modalBG) {
		modal.style.display = "none";
		modalBG.style.display = "none";
	}
}