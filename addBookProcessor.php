<?php
	$serverName='localhost'; // Host name
	$userName='root'; // Mysql username
	$password=''; // Mysql password
	$dbName = "bookstore";

	$conn = mysqli_connect($serverName, $userName, $password, $dbName);

	if(!$conn){
		die("Connection Failed: ".mysqli_connect_error());
	}

  $isbn = mysqli_real_escape_string($conn, $_POST["isbn"]);
  $name = mysqli_real_escape_string($conn, $_POST["name"]);
	$authors = mysqli_real_escape_string($conn, $_POST["authors"]);
	$subject = mysqli_real_escape_string($conn, $_POST["subject"]);
	$description = mysqli_real_escape_string($conn, $_POST["description"]);
	$language = mysqli_real_escape_string($conn, $_POST["language"]);
	$publisher = mysqli_real_escape_string($conn, $_POST["publisher"]);
	$publishdate = mysqli_real_escape_string($conn, $_POST["publishdate"]);
	$price = mysqli_real_escape_string($conn, $_POST["price"]);
  $quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);
  $button = mysqli_real_escape_string($conn, $_POST["button"]);

  $sql = "INSERT INTO books(name, isbn, authors, subject, description, language, publisher, publishdate, price, quantity)
       VALUES ('$name', '$isbn', '$authors', '$subject', '$description' , '$language' , '$publisher', '$publishdate', '$price' ,'$quantity')";

	if(mysqli_query($conn, $sql)){
		header('Location: admin_page.php'); // redirect to shopping page after inserting into database
	}
	else{
		echo "Error: ".mysqli_error($conn);
	}

	mysqli_close($conn);
?>
