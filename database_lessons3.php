<?php
$servername = "localhost";
$username = "root";
try {
	$conn = new PDO("mysql:host=$servername;dbname=myDB", $username);

	$conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "CREATE TABLE  MyGuests (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			firstname VARCHAR(30) NOT NULL,
			lastname VARCHAR(30) NOT NULL,
			email VARCHAR(50),
			reg_date TIMESTAMP)";
	$conn ->exec($sql);
	echo "Table MyGuests created succsessfuly";
}
catch (PDOException $e){
	echo $e ->getMessage();
}
finally {
	$conn = NULL;
}
function silme(){
	$servername = "localhost";
	$username = "root";
	try {
		$conn = new PDO("mysql:host=$servername", $username);
		$conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DROP DATABASE myDB";
		$conn ->exec($sql);
		echo "Deleting Succsessfuly";
	}
	catch (PDOException $e){
		echo $e ->getMessage();
	}
}
silme();



?>