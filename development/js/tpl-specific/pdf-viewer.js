// get document name
function getAnchotHref ( id ) {
	const el = document.getElementById(id);
	if (!el) {
		console.log('element with ID: #' + id + ' not found.');
		return false;
	} else {
		const path = el.getAttribute('href');

		if (!path) {
			console.log('element with ID: #' + id + ' does not have a href attribute filled.');
			return false;
		} else {
			return path;
		}
	}
};

function drawPDFontoCanvas ( path, canvas_id, canvas_width, canvas_height ) {

	PDFJS.getDocument( path ).then(function(pdf) {
	pdf.getPage(1).then(function(page) {
		var scale = 1.0;
		var viewport = page.getViewport(720 / page.getViewport(1).width);
		//var viewport = page.getViewport(scale);

		var canvas = document.getElementById( canvas_id );
		var context = canvas.getContext('2d');
		canvas.height = canvas_height;
		canvas.width = 720;

		var renderContext = {
			canvasContext: context,
			viewport: viewport
		};
		page.render(renderContext);
	});
	});

};

// width of content container
var contentWidth = $("#content-single-page").outerWidth();
console.log(contentWidth);

var weekPath = getAnchotHref('this-week-path');
drawPDFontoCanvas( weekPath, 'this-week-canvas', contentWidth, 800 );

weekPath = getAnchotHref('next-week-path');
drawPDFontoCanvas( weekPath, 'next-week-canvas', contentWidth, 800 );

// Make menu-side-list as heigh as #content
setTimeout(function() {
	var contentHeight = $("#content").outerHeight();
	$("#side-list").css('height', contentHeight + 'px');
}, 500);
