const parallaxedImageEl = $("#paralax-header");

var parallaxHeaderUpdate = function ()
{
	// image position
	let el = document.getElementById("paralax-header-conatiner");
	let elHeight = $('#paralax-header-conatiner').outerHeight(true);
	let rect = el.getBoundingClientRect();
	const ElBottomYdistance = elHeight + el.top;
	console.log(ElBottomYdistance + "px");

	// window position
	let windowScrolled = window.scrollTop;

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