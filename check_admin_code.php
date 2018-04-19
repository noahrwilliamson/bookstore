<?php
	session_start();
	ob_start();

	$host='localhost'; // Host name
	$username='root'; // Mysql username
	$password=''; // Mysql password
	$db_name='bookstore'; // Database name
	$tbl_name='users'; // Table name

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


	$sql = "SELECT * FROM $tbl_name WHERE email = '$email' AND password = '$password' AND admin= TRUE";
	$result=mysqli_query($con, $sql);

	// Mysql_num_row is counting table row
	$count=mysqli_num_rows($result);
	// If result matched $username and $password, table row must be 1 row
	if($count==1){
		$r = mysqli_fetch_assoc($result);
		$_SESSION['uid'] = $r['uid'];		# let's set our session variable

		echo "Login Successful";
		header('Location: admin_page.php'); // redirect to shopping page after inserting into database
	}
	else{
		echo "Wrong Username or Password";
	}
?>
