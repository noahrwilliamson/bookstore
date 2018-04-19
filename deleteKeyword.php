<?php
	$serverName='localhost'; // Host name
	$userName='root'; // Mysql username
	$password=''; // Mysql password
	$dbName = "bookstore";

	$conn = mysqli_connect($serverName, $userName, $password, $dbName);

	if(!$conn){
		die("Connection Failed: ".mysqli_connect_error());
	}

  if( isset( $_GET['id'] )) {
  	$kid = $_GET['id'];
  }

  $sql = "DELETE from keywords WHERE kid = $kid";


	if(mysqli_query($conn, $sql)){
		header('Location: admin_page.php'); // redirect to shopping page after inserting into database
	}
	else{
		echo "Error: ".mysqli_error($conn);
	}

	mysqli_close($conn);
?>
