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
	var elParent = e.currentTarget.parentElement;
	if ($(elParent).hasClass('gallery-icon')) {

		loadLargerImage(e);
		//drawModalGallery(e);

	} else {

		loadLargerImage(e);

	}
});

// add two functions to Image prototype
Image.prototype.load = function(url)
{
	var thisImg = this;
	var xmlHTTP = new XMLHttpRequest();
	xmlHTTP.open('GET', url,true);
	xmlHTTP.responseType = 'arraybuffer';
	xmlHTTP.onload = function(e) {
		var blob = new Blob([this.response]);
		thisImg.src = window.URL.createObjectURL(blob);
	};
	xmlHTTP.onprogress = function(e) {
		thisImg.compvaredPercentage = parseInt((e.loaded / e.total) * 100);
	};
	xmlHTTP.onloadstart = function() {
		thisImg.compvaredPercentage = 0;
	};
	xmlHTTP.send();
};
Image.prototype.compvaredPercentage = 0;


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
		modalContent.style.transform = "scale(1) translate(" + translateX + "px, " + toBeCenteredVerticaly + "px)";
	}, 20);

	modalState = "open";
};

function closePictureModal (scale)
{
	modalContent.style.transform = "scale(" + scale + ") translate(" + 0 + "px, " + 0 + "px)";
	modalBG.style.animationName = "fadeOut";
	modalBG.style.animationFillMode = "forwards";

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
	var prgb = initiateProgressBar(e);

	// load a new picture and place it on top of the old one
	var largeImgPath = e.currentTarget.getAttribute('href');
	var largeImgEl = new Image();

	var loadingCompvared = false;
	var interID = setInterval ( function() {
		prgb.style.transform = "scaleX(" + (largeImgEl.compvaredPercentage / 100) + ")";	

		console.log( "loaded: " + largeImgEl.compvaredPercentage);

		if ( largeImgEl.compvaredPercentage == 100 ) {
			clearInterval( interID );
		}
	}, 100); 
	largeImgEl.load( largeImgPath );

	largeImgEl.onload = function () {
		var largeImgElH = largeImgEl.height;
		drawModalSingleImage(e, largeImgElH);
	};

	largeImgEl.className = "zoom-picture";
	// append newly created picture to modal-content
	modalContent.appendChild( largeImgEl );

};

function drawModalSingleImage (e, largeImgElH)
{
	removeProgressBar();

	// ----------- TODO ------------
	// I cannot compare dimensions in pixels
	// I need to compare aspect ratios of pictures to
	// modalConetnt width by viewport height

	// set the width (scale) and position to be as the anchor
	var currentAnchor = e.currentTarget;
	var anchorWidth = $(currentAnchor).width();
	var anchorHeight = $(currentAnchor).height();
	console.log("anchorWidth: " + anchorWidth + "px");

	var viewportWidth = document.documentElement.clientWidth;
	// ------
	var modalContentWidth = $("#content-wrap").width();
	// if the zoomed picture is taller than viewport
	var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
	//if ( h < largeImgElH) {
	//	console.log("height of viewport: " + h + " height of ZoomedPicture: " + largeImgElH);
	//	initialModalScale = (anchorHeight / h);
	//} else {
		initialModalScale = (anchorWidth / modalContentWidth);
	//}
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

function initiateProgressBar (e)
{
	var progressBarEl = document.createElement( "div" );
	progressBarEl.id = "progress-bar";

	var parentEl = e.currentTarget.parentElement;
	parentEl.style.position = "relative";

	parentEl.appendChild( progressBarEl );

	return progressBarEl;
};

function removeProgressBar ()
{
	if ( document.getElementById("progress-bar") ) {
		document.getElementById("progress-bar").remove();
	} else {
		console.log("Progress bar wasn't found. So it couldn't be removed.");
		return false;
	}
};


// When the user clicks anywhere outside of the modal, close it
modal.addEventListener( 'click', function() 
{
	closePictureModal(initialModalScale);
});