<?php
	require 'DataBaseApi.php';

	//database connection information
	$database = 'C:/xampp/mysql/data/mondial';
	$user = 'root';
	$pw = '';
	$host = 'localhost';
 
	// sql query
	$sql = "SELECT * FROM city";

	$dataBaseObj = new DataBaseApi($database, $user, $pw, $host);
	if($dataBaseObj->getDBLink())
	{
		$dataBaseObj->queryDatbase($sql);
	}
?>