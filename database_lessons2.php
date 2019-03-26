<?php
//Creating database
//First let's create a connection
$servername = "localhost";
$username = "root";
try {
	$conn = new PDO("mysql:host=$servername", $username);
	$conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "CREATE DATABASE  myDB ";
	$conn ->exec($sql);
	echo "Database created succsessfuly<br>";
}
catch(PDOException $e){
	echo $e ->getMessage();

}
$conn = null;
?>