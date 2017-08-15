<?php
require_once('../inc/convert-w1250-encoding.php');

$DBName = htmlspecialchars($_POST['DBName']);
$DBUser = htmlspecialchars($_POST['DBUser']);
$DBPass = htmlspecialchars($_POST['DBPass']);
$currentID = htmlspecialchars($_POST['currentID']);

// DELETE IN PRODUCTION
$DBName = "c4-zshroznova";
$DBUser = "c4-zshroznova";
$DBPass = "c4-zshroznova";
$currentID = 2016;

class results
{
	public $created = false;
	public $nextID = -1;
	public $Title = "";
	public $Content = "";
	public $Date = "";
	public $Category = "";
	public $Exception = "";
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

$sth = $DB->prepare("SELECT `idc`, `titulek`, `uvod`, `tema`, `datum` FROM `rs_clanky` WHERE `idc`>=:currentItemID AND `idc`<=(:currentItemID + 10)");
$sth->bindParam(':currentItemID', $currentID, PDO::PARAM_INT);

if ( $sth->execute() ) {
	$row = $sth->fetch();
	$importItemRes->Title = w1250_to_utf8($row['titulek']);
	$imContent = strip_tags( w1250_to_utf8($row['uvod']), "<br><p><a>" );

	// remove duplicit Headline
	$imContent = str_replace( $importItemRes->Title , "", $imContent);

	// Sanitize style
	$pattern = '/style=".*"/';
	$imContent = preg_replace($pattern, "", $imContent);

	// Remove &:nbsp;
	$string = htmlentities($imContent);
	$imContent = str_replace( "&nbsp;" , "", $string);
	$imContent = html_entity_decode($imContent);

	$importItemRes->Content = $imContent;
	$importItemRes->Date = w1250_to_utf8($row['datum']);

	$row = $sth->fetch();
	$importItemRes->nextID = w1250_to_utf8($row['idc']);

	$stb = $DB->prepare("SELECT `nazev` FROM `rs_topic` WHERE `idt`=:topicID");
	$stb->bindValue(':topicID', w1250_to_utf8($row['tema']), PDO::PARAM_INT);
	if ( $stb->execute() ) {
		$row = $stb->fetch();
		$importItemRes->Category = w1250_to_utf8($row['nazev']);
	} else {
		echo "couldn't execute query to extract Category title";
		print_r( $stb->errorInfo() );
	}

} else {
	echo "couldn't execute query";
	print_r( $sth->errorInfo() );
	die;
}

function importNewPostCat ( $CategoryName, $Title, $Content, $Date ) 
{
	// create category if none with the current title exists
	if ( !(term_exists( $CategoryName, 'category')) ) {
		wp_insert_category( array( 'taxonomy' => 'category', 'cat_name' => sanitize_title( $CategoryName ) ) );
	}

	// import the post data
	$postData = array(
		'post_title' => $Title,
		'post_content' => $Content,
		'post_date' => $Date,
		'post_status' => 'publish',
		'post_category' => $CategoryName
		);
	$pid = wp_insert_post( $postData );

	if ( $pid !== 0 ) {
		return true;
	}	
}

$importItemRes->created = importNewPostCat( $importItemRes->Category, $importItemRes->Title, $importItemRes->Content, $importItemRes->Date );

$DB = null;
echo json_encode( $importItemRes );