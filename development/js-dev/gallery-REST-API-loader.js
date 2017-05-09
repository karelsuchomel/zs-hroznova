// Add event listeners for gallery buttons
const yearButtonsElements = document.getElementsByClassName("button-school-year");

for (var i = yearButtonsElements.length - 1; i >= 0; i--) {
	yearButtonsElements[i].addEventListener("click", execute_request);
}

// Find container to print the JSON to
const container = document.getElementById("content-single-page");

function execute_request(event) {
	let yearData = event.currentTarget.getAttribute("data");
	let request = new XMLHttpRequest();

	// get current host name
	//var hostName = window.location.origin;
	//console.log(hostName);

	request.open('GET', 'http://localhost/zs-hroznova/index.php/wp-json/wp/v2/posts');
	request.onload = function() {
		console.log(request.status);
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