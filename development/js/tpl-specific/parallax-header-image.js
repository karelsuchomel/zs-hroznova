var parallaxedImageEl = $("#paralax-header");

var parallaxHeaderUpdate = function ()
{
	// image position
	var el = document.getElementById("paralax-header-conatiner");
	var elHeight = $('#paralax-header-conatiner').outerHeight(true);
	var rect = el.getBoundingClientRect();
	var ElBottomYdistance = elHeight + el.top;
	console.log(ElBottomYdistance + "px");

	// window position
	var windowScrolled = window.scrollTop;

	if ( windowScrolled > ElBottomYdistance )
	{
		return 'out-of-view';
	}
	// Round values appropriately
	//animationValue = +animationValue.toFixed(2);
};

var bla = function () {
	alert('scrolled');
};

window.addEventListener('scroll', bla() );
var scrollIntervalHandler = setInterval( parallaxHeaderUpdate(), 1000);

// Only animate elements in viewport



// Don't change properties directly
//window.requestAnimationFrame(animateElements);