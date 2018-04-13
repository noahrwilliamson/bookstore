<?php
	$serverName='localhost'; // Host name 
	$userName='root'; // Mysql username 
	$password=''; // Mysql password 
	$dbName = "bookstore";

	$conn = mysqli_connect($serverName, $userName, $password, $dbName);

	if(!$conn){
		die("Connection Failed: ".mysqli_connect_error());
	}

	$first = mysqli_real_escape_string($conn, $_POST["first"]);
	$middle = mysqli_real_escape_string($conn, $_POST["middle"]);
	$last = mysqli_real_escape_string($conn, $_POST["last"]);
	$gender = mysqli_real_escape_string($conn, $_POST["gender"]);
	$age = mysqli_real_escape_string($conn, $_POST["age"]);
	$email = mysqli_real_escape_string($conn, $_POST["email"]);
	$password = mysqli_real_escape_string($conn, $_POST["password"]);
	
	$sql = "INSERT INTO users(firstName, middleName, lastName, age, gender, email, password) VALUES('$first', '$middle', '$last', '$age', '$gender', '$email', '$password')";

	if(mysqli_query($conn, $sql)){
		header('Location: product.php'); // redirect to shopping page after inserting into database
	}
	else{
		echo "Error: ".mysqli_error($conn);
	}
	
	mysqli_close($conn);
?>
