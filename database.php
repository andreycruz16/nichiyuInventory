<?php 
	error_reporting(0); //Turn off php error reporting (use this for deployment)
	date_default_timezone_set('Asia/Manila');
	$server_name   = "localhost";
	$username      = "root";
	$password      = "";
	$database_name = "db_nichiyu_june2017";

	$conn = mysqli_connect($server_name, $username, $password, $database_name) or die(mysql_error());
 ?>