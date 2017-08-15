<?php

$startID = htmlspecialchars($_POST['StartID']);
$DBName = htmlspecialchars($_POST['DBName']);
$DBUser = htmlspecialchars($_POST['DBUser']);
$DBPass = htmlspecialchars($_POST['DBPass']);

class results
{
	public $FirstID = -1;
	public $Count = -1;
	public $Exception = "";
}
$countRes = new results();

try
{
	$DB = new PDO("mysql:host=localhost;dbname={$DBName}", $DBUser, $DBPass);
} catch (PDOException $e) 
{
	$countRes->Exception = "Error with export database: " . $e->getMessage();
	echo json_encode( $countRes );
	die;
}

$sth = $DB->prepare("SELECT `idc` FROM `rs_clanky` WHERE `idc`>=:startItemID");
$sth->bindParam(':startItemID', $startID);

if ( $sth->execute() ) {
	$row =  $sth->fetch();
	$countRes->FirstID = $row['idc'];
	$countRes->Count = $sth->rowCount();
} else {
	$countRes->Exception = "db-count-items.php: couldn't execute querry";
}

$DB = null;
echo json_encode( $countRes );
