<?php
$servername = "localhost";
try {
	$conn = new PDO("mysql:host=".$servername.";dbname=test;", "root");
	$conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "Connection succsessfully";
}
catch (PDOException $e){
	echo "Connection failed: ".$e ->getMessage();
	#$conn = null; 
}
    
?>