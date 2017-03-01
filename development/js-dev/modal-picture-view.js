// Get the modal
var modal = document.getElementById('modal-wrap');
// Get the modal content
var modalContent = document.getElementById('modal-content');
// Get modal background
var modalBG = document.getElementById('modal-background');
// Get anchor tags, that triggers the modal
var anchorsArray = $("#content-single-page a:has(img)");
// All anchors with images are display: block

// vars
var initialModalScale;

$(anchorsArray).click(function(e)
{
	e.preventDefault();
	//console.log(e);

	// is it a gallery?
	let elParent = e.currentTarget.parentElement;
	if ($(elParent).hasClass('gallery-icon')) {

		drawModalSingleImage(e);
		//drawModalGallery(e);

	} else {

		drawModalSingleImage(e);

	}
});

function openPictureModal (scale, translateX, translateY, targetHeight)
{
	modal.style.display = "block";
	modalBG.style.display = "block";
	modalBG.style.animationName = "fadeIn";

	var zoomedHeight = (targetHeight * scale) ;
	var viewportHeight = document.documentElement.clientHeight;
	var toBeCenteredVerticaly = translateY + ((viewportHeight - zoomedHeight) / 2);


	setTimeout(function() {
		modalContent.style.transform = "scale(1.0001) translate(" + translateX + "px, " + toBeCenteredVerticaly + "px)";
	}, 20);

	modalState = "open";
};

function closePictureModal (scale, translateX, translateY)
{
	modalContent.style.transform = "scale(" + scale + ") translate(" + 0 + "px, " + 0 + "px)";
	modalBG.style.animationName = "fadeOut";

	setTimeout(function() {
		modal.style.display = "none";
		modalBG.style.display = "none";
		modalContent.innerHTML = "";
	}, 500);


	modalState = "close";
};

function drawModalSingleImage (e)
{
	// load a new picture and place it on top of the old one
	var largeImgPath = e.currentTarget.getAttribute('href');
	var largeImgEl = document.createElement('img');
	largeImgEl.setAttribute('src', largeImgPath);
	largeImgEl.className = "zoom-picture";

	// append newly created picture to modal-content
	modalContent.appendChild( largeImgEl );

	// set the width (scale) and position to be as the anchor
	var currentAnchor = e.currentTarget;
	var anchorWidth = $(currentAnchor).width();
	var anchorOffsets = e.currentTarget.getBoundingClientRect();
	var anchorOffTop = anchorOffsets.top;
	var anchorOffLeft = anchorOffsets.left;

	modalContent.style.top = anchorOffTop + "px";
	modalContent.style.left = anchorOffLeft + "px";
	modalContent.style.transformOrigin = "top left";

	var viewportWidth = $("#content-wrap").width();
	initialModalScale = (anchorWidth / viewportWidth);
	modalContent.style.transform = "scale(" + initialModalScale + ")";

	var afterZoomScale = (viewportWidth / anchorWidth);
	openPictureModal( afterZoomScale, (-anchorOffLeft), (-anchorOffTop), e.target.height);
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
$(modal).click( function() {

	closePictureModal(initialModalScale);
	
});