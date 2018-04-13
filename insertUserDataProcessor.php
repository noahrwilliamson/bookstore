<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body>
	<?php
		$serverName = "127.0.0.1";
		$userName = "user1";
		$password = "user1pwd";
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
			echo "Query Successful!";
		}
		else{
			echo "Error: ".mysqli_error($conn);
		}
		mysqli_close($conn);
	?>

</body>
</html>
