<?php
$host = "localhost"; 
$user = "gwadaron_shopvox"; 
$password = "admin$$123"; 
$database = "gwadaron_woocom"; 
 
// Connect to MySQL Database
$con = new mysqli($host, $user, $password, $database);
 
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>
  
<?php

	$DB_HOST = 'localhost';
	$DB_USER = 'gwadaron_shopvox';
	$DB_PASS = 'admin$$123';
	$DB_NAME = 'gwadaron_woocom';
	
	try{
		$DB_con = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}",$DB_USER,$DB_PASS);
		$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	
?>