// get starting ID
var startImageID = 1;
startImageID = document.getElementById("start-from-picture-id").value;

// 'plain', 'notice', 'varning', 'error'
function print_Msg ( messange, type ) {
	let MessageEl = document.createElement('div');

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
	let logCred = {
		'DBHostExport' : get_inputValue("database-host-ex"),
		'DBNameExport' : get_inputValue("database-name-ex"),
		'DBUserExport' : get_inputValue("database-user-ex"),
		'DBPassExport' : get_inputValue("database-pass-ex"),
		'DBNameImport' : get_inputValue("database-name-im"),
		'DBUserImport' : get_inputValue("database-user-im"),
		'DBPassImport' : get_inputValue("database-pass-im"),
		'StartPictureID' : get_inputValue("start-from-picture-id")
	};

	let errFound = 0;
	for (var key in logCred) {
		if ( logCred[key] == null) {
			print_Msg( "please fill out " + key + " field.", 'error' );
			errFound = 1;
		}
	}

	if ( errFound == 1) {
		return 1;
	} else {
		return logCred;
	}
}

function getPHPHandlerLocation ( name ) {
	const regex = /(\S+)import-galerii\//g;
	const str = document.location.href;
	let m;

	while ((m = regex.exec(str)) !== null) {
	// This is necessary to avoid infinite loops with zero-width matches
	if (m.index === regex.lastIndex) {
	    regex.lastIndex++;
	}

	const handlerFolder = "wp-content/themes/zs-hroznova/template-parts/php-import-content-handlers/"
	const handlerLocation = m[1] + handlerFolder + name;
	return handlerLocation;
	}
}

function checkConnectionsToDBs ( crd ) {
	connectionCheckRequest = new XMLHttpRequest();
	// get php-handler location
	const handlerLocation = getPHPHandlerLocation('db-connection-test.php');

	// send credentials in a POST
	let POSTparams = "DBNameExport=" + encodeURIComponent(crd.DBNameExport) + "&";
	POSTparams += "DBUserExport=" + encodeURIComponent(crd.DBUserExport) + "&";
	POSTparams += "DBPassExport=" + encodeURIComponent(crd.DBPassExport) + "&";
	POSTparams += "DBNameImport=" + encodeURIComponent(crd.DBNameImport) + "&";
	POSTparams += "DBUserImport=" + encodeURIComponent(crd.DBUserImport) + "&";
	POSTparams += "DBPassImport=" + encodeURIComponent(crd.DBPassImport);

	connectionCheckRequest.open('POST', handlerLocation, false );
	connectionCheckRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	connectionCheckRequest.send( POSTparams );

	if( connectionCheckRequest.status === 200 ) {
		const response = JSON.parse(connectionCheckRequest.responseText);
		return response;
	} else {
		console.log("Status code returned from db-connection-test.php: " + connectionCheckRequest.status);
		return 1;
	}
}

function countPicturesToProcess ( crd ) {
	connectionCountPics = new XMLHttpRequest();
	// get php-handler location
	const handlerLocation = getPHPHandlerLocation('get-number-of-images.php');

	// send start ID in a POST
	let POSTparams = "DBNameExport=" + encodeURIComponent(crd.DBNameExport) + "&";
	POSTparams += "DBUserExport=" + encodeURIComponent(crd.DBUserExport) + "&";
	POSTparams += "DBPassExport=" + encodeURIComponent(crd.DBPassExport) + "&";
	POSTparams += "StartPictureID=" + encodeURIComponent(crd.StartPictureID);

	connectionCountPics.open('POST', handlerLocation, false );
	connectionCountPics.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	connectionCountPics.send( POSTparams );

	if( connectionCountPics.status === 200 ) {
		const response = JSON.parse(connectionCountPics.responseText);
		return response;
	} else {
		console.log("Status code returned from get-number-of-images.php: " + connectionCountPics.status);
		return 1;
	}
}

function importPicture ( ID, crd ) {
	connectionImportPic = new XMLHttpRequest();
	// get php-handler location
	const handlerLocation = getPHPHandlerLocation('image-handler.php');

	// send start ID in a POST
	let POSTparams = "DBNameExport=" + encodeURIComponent(crd.DBNameExport) + "&";
	POSTparams += "DBUserExport=" + encodeURIComponent(crd.DBUserExport) + "&";
	POSTparams += "DBPassExport=" + encodeURIComponent(crd.DBPassExport) + "&";
	POSTparams += "DBHostExport=" + encodeURIComponent(crd.DBHostExport) + "&";
	POSTparams += "PictureID=" + encodeURIComponent( ID );

	connectionImportPic.open('POST', handlerLocation, false );
	connectionImportPic.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	connectionImportPic.send( POSTparams );

	if( connectionImportPic.status === 200 ) {
		const response = connectionImportPic.responseText;
		return response;
	} else {
		console.log("Status code returned from get-number-of-images.php: " + connectionImportPic.status);
		return 1;
	}
}

function setupProgressBar ( buttonID, count ) {
	const progressBar = document.getElementById(buttonID);
	progressBar.className += " import-button-progress-bar";
	progressBar.childNodes[0].nextSibling.innerHTML = "Importing . . . (0/" + count + ")";

	// create element progress-line
	var progressLine = document.createElement( 'div' );
	progressLine.id = "progress-line";
	document.getElementById(buttonID).prepend( progressLine );

	// remove event listener for the button
	progressBar.removeEventListener( 'click', importHandler );
	progressBar.addEventListener( 'click', preventPOST );
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
	if ( connectionCheck.ExDBCon == 1 ) {
		print_Msg( "error occured connection to Export database: " + connectionCheck.ExException, "error" );
	} else if ( connectionCheck.ImDBCon == 1 ) {
		print_Msg( "error occured connection to Import database: " + connectionCheck.ImException, "error" );
	} else {
		print_Msg( "Connections established.", "notice" );
	}

	// get the number of pictures to import, set the progress bar
	var picturesToProcess = countPicturesToProcess( crd );
	if ( picturesToProcess.PicCount == -1 ) {
		print_Msg( "Couldn't count remaining pictures." );
	} else {
		setupProgressBar( "submit-form", picturesToProcess.PicCount );
		print_Msg( "Pictures to process: " + picturesToProcess.PicCount, "plain");
	}

	let i = 1;
	//picturesToProcess.PicCount
	while( 1 >= i ) {

		// uploads picture to current wordpress
		const importedPicture = importPicture( i, crd );
		console.log(importedPicture);
		/*
		if ( importedPicture == 1 ) {
			i++;
			continue;
		} else {
			console.log("picture id: " + i + "was imported");
		}
		*/
		i++;
	}
}

// add event listeners
document.getElementById("submit-form").addEventListener( 'click', importHandler );