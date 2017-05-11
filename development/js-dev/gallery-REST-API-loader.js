// Add event listeners for gallery buttons
const yearButtonsElements = document.getElementsByClassName("button-school-year");

for (var i = yearButtonsElements.length - 1; i >= 0; i--) {
	yearButtonsElements[i].addEventListener("click", execute_request);
}

// Find container to print the JSON to
const galListContainer = document.getElementById("listing-found-galleries-container");

function execute_request(event) 
{
	// Handle ".selected" class
	var prevBtn = document.getElementsByClassName("selected");
	console.log(prevBtn[0]);
	prevBtn[0].className = "button-school-year";
	event.currentTarget.className += " selected";


	let yearData = event.currentTarget.getAttribute("data");
	let firstSemestr = yearData.substr( 0, 4 );
	let secondSemestr = yearData.substr( 5 );
	let request = new XMLHttpRequest();

	// Set school year end and start
	firstSemestr = firstSemestr + "-08-31T00:00:00.000Z";
	secondSemestr = secondSemestr + "-09-01T00:00:00.000Z";

	let requestSpecs = '';
	requestSpecs = "?categories=4";
	requestSpecs += "&after=" + firstSemestr;
	requestSpecs += "&before=" + secondSemestr;
	requestSpecs += "&_embed";

	request.open('GET', 'http://localhost/zs-hroznova/index.php/wp-json/wp/v2/posts' + requestSpecs);
	request.onload = function() {
		if (request.status >= 200 && request.status < 400) {
			const response = JSON.parse(request.responseText);
			console.log(response);

			// Render response into galListContainer
			printResponse( response );
		} else {
			console.log("Connection to the server was succesful, but we recieved an error to our request.");
		}
	};

	request.onerror = function() {
		console.log("Connection error");
	};

	request.send();

}

function printResponse( responseData )
{
	HTMLtoprint = "";

	for (var i = 0; i < responseData.length; i++) {
		HTMLtoprint += "<li>";
		HTMLtoprint += "<a href='" + responseData[i].link + "'>";

		if ( responseData[i]._embedded['wp:featuredmedia'][0].source_url ) {
			let originalSource = responseData[i]._embedded['wp:featuredmedia'][0].source_url;
			let sourceLength = originalSource.length;
			let sourceExt = originalSource.substr( (sourceLength - 4), 4 );
			var source = originalSource.substr( 0, (sourceLength - 4) ) + "-252x189" + sourceExt;


		} else {
			var source = "";	
		}
		HTMLtoprint += "<img src='" + source + "'>";

		HTMLtoprint += "</a>";
		HTMLtoprint += "<div class='title-overlay-container'>";
		HTMLtoprint += "<a class='title' href='" + responseData[i].link + "'>";
		HTMLtoprint += responseData[i].title.rendered + "</a>";
		HTMLtoprint += "<span class='gallery-date'>";
		HTMLtoprint += parseIsoDatetime( responseData[i].date ) + "</span>";
		HTMLtoprint += "</div>";
		HTMLtoprint += "</li>";
	};

	galListContainer.innerHTML = HTMLtoprint;

}

function parseIsoDatetime(dtstr) {
    var dt = dtstr.split(/[: T-]/).map(parseFloat);

    const months = [
    	'Leden',
    	'Únor',
    	'Březen',
    	'Duben',
    	'Květen',
    	'Červen',
    	'Červenec',
    	'Srpen',
    	'Září',
    	'Říjen',
    	'Listopad',
    	'Prosinec'
    ]

    let date = dt[2] + ". " + months[ dt[1] - 1 ] + ", " + dt[0];
    return date;
}