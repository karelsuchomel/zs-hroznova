// Get anchor tags, that triggers the modal
var anchorsArray = $("#content-single-page a:has(img)");

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

//////////////////////////////////////////////

var pswpElement = document.querySelectorAll('.pswp')[0];

// build items array
var items = [
    {
        src: 'https://placekitten.com/600/400',
        w: 600,
        h: 400,
        msrc: 'path/to/small-image.jpg'
    },
    {
        src: 'https://placekitten.com/1200/900',
        w: 1200,
        h: 900,
        msrc: 'path/to/small-image.jpg'
    }
];

// define options (if needed)
var options = {
    // optionName: 'option value'
    // for example:
    index: 0 // start at first slide
};

// Initializes and opens PhotoSwipe
var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
gallery.init();