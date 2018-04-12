<?php
	ob_start();
	$host="localhost"; // Host name 
	$username="host"; // Mysql username 
	$password="123456"; // Mysql password 
	$db_name="bookstore"; // Database name 
	$tbl_name="users"; // Table name

	// Connect to server and select databse.
	$con = mysqli_connect("$host", "$username", "$password", "$db_name") or die(mysqli_error($con));
	echo "Connected to MySQL<br />";
	mysqli_select_db($con, "$db_name") or die(mysqli_error($con));
	echo "Connected to Database<br />";
	
	// Define $username and $password 
	$email=$_POST['email']; 
	$password=($_POST['password']);


	// To protect MySQL injection (more detail about MySQL injection)
	$email = stripslashes($email);
	$password = stripslashes($password);
	$email = mysqli_real_escape_string($con, $email);
	$password = mysqli_real_escape_string($con, $password);

	
	$sql = "SELECT * FROM $tbl_name WHERE email = '$email' and password = '$password'";
	$result=mysqli_query($con, $sql);

	// Mysql_num_row is counting table row
	$count=mysqli_num_rows($result);
	// If result matched $username and $password, table row must be 1 row
	if($count==1){
		echo "Login Successful";
		return true;
	}
	else{
		echo "Wrong Username or Password";
		return false;
}
?>