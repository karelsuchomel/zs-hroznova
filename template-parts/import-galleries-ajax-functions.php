<?php
// connect to database which will be imported
// The one with WordPress can already be accessed via $wpdb
$servername = "localhost";
$DBName = "ksuchomel_test";
$username = "root";
$password = "1234";
$galleryTableName = "rs_gallery";
$pictureTableName = "rs_media";

// Create connections
try
{
	$conn = new PDO("mysql:host=$servername;dbname=$DBName", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "Database to import: connected successfully";
}
catch(PDOException $e)
{
	echo "Connection failed: " . $e->getMessage();
}

global $wpdb;

// get the picture table
$import_pictures_sql = "SELECT * FROM wp_posts ";
$result = $wpdb->get_results( 'SELECT * FROM wp_options WHERE option_id = 1', OBJECT);
print_r( $result );

// if initial
/*
if ( isset($_GET['initial']) ) {
	if ( $_GET['initial'] === "TRUE") {
		sendInitialdata();
	}
}

function sendInitialdata()
{
	global $galleryTableName;

	$galleryTable = $wpdb->get_results( "SELECT * FROM $galleryTableName", OBJECT );
	echo count($galleryTable);
	$pictureTable = $wpdb->get_results( "SELECT * FROM $pictureTableName", OBJECT );
	echo count($pictureTable);
}
*/








// download picture, get it's gallery-ID and it's DateTimeOriginal
// Upload picture and get picture-ID
// if loaded different ID than previous ones, create Post with category Galerie
// with short code inside (also do this if at the end of table)
// delete local picture


// Snippet of gallery short code
// [gallery size="medium" link="file" ids="12,13,14,15,16,17,18,19,20"]







/* testing exif_read_data();
$homePath = get_bloginfo('template_directory');
$path = $homePath . "/assets/images/test-pic-01.jpg";
$imgInfoArr = exif_read_data( $path, 'FILE');

// get the time
if ( isset($imgInfoArr['DateTimeOriginal']) )
{
  echo $imgInfoArr['DateTimeOriginal'];
}

wp_insert_post( $postarr, true );

*/

// close connection to database
$conn = null;

?>
