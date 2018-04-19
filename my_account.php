<html>
	<?php
		session_start();
	
		$conn = mysqli_connect('localhost', 'root', '');
		if (!$conn){
    			die("Database Connection Failed" . mysqli_error($connection));
		}
		$select_db = mysqli_select_db($conn, 'bookstore');
		if (!$select_db){
    			die("Database Selection Failed" . mysqli_error($connection));
		}
	
		# necessary bootstrap imports
		echo '<head><title>My orders</title>
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
				<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
			</head><body>
		';

		# add navbar
		echo '<nav class="navbar navbar-default">
  				<div class="container-fluid">
    				<div class="navbar-header">
      					<a class="navbar-brand" href="product.php"><span class="glyphicon glyphicon-home"></span>Bookstore</a>
    				</div>
    				<ul class="nav navbar-nav navbar-right">
      					<li class="active"><a href="my_account.php"><span class="glyphicon glyphicon-briefcase"></span>My Account</a></li>
      					<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
    				</ul>
  				</div>
			</nav>';

		# $email = mysqli_real_escape_string($conn, $_POST["email"]);
		$sql = "SELECT * FROM orders WHERE buyer=" . $_SESSION['uid'];
		$res = mysqli_query($conn, $sql);

		echo '<h2>Order History</h2><br>';

		while($r = mysqli_fetch_assoc($res)) {	# loop through orders and display
			echo "<p>bookid: ".$r['bookid']."</p>";
			echo "<p>Quantity: ".$r['quantity']."</p>";
			echo "<p>Cost: ".$r['cost']."</p>";
			echo "<p>Status: ".$r['status']."</p>";
			echo "<p>Credit Card: ".$r['credit_card_number']."</p>";
			echo "<p>Billing Address: ".$r['billing_address']."</p>";
			echo "<p>Shipping Address: ".$r['shipping_address']."</p>";
		}
		/*$rows = mysqli_fetch_array($results0);
		for($i=0; $i<sizeof($rows); $i++){
		$history= "SELECT bookid, buyer, date, quantity, cost, status, credit_card_number, billing_address, shipping_address FROM orders WHERE buyer='$rows[$i]'";
		$results = mysqli_query($conn, $history);
	
	echo "<h1> Order History </h1><br/>";

	for($i=0; $i<sizeof($rows)-1; $i++){		
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
	}*/
	mysqli_close($conn);
	
?>
</body>
</html>
