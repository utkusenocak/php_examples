<?php
function connection($db){
	$servername = "localhost";
	$username = "root";
	$conn = new PDO("mysql:host=$servername;dbname=$db", $username);
	$conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $conn;
}
function db_create($name){
	$servername = "localhost";
	$username = "root";
	try {
		$conn = new PDO("mysql:host=$servername", $username);
		$conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE DATABASE $name";
		$conn ->exec($sql);
		echo "Database Created Succsessfuly<br>";

	}
	catch(PDOException $e){
		echo $e ->getMessage();
	}
	finally{
		$conn = null;
	}
}
function db_insert(){
	try{
		$conn = connection("myDB");
		$conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn ->beginTransaction();
		$conn ->exec("INSERT INTO MyGuests(firstname, lastname, email) 
			VALUES ('John', 'Doe', 'john@example.com')");
		$conn ->exec("INSERT INTO MyGuests(firstname, lastname, email) 
			VALUES ('Mary', 'Moe', 'mary@example.com')");
		$conn ->exec("INSERT INTO MyGuests(firstname, lastname, email) 
			VALUES ('Julie', 'Dooley', 'julie@example.com')");
		$conn ->commit();
		echo "New records created Succsessfuly";
	}
	catch(PDOException $e){
		$conn ->rollback();
		echo $e ->getMessage();
	}
	finally{
		$conn = null;
	}
}
function db_create_table($name){
	try{
		$conn = connection("myDB");
		$conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE TABLE $name(
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				firstname VARCHAR(30) NOT NULL,
				lastname VARCHAR(30) NOT NULL,
				email VARCHAR(50),
				reg_date TIMESTAMP)";
		$conn ->exec($sql);
		echo "Table ".$name." created Succsessfuly";

	}
	catch (PDOException $e){
		$e ->getMessage();
	}
	finally{
		$conn = null;
	}
}
function db_insert2($name, $lname, $mail){
	try{
		$conn = connection("myDB");
		$stmt = $conn ->prepare("INSERT INTO MyGuests (firstname, lastname, email)
			VALUES (:firstname, :lastname, :email)");
		$stmt ->bindParam(":firstname", $name);
		$stmt ->bindParam(":lastname", $lname);
		$stmt ->bindParam(":email", $mail);
		
		$stmt ->execute();
		echo "New Records created Succsessfuly";
		
	}
	catch(PDOException $e){
		echo $e ->getMessage();
	}
}


function list_db(){
	echo "<table style='border: solid 1px black;'>";
	echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th>";
	class TableRows extends RecursiveIteratorIterator{
		function __construct($it){
			parent::__construct($it, self::LEAVES_ONLY);
		}
		function current(){
			return "<td style='width: 150px;border: 1px solid black;'>".parent::current()."</td>";
		}
		function beginChildren(){
			echo "<tr>";
		}
		function endChildren(){
			echo "</tr>"."\n";
		}
	}
	try{
		$conn = connection("myDB");
		$stmt = $conn ->prepare("SELECT id, firstname, lastname FROM MyGuests");
		$stmt ->execute();

		$result = $stmt ->setFetchMode(PDO::FETCH_ASSOC);
		foreach (new TableRows(new RecursiveArrayIterator($stmt ->fetchAll() ) ) as $key => $value) {
			echo $value;
		}
	}
	catch (PDOException $e){
		echo $e ->getMessage();
	}
	finally{
		$conn = null;
		echo "</table>";
	}
}
function delete_db($name){
	try{
		$conn = connection("myDB");
		$sql = "DELETE FROM MyGuests WHERE firstname='$name'";
		$conn ->exec($sql);
		echo "Record deleted succsessfuly";
	}
	catch(PDOException $e){
		echo $e ->getMessage();
	}
	finally {
		$conn = null;
	}
}
delete_db("utku");


?>