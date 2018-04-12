<html>
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

		$email = mysqli_real_escape_string($conn, $_POST["email"]);
		$uid = "SELECT uid FROM users WHERE email='$email'";
		$results0 = mysqli_query($conn, $uid);
		$rows = mysqli_fetch_array($results0);
		for($i=0; $i<sizeof($rows)-1; $i++){
		$history= "SELECT bookid, buyer, date, quantity, cost, status, credit_card_number, billing_address, shipping_address FROM orders WHERE buyer='$rows[$i]'";
		$results = mysqli_query($conn, $history);

		if(mysqli_num_rows($results)>0){
			$row = mysqli_fetch_assoc($results);
			echo "<h1> Order History </h1><br/>";
			echo "bookid: ".$row["bookid"]."<br/>";
			echo "Quantity: ".$row["quantity"]."<br/>";
			echo "Cost: ".$row["cost"]."<br/>";
			echo "Status: ".$row["status"]."<br/>";
			echo "Credit Card: ".$row["credit_card_number"]."<br/>";
			echo "Billing Address: ".$row["billing_address"]."<br/>";
			echo "Shipping Address: ".$row["shipping_address"]."<br/>";

		}
		else{
			echo "No order history for user";
	}
}
	mysqli_close($conn);
	?>
</body>
</html>