<?php
	$serverName='localhost'; // Host name
	$userName='root'; // Mysql username
	$password=''; // Mysql password
	$dbName = "bookstore";

	$conn = mysqli_connect($serverName, $userName, $password, $dbName);

	if(!$conn){
		die("Connection Failed: ".mysqli_connect_error());
	}

  $uid = mysqli_real_escape_string($conn, $_POST["uid"]);
  $firstName = mysqli_real_escape_string($conn, $_POST["firstName"]);
	$middleName = mysqli_real_escape_string($conn, $_POST["middleName"]);
	$lastName = mysqli_real_escape_string($conn, $_POST["lastName"]);
	$email = mysqli_real_escape_string($conn, $_POST["email"]);
	$password = mysqli_real_escape_string($conn, $_POST["password"]);
	$age = mysqli_real_escape_string($conn, $_POST["age"]);
	$gender = mysqli_real_escape_string($conn, $_POST["gender"]);
	$admin = mysqli_real_escape_string($conn, $_POST["admin"]);
  $button = mysqli_real_escape_string($conn, $_POST["button"]);

  $sql = "";
  if ($button == "Delete") {
    $sql = "DELETE from users WHERE uid = $uid";
  } else {
    $sql = "UPDATE users
            SET firstName = '$firstName', middleName = '$middleName', lastName = '$lastName', email = '$email', password = '$password', age = '$age', gender = '$gender', admin = '$admin'
            WHERE uid = $uid";
  }

	if(mysqli_query($conn, $sql)){
		header('Location: admin_page.php'); // redirect to shopping page after inserting into database
	}
	else{
		echo "Error: ".mysqli_error($conn);
	}

	mysqli_close($conn);
?>
