function RPcreateCategories ( catName, callback ) 
{
	var result = {
		'status' : -1, // -1 = error, 0 = already exists, 1 = created new one
		'exception' : "",
		'id' : ""
	}

	// does category exists?
	var originalName = catName;
	catName = "?search=" + encodeURIComponent(catName);
	RPsendRequest ( 'GET', 'categories', catName, function(response)
	{
		if ( JSON.stringify(response) !== "[]" ) {
			if ( response[0].name === originalName ) {

			// pass-on cathegory id
			console.log( "this category already exists: " + response[0]['name']);
			result.status = 0;
			result.id = response[0].id;
			callback(result);
			}
		} else if ( JSON.stringify(response) === "[]" ) {

			// create new category
			RPnewCategory();
			
		} else {
			result.exception = response;
			callback(result);
		}

	} );

	// create new category
	function RPnewCategory () {
		var catData = {
			'name' : originalName
		}
		RPsendRequest ( 'POST', 'categories', catData, function(response) 
		{
			if ( JSON.stringify(response) !== "[]" ) {
				if ( response.name === originalName ) {

				// pass-on cathegory id
				console.log( "created new category: " + response.name);
				result.status = 1;
				result.id = response.id;
				callback(result);
				}
			} else {
				result.exception = response;
				callback(result);
			}
		} );
	}
}

function RPcreatePost ( importPostRes, callback ) 
{
	var result = {
		'status' : -1, // -1 = error, 0 = already exists, 1 = created new one
		'exception' : "",
		'id' : ""
	}

	// does post already exists?
	var originalTitle = importPostRes.Title;
	postTitle = "?search=" + encodeURIComponent(importPostRes.Title);
	RPsendRequest ( 'GET', 'posts', postTitle, function(response)
	{
		if ( JSON.stringify(response) !== "[]" ) {
			if ( response[0].title.rendered === originalTitle ) {

			// end post import
			console.log( "this post already exists: " + originalTitle);
			result.status = 0;
			result.id = response[0].id;
			callback(result);
			}
		} else if ( JSON.stringify(response) === "[]" ) {

			// create new post
			RPnewPost();
			
		} else {
			result.exception = response;
			callback(result);
		}

	} );

	// create new category
	function RPnewPost () {

		if ( importPostRes.ThumbnailID !== "") {
			var postData = {
				'date' : importPostRes.Date,
				'status' : 'publish',
				'title' : importPostRes.Title,
				'content' : importPostRes.Content,
				'categories' : importPostRes.CategoryIDs,
				'featured_media' : importPostRes.ThumbnailID
			}
		} else {
			var postData = {
				'date' : importPostRes.Date,
				'status' : 'publish',
				'title' : importPostRes.Title,
				'content' : importPostRes.Content,
				'categories' : importPostRes.CategoryIDs
			}
		}

		RPsendRequest ( 'POST', 'posts', postData, function(response) 
		{
			if ( JSON.stringify(response) !== "[]" ) {
				if ( response.title.rendered === originalTitle ) {

				// the post was successfully imported hurray!
				console.log( "created new post: " + originalTitle);
				result.status = 1;
				result.id = response.id;
				callback(result);
				}
			} else {
				result.exception = response;
				callback(result);
			}
		} );
	}
}

// type: 'posts', 'categories', 'pages'
// query: '?per_page=100&:order=desc'
// method: 'GET', 'POST'
// If you chose mehod GET, send query string in data parametr
// If you want to use POST, send your Object in data parametr
function RPsendRequest ( method, type, data, callback ) 
{
	var request = new XMLHttpRequest();

	if ( method === 'GET') 
	{
		request.open( method , magicalData['siteURL'] + '/wp-json/wp/v2/' + type + data);

		request.onload = function() {
			if (request.status >= 200 && request.status < 400) {
				var response = JSON.parse(request.responseText);
				callback( response );
			} else {
				callback("Connection to the server was succesful, but we recieved an error to our request.");
			}
		};

		request.onerror = function() {
			callback("Connection error");
		};
		request.send();
	} else if ( method === 'POST' ) {
		request.open( method , magicalData['siteURL'] + '/wp-json/wp/v2/' + type);

		request.onload = function() {
			if (request.status >= 200 && request.status < 400) {
				var response = JSON.parse(request.responseText);
				callback( response );
			} else {
				callback("Connection to the server was succesful, but we recieved an error to our request.");
			}
		};
		request.setRequestHeader("X-WP-Nonce", magicalData.nonce);
		request.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

		request.onerror = function() {
			callback("Connection error");
		};
		request.send(JSON.stringify( data ));
	}

}