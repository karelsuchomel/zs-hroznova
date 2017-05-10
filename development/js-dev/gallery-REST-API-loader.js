// Add event listeners for gallery buttons
const yearButtonsElements = document.getElementsByClassName("button-school-year");

for (var i = yearButtonsElements.length - 1; i >= 0; i--) {
	yearButtonsElements[i].addEventListener("click", execute_request);
}

// Find container to print the JSON to
const container = document.getElementById("content-single-page");

function execute_request(event) {
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

	console.log( requestSpecs );

	request.open('GET', 'http://localhost/zs-hroznova/index.php/wp-json/wp/v2/posts' + requestSpecs);
	request.onload = function() {
		console.log("status: " + request.status);
		if (request.status >= 200 && request.status < 400) {
			let response = JSON.parse(request.responseText);
			console.log(response);
		} else {
			console.log("Connection to the server was succesful, but we recieved an error to our request.");
		}
	};

	request.onerror = function() {
		console.log("Connection error");
	};

	request.send();
}