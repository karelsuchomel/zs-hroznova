<?php
require_once('../../inc/convert-w1250-encoding.php');

$DBNameExport = htmlspecialchars($_POST['DBNameExport']);
$DBUserExport = htmlspecialchars($_POST['DBUserExport']);
$DBPassExport = htmlspecialchars($_POST['DBPassExport']);
$DBNameImport = htmlspecialchars($_POST['DBNameImport']);
$DBUserImport = htmlspecialchars($_POST['DBUserImport']);
$DBPassImport = htmlspecialchars($_POST['DBPassImport']);

class results
{
	public $ExDBCon = 0;
	public $ExException = "";
	public $ImDBCon = 0;
	public $ImException = "";
}
$conRes = new results();

try
{
	$DBExport = new PDO("mysql:host=localhost;dbname={$DBNameExport}", $DBUserExport, $DBPassExport);	
} catch (PDOException $e) 
{
	$conRes->ExDBCon = 1;
	$conRes->ExException = "Error with export database: " . $e->getMessage();
}

try 
{
	$DBImport = new PDO("mysql:host=localhost;dbname={$DBNameImport}", $DBUserImport, $DBPassImport);	
} catch (PDOException $e) 
{
	$conRes->ImDBCon = 1;
	$conRes->ImException = "Error with import database: " . $e->getMessage();
}

$DBExport = null;
$DBImport = null;

echo json_encode($conRes);