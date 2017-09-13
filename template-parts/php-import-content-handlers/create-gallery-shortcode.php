<?php
// desired format: [gallery link="file" size="medium" ids="5958,5959,5960,5961,5962,5963"]

// find if string has "gallery_id"
function handle_gallery( $content, $DBName, $DBUser, $DBPass )
{
	$regex = '/gallery_id=(\d+)/';
	
	preg_match_all($regex, $content, $matches, PREG_SET_ORDER, 0);
	if ( isset($matches[0][1]) ) 
	{
		$gallery_id = $matches[0][1];
		// find image names from original databse
		$mediaFileNames = find_image_names( $gallery_id, $DBName, $DBUser, $DBPass );
		// find media IDs from Wordpress database
		$mediaIDs = find_image_ids( $mediaFileNames, "zshroznova", "root", "1234" );

		if ( isset($mediaIDs[0]) !== "" ) {
			return array( "[gallery link='file' size='medium' ids='" . implode(",", $mediaIDs) . "']", $mediaIDs[0] );
		} else {
			return "";
		}

		//return
	} else {
		// if not, return 0
		return "";
	}
}

// else make a querry to find images that belong to that gallery
// returns an array of image filenames with the same name already uploaded in Wordpress
function find_image_names( $gallery_id, $DBName, $DBUser, $DBPass ) 
{
	try
	{
		$DB = new PDO("mysql:host=localhost;dbname={$DBName}", $DBUser, $DBPass);
	} catch (PDOException $e) 
	{
		echo "Error with export database: " . $e->getMessage();
		die;
	}

	$sth = $DB->prepare("SELECT `media_file` FROM `rs_media` WHERE `media_gallery_id`=:gallery_id");
	$sth->bindParam(':gallery_id', $gallery_id, PDO::PARAM_INT);

	$mediaFileNames = array();

	if ( $sth->execute() ) 
	{
		$row = $sth->fetchAll();

		for ($i=0; $i < sizeof($row); $i++)
		{ 
			$mediaURL = $row[$i]["media_file"];
			// sanitize
			$pathParts = pathinfo( $mediaURL );
			$fileName = $pathParts["filename"];
			$mediaFileNames[$i] = $fileName;
			$DB = null;
		}

	}
	return $mediaFileNames;
}

// minus offset of the final database (found to be 1042)
function find_image_ids( $mediaFileNames, $DBName, $DBUser, $DBPass )
{
	try
	{
		$DB = new PDO("mysql:host=localhost;dbname={$DBName}", $DBUser, $DBPass);
	} catch (PDOException $e) 
	{
		echo "Error with export database: " . $e->getMessage();
		die;
	}

	$imageIDs = array();

	for ($i=0; $i < sizeof( $mediaFileNames ); $i++) { 
		$sth = $DB->prepare("SELECT `ID` FROM `wp_posts` WHERE `post_type`='attachment' AND `post_name`=:imageName ");
		$sth->bindParam(':imageName', $mediaFileNames[$i]);

		if ( $sth->execute() )
		{
			$row = $sth->fetch();
			$imageIDs[$i] = $row["ID"] - 1042;
		}

	}
	return $imageIDs;
}



// create shortcode and append it to the bottom of the content
// add category_id 'has-gallery' to the post