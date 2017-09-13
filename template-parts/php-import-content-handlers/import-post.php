<?php
require_once('../../inc/convert-w1250-encoding.php');
require_once('create-gallery-shortcode.php');

$DBName = htmlspecialchars($_POST['DBName']);
$DBUser = htmlspecialchars($_POST['DBUser']);
$DBPass = htmlspecialchars($_POST['DBPass']);
$currentID = htmlspecialchars($_POST['currentID']);

class results
{
	public $nextID = -1;
	public $Title = "";
	public $Content = "";
	public $Date = "";
	public $Categories = array();
	public $CategoryIDs = array();
	public $Exception = "";
	public $ThumbnailID = "";
}
$importItemRes = new results();

try
{
	$DB = new PDO("mysql:host=localhost;dbname={$DBName}", $DBUser, $DBPass);
} catch (PDOException $e) 
{
	$importItemRes->Exception = "Error with export database: " . $e->getMessage();
	echo json_encode( $importItemRes );
	die;
}

$sth = $DB->prepare("SELECT `idc`, `titulek`, `uvod`, `tema`, `datum` FROM `rs_clanky` WHERE `idc`>=:currentItemID AND `idc`<=(:currentItemID + 500)");
$sth->bindParam(':currentItemID', $currentID, PDO::PARAM_INT);

if ( $sth->execute() ) {
	$row = $sth->fetch();
	$importItemRes->Title = w1250_to_utf8($row['titulek']);

	// find galleries
	$imContent = w1250_to_utf8($row['uvod']);
	$galleryShortcode = handle_gallery( $imContent, $DBName, $DBUser, $DBPass );

	// strip tags
	$imContent = strip_tags( $imContent, "<br><p>" );

	// remove duplicit Headline
	$imContent = str_replace( $importItemRes->Title , "", $imContent);

	// remove inline style tags
	$pattern = '/style=".*"/';
	$imContent = preg_replace($pattern, "", $imContent);

	// Remove &:nbsp;
	$string = htmlentities($imContent);
	$imContent = str_replace( "&nbsp;" , "", $string);
	$imContent = html_entity_decode($imContent);

	if ( isset( $galleryShortcode[0] ) ) {
		$importItemRes->Content = $imContent . $galleryShortcode[0];
	} else {
		$importItemRes->Content = $imContent;
	}
	// setting up 
	if ( isset( $galleryShortcode[1] ) ) {
		$importItemRes->ThumbnailID = $galleryShortcode[1];
		// add the 'has_gallery' category
		array_push( $importItemRes->Categories , "has_gallery" );
	}
	$importItemRes->Date = w1250_to_utf8($row['datum']);

	$row = $sth->fetch();
	$importItemRes->nextID = w1250_to_utf8($row['idc']);

	$stb = $DB->prepare("SELECT `nazev` FROM `rs_topic` WHERE `idt`=:topicID");
	$stb->bindValue(':topicID', w1250_to_utf8($row['tema']), PDO::PARAM_INT);
	if ( $stb->execute() ) {
		$row = $stb->fetch();
		array_push( $importItemRes->Categories , w1250_to_utf8($row['nazev']) );
	} else {
		echo "couldn't execute query to extract Category title";
		print_r( $stb->errorInfo() );
	}

} else {
	echo "couldn't execute query";
	print_r( $sth->errorInfo() );
	die;
}

$DB = null;
echo json_encode( $importItemRes );