// Get the modal
const modal = document.getElementById('modal-wrap');
// Get the modal content
const modalContent = document.getElementById('modal-content');
// Get modal background
const modalBG = document.getElementById('modal-background');
// Get anchor tags, that triggers the modal
const anchorsArray = $("#content-single-page a:has(img)");
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

		loadLargerImage(e);
		//drawModalGallery(e);

	} else {

		loadLargerImage(e);

	}
});

function openPictureModal (scale, translateX, translateY, targetHeight)
{
	modal.style.display = "block";
	modalBG.style.display = "block";
	modalBG.style.animationName = "fadeIn";

	var zoomedHeight = (targetHeight * scale) ;
	var viewportHeight = document.documentElement.clientHeight;
	if ( viewportHeight > zoomedHeight ) {
		var toBeCenteredVerticaly = translateY + ((viewportHeight - zoomedHeight) / 2);
	} else {
		var toBeCenteredVerticaly = translateY;
	}


	setTimeout(function() {
		modalContent.style.transform = "scale(1.0001) translate(" + translateX + "px, " + toBeCenteredVerticaly + "px)";
	}, 20);

	modalState = "open";
};

function closePictureModal (scale)
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

function loadLargerImage (e)
{
	// spinner
	drawSpinner(e);

	// load a new picture and place it on top of the old one
	var largeImgPath = e.currentTarget.getAttribute('href');
	var largeImgEl = new Image();
	console.log("largeImgEl: " + largeImgEl);
	// append newly created picture to modal-content
	modalContent.appendChild( largeImgEl );
	largeImgEl.onload = function () {
		let largeImgElH = largeImgEl.height;
		drawModalSingleImage(e, largeImgElH);
	};

	largeImgEl.className = "zoom-picture";
	largeImgEl.src = largeImgPath;

};

function drawModalSingleImage (e, largeImgElH)
{
	removeSpinner ();

	// ----------- TODO ------------
	// I cannot compare dimensions in pixels
	// I need to compare aspect ratios of pictures to
	// modalConetnt width by viewport height

	// set the width (scale) and position to be as the anchor
	var currentAnchor = e.currentTarget;
	var anchorWidth = $(currentAnchor).width();
	var anchorHeight = $(currentAnchor).height();
	console.log("anchorWidth: " + anchorWidth + "px");

	const viewportWidth = document.documentElement.clientWidth;
	// ------
	const modalContentWidth = $("#content-wrap").width();
	// if the zoomed picture is taller than viewport
	var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
	if ( h < largeImgElH) {
		console.log("height of viewport: " + h + " height of ZoomedPicture: " + largeImgElH);
		initialModalScale = (anchorHeight / h);
	} else {
		initialModalScale = (anchorWidth / modalContentWidth);
	}
	console.log("initialModalScale: " + initialModalScale );
	// if viewport wider than #content-wrap
	var widthContentDifference = 0;
	if ( viewportWidth > modalContentWidth ) {
		widthContentDifference = (viewportWidth - modalContentWidth) / 2;
	}

	var anchorOffsets = e.currentTarget.getBoundingClientRect();
	var anchorOffTop = anchorOffsets.top;
	var anchorOffLeft = (anchorOffsets.left) - widthContentDifference;

	modalContent.style.top = anchorOffTop + "px";
	modalContent.style.left = anchorOffLeft + "px";
	modalContent.style.transformOrigin = "top left";

	modalContent.style.transform = "scale(" + initialModalScale + ")";

	var afterZoomScale = (modalContentWidth / anchorWidth);
	openPictureModal( afterZoomScale, (-anchorOffLeft), (-anchorOffTop), e.target.height);
};

function drawSpinner (e)
{
	var spinner = document.createElement("div");
	spinner.id = "spinner";

	// set the spiners top and left CSS atributes (centering the spinner)
	let spW = $(spinner).width();
	let spH = $(spinner).height();
	var leftTop = findCenter(spW, spH, e.target.clientHeight, e.target.clientWidth);
	spinner.style.left = leftTop[1] + "px";
	spinner.style.top = leftTop[0] + "px";

	var parentEl = e.currentTarget.parentElement;

	parentEl.style.position = "relative";

	parentEl.appendChild(spinner);
};

function removeSpinner ()
{
	if ( document.getElementById("spinner") ) {
		document.getElementById("spinner").remove();
	} else {
		console.log("Spinner wasn't found. So it couldn't be removed.");
		return false;
	}
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