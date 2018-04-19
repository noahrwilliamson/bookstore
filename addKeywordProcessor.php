<?php
	$serverName='localhost'; // Host name
	$userName='root'; // Mysql username
	$password=''; // Mysql password
	$dbName = "bookstore";

	$conn = mysqli_connect($serverName, $userName, $password, $dbName);

	if(!$conn){
		die("Connection Failed: ".mysqli_connect_error());
	}

  $keyword = mysqli_real_escape_string($conn, $_POST["keyword"]);
  $bid = mysqli_real_escape_string($conn, $_POST["bid"]);

  $sql = "INSERT INTO keywords(bookid,keyword) VALUES ('$bid', '$keyword')";

	if(mysqli_query($conn, $sql)){
		header('Location: admin_edit_book.php?id=' . $bid); // redirect to shopping page after inserting into database
	}
	else{
		echo "Error: ".mysqli_error($conn);
	}

	mysqli_close($conn);
?>
