<?php
class results
{
	public $DBCon = 0;
	public $Exception = "";
}
$conRes = new results();

if ( isset($_POST['DBName']) && isset($_POST['DBUser']) && isset($_POST['DBPass']) ) {
	$DBName = htmlspecialchars($_POST['DBName']);
	$DBUser = htmlspecialchars($_POST['DBUser']);
	$DBPass = htmlspecialchars($_POST['DBPass']);

	try
	{
		$DB = new PDO("mysql:host=localhost;dbname={$DBName}", $DBUser, $DBPass);
	} catch (PDOException $e) 
	{
		$conRes->ExDBCon = 1;
		$conRes->ExException = "Error with connection to database: " . $e->getMessage();
	}

}

$DB = null;

echo json_encode($conRes);