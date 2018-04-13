<html>
	<?php
		/*$serverName = "127.0.0.1";
		$userName = "user1";
		$password = "user1pwd";
		$dbName = "bookstore";

		$conn = mysqli_connect($serverName, $userName, $password, $dbName);

		if(!$conn){
			die("Connection Failed: ".mysqli_connect_error());
		}
		*/
	
		$conn = mysqli_connect('localhost', 'root', '');
		if (!$conn){
    			die("Database Connection Failed" . mysqli_error($connection));
		}
		$select_db = mysqli_select_db($conn, 'bookstore');
		if (!$select_db){
    			die("Database Selection Failed" . mysqli_error($connection));
		}
	
		echo '<head><title>My orders</title>
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
				<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
			</head><body>
		';

		$email = mysqli_real_escape_string($conn, $_POST["email"]);
		$uid = "SELECT uid FROM users WHERE email='$email'";
		$results0 = mysqli_query($conn, $uid);
		$rows = mysqli_fetch_array($results0);
		for($i=0; $i<sizeof($rows); $i++){
		$history= "SELECT bookid, buyer, date, quantity, cost, status, credit_card_number, billing_address, shipping_address FROM orders WHERE buyer='$rows[$i]'";
		$results = mysqli_query($conn, $history);
	
	echo "<h1> Order History </h1><br/>";

	for($i=0; $i<sizeof($rows); $i++){		
		if(mysqli_num_rows($results)>0){
			$row = mysqli_fetch_assoc($results);
			echo "bookid: ".$row["bookid"]."<br/>";
			echo "Quantity: ".$row["quantity"]."<br/>";
			echo "Cost: ".$row["cost"]."<br/>";
			echo "Status: ".$row["status"]."<br/>";
			echo "Credit Card: ".$row["credit_card_number"]."<br/>";
			echo "Billing Address: ".$row["billing_address"]."<br/>";
			echo "Shipping Address: ".$row["shipping_address"]."<br/>";

		}
	}
}
	mysqli_close($conn);
	
?>
</body>
</html>
