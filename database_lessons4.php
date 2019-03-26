<?php
$servername = "localhost";
$username = "root";
$databasename = "myDB";
try {
	$conn = new PDO("mysql:host=$servername;dbname=$databasename;", $username);

	$conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO MyGuests (firstname, lastname, email)
			VALUES('John', 'Doe', 'john@example.com')";
	//$conn ->exec($sql);
	$last_id = $conn ->lastInsertId();
	echo "New record created succsessfuly ".$last_id;
}
catch(PDOException $e){
	echo $e ->getMessage();
}
finally{
	$conn = null;
}

?>