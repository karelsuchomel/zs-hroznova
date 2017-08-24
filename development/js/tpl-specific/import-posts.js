// get starting ID
var startPostID = 0;
startPostID = document.getElementById("start-from-id").value;
// Current working/in-progress ID
var currentID = -1;
//
var finalCount = 0;

// 'plain', 'notice', 'warning', 'error'
function print_Msg ( messange, type ) {
	var MessageEl = document.createElement('div');

	if ( type == "notice" || type == "warning" || type == "error" ) {
		MessageEl.className = "message-entry";
		if ( type == "notice" ) {
			MessageEl.className += " notice-message";
		} else if ( type == "warning" ) {
			MessageEl.className += " warning-message";
		} else {
			MessageEl.className += " error-message";
		}
	}

	MessageEl.innerHTML = messange;
	document.getElementById("Msg-container").prepend( MessageEl );
}

function preventPOST ( event ) {
	event.preventDefault();
}

function get_inputValue ( id ) {
	var el = document.getElementById( id );
	if ( el.value == "" ) {
		return null;
	}
	return el.value;
}

function get_credentials () {
	var logCred = {
		'DBHost' : get_inputValue("database-host"),
		'DBName' : get_inputValue("database-name"),
		'DBUser' : get_inputValue("database-user"),
		'DBPass' : get_inputValue("database-pass"),
		'StartID' : get_inputValue("start-from-id")
	};

	for (var key in logCred) {
		if ( logCred[key] == null) {
			print_Msg( "please fill out " + key + " field.", 'error' );
			return 1;
		} else {
			return logCred;
		}
	}
}

function getPHPHandlerLocation ( name ) 
{
	var handlerFolder = "/wp-content/themes/zs-hroznova/template-parts/php-import-content-handlers/"
	var handlerLocation = magicalData['siteURL'] + handlerFolder + name;
	console.log("getPHPHandlerLocation: " + handlerLocation );
	return handlerLocation;
}

function checkConnectionsToDBs ( crd ) {
	connectionCheckRequest = new XMLHttpRequest();
	// get php-handler location
	var handlerLocation = getPHPHandlerLocation('db-connection-test.php');

	// send credentials in a POST
	var POSTparams = "DBName=" + encodeURIComponent(crd.DBNameExport) + "&";
	POSTparams += "DBUser=" + encodeURIComponent(crd.DBUserExport) + "&";
	POSTparams += "DBPass=" + encodeURIComponent(crd.DBPassExport);
	
	connectionCheckRequest.open('POST', handlerLocation, false );
	connectionCheckRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	connectionCheckRequest.send( POSTparams );

	if( connectionCheckRequest.status === 200 ) {
		var response = JSON.parse(connectionCheckRequest.responseText);
		return response;
	} else {
		console.log("Status code returned from db-connection-test.php: " + connectionCheckRequest.status);
		return 1;
	}
}

function countItemsToProcess ( crd ) {
	connectionCount = new XMLHttpRequest();
	// get php-handler location
	var handlerLocation = getPHPHandlerLocation('db-count-items.php');

	// send start ID in a POST
	var POSTparams = "DBName=" + encodeURIComponent(crd.DBName) + "&";
	POSTparams += "DBUser=" + encodeURIComponent(crd.DBUser) + "&";
	POSTparams += "DBPass=" + encodeURIComponent(crd.DBPass) + "&";
	POSTparams += "StartID=" + encodeURIComponent(crd.StartID);

	connectionCount.open('POST', handlerLocation, false );
	connectionCount.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	connectionCount.send( POSTparams );

	if( connectionCount.status === 200 ) {
		var response = JSON.parse(connectionCount.responseText);
		return response;
	} else {
		console.log("Status code returned from get-number-of-images.php: " + connectionCount.status);
		return 1;
	}
}

function importPost ( currentID, crd ) {
	connectionImport = new XMLHttpRequest();
	// get php-handler location
	var handlerLocation = getPHPHandlerLocation('import-post.php');

	// send start ID in a POST
	var POSTparams = "DBName=" + encodeURIComponent(crd.DBName) + "&";
	POSTparams += "DBUser=" + encodeURIComponent(crd.DBUser) + "&";
	POSTparams += "DBPass=" + encodeURIComponent(crd.DBPass) + "&";
	POSTparams += "currentID=" + encodeURIComponent( currentID );

	connectionImport.open('POST', handlerLocation, false );
	connectionImport.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	connectionImport.send( POSTparams );

	if( connectionImport.status === 200 ) {
		var response = JSON.parse(connectionImport.responseText);
		return response;
	} else {
		console.log("Status code returned from import-post.php: " + connectionImport.status);
		return 1;
	}
}

function setupProgressBar ( count ) {
	var progressBar = document.getElementById("submit-form");
	progressBar.className += " import-button-progress-bar";
	progressBar.childNodes[0].nextSibling.innerHTML = "Importing . . . (<span id='current-progress-number'>0</span>/<span id='final-progress-number'>" + count + "</span>)";

	// create element progress-line
	var progressLine = document.createElement( 'div' );
	progressLine.id = "progress-line";
	progressBar.prepend( progressLine );

	// remove event listener for the button
	progressBar.removeEventListener( 'click', importHandler );
	progressBar.addEventListener( 'click', preventPOST );
}

function updateProgressBar ( currentProgress ) {
	var progressPercentage = 1 - (currentProgress / (finalCount / 100)) / 100;
	document.getElementById('current-progress-number').innerHTML = currentProgress;

	document.getElementById('progress-line').style.transform = "scaleX(" + progressPercentage + ")";
}

function importHandler (event)
{
	event.preventDefault();

	var crd = get_credentials();
	if (crd == 1) {
		console.log("couldn't contiue after trying to get credentials.");
		return 1;
	}

	// chech connection to databases and number of pictures to import
	var connectionCheck = checkConnectionsToDBs( crd );
	if ( connectionCheck.DBCon === 1 ) {
		print_Msg( "error occured connection to Export database: " + connectionCheck.ExException, "error" );
		return 1;
	} else {
		print_Msg( "Connection established.", "notice" );
	}

	// get the number of pictures to import, set the progress bar
	var itemsToProcess = countItemsToProcess( crd );
	console.log(itemsToProcess);
	if ( itemsToProcess.Count === -1 ) {
		print_Msg( "Couldn't count remaining pictures.", "error" );
		return 1;
	} else {
		setupProgressBar( itemsToProcess.Count );
		finalCount = itemsToProcess.Count;
	}

	var itemsImported = 0;
	currentID = itemsToProcess.FirstID;
	//while( itemsImported <= itemsToProcess.Count )
	var handlerInterval = setInterval(function() {
		if ( itemsImported <= itemsToProcess.Count ) {

			// load item from external database
			var importPostRes = importPost ( currentID , crd );
			console.log(importPostRes);
			var lastID = currentID;
			currentID = importPostRes.nextID;

			if ( importPostRes.nextID !== -1 ) {

				// category exists ? create category : skip to post import
				RPcreateCategory( importPostRes.Category, function(result) 
				{
					if ( result.status === -1 ) {
						print_Msg( "Tried to create category :" + importPostRes.Category + ", but got exception: <br>" + result.exception, "warning");
					} else {
						importPostRes.CategoryID = result.id;

						// no post with the same title ? create post : warning (post would be possible duplicate)
						RPcreatePost( importPostRes, function(result) 
						{
							if ( result.status === -1 ) {
								print_Msg( "Tried to create post :" + importPostRes.Title + ", but got exception: <br>" + result.exception, "warning");
							} else if ( ( result.status === 0 ) ) {
								print_Msg( "Post with title: \"" + importPostRes.Title + "\" already exists.", "warning");
							} else {
								print_Msg( "New item with ID[" + lastID + "] was imported<br>Date: " + importPostRes.Date + "<br>Title: " + importPostRes.Title + "<br>Content: " + importPostRes.Content + "", "notice");
							}
						} );
					}
				} );

			} else {
				print_Msg( "Item with ID[" + lastID + "] was not loaded", "warning");
			}

			// update progress bar
			updateProgressBar( itemsImported );
			itemsImported++;

		} else {
			clearInterval(handlerInterval);
		}
	}, 2000);

}

// add event listeners
document.getElementById("submit-form").addEventListener( 'click', importHandler );