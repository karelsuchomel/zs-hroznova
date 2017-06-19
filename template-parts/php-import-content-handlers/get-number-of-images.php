<?php

$startPicID = htmlspecialchars($_POST['StartPictureID']);
$DBNameExport = htmlspecialchars($_POST['DBNameExport']);
$DBUserExport = htmlspecialchars($_POST['DBUserExport']);
$DBPassExport = htmlspecialchars($_POST['DBPassExport']);

class results
{
	public $PicCount = 0;
	public $Exception = "";
}
$countRes = new results();

try
{
	$DBExport = new PDO("mysql:host=localhost;dbname={$DBNameExport}", $DBUserExport, $DBPassExport);	
} catch (PDOException $e) 
{
	$countRes->Exception = "Error with export database: " . $e->getMessage();
}

$sth = $DBExport->prepare("SELECT `media_id` FROM `rs_media` WHERE `media_id`>=:startID");
$sth->bindParam(':startID', $startPicID);
$sth->execute();
$countRes->PicCount = $sth->rowCount();

echo json_encode( $countRes );

$DBExport = null;