<?php

$PicID = htmlspecialchars($_POST['PictureID']);
$DBHostExport = htmlspecialchars($_POST['DBHostExport']);
$DBNameExport = htmlspecialchars($_POST['DBNameExport']);
$DBUserExport = htmlspecialchars($_POST['DBUserExport']);
$DBPassExport = htmlspecialchars($_POST['DBPassExport']);

class results
{
	public $error = 0;
	public $Exception = "";
	public $galleryID = null;
	public $dateTaken = null;
	public $newID = null;
	public $locationEx = null;
	public $locationWP = null;
}
$newPicture = new results();

try {
	$DBExport = new PDO("mysql:host=localhost;dbname={$DBNameExport}", $DBUserExport, $DBPassExport);	
} catch (PDOException $e) 
{
	$newPicture->error = 1;
	$newPicture->Exception = "Error with export database: " . $e->getMessage();
	echo json_encode( $newPicture );
	die();
}

$sth = $DBExport->prepare("SELECT `media_gallery_id`, `media_file` FROM `rs_media` WHERE `media_id`=:PictureID");
$sth->bindParam(':PictureID', $PictureID);
$sth->execute();

$newPicture->galleryID = $sth->fetchColumn();
$newPicture->locationEx = $sth->fetchColumn(1);

/*
// download the picture now
$ch = curl_init($DBHostExport . "/" . $newPicture->locationEx);
$fp = fopen('/wp-content/uploads/tmp/' . $newPicture->galleryID . '_' . $PicID . '.jpg', 'wb');
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
fclose($fp);
*/

echo json_encode( $newPicture );

$DBExport = null;