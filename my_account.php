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
		echo '<head><title>My Account</title>
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
				<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
			</head><body>
		';

		# add navbar
		echo '
			<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    			<div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        			<ul class="navbar-nav mr-auto">
            			<li class="nav-item">
                			<a class="nav-link" href="product.php">Books</a>
        	    		</li>
        			</ul>
    			</div>
    			<div class="mx-auto order-0">
        			<a class="navbar-brand mx-auto" href="#">Group 3 Bookstore</a>
        			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            			<span class="navbar-toggler-icon"></span>
        			</button>
    			</div>
    			<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        			<ul class="navbar-nav ml-auto">
            			<li class="nav-item active">
                			<a class="nav-link" href="my_account.php"><span class="glyphicon glyphicon-briefcase"></span>My Account</a>
            			</li>
            			<li class="nav-item">
                			<a class="nav-link" href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a>
            			</li>
        			</ul>
    			</div>
    		</nav>';

    	$usql = 'SELECT firstName FROM users WHERE uid=' . $_SESSION['uid'];
    	$uresult = mysqli_query($conn, $usql);
    	$udata = mysqli_fetch_assoc($uresult);
    	echo '
    		<div class = "text-center">
    			<h4>Hi ' . $udata['firstName'] . ', here are your past orders:</h4>
    		</div>
    	';

		$sql = "SELECT * FROM orders WHERE buyer=" . $_SESSION['uid'];
		$res = mysqli_query($conn, $sql);

		while($r = mysqli_fetch_assoc($res)) {	# loop through orders and display
			
			$tsql = 'SELECT name FROM books WHERE bid=' . $r['bookid'];
			$tres = mysqli_query($conn, $tsql);
			$tdata = mysqli_fetch_assoc($tres);		# get book title

			echo "<h6>" . $tdata['name'] . "</h6>";
			echo "<p>Date Ordered: " . $r['date'] . "</p>";
			echo "<p>Quantity: " . $r['quantity'] . "</p>";
			echo "<p>Amount paid: " . $r['cost'] . "</p>";
			echo "<p>Order Status: " . $r['status'] . "</p>";
			echo "<p>Payment Method: card ending in " . substr($r['credit_card_number'], -4) . "</p>";
			echo "<p>Billing Address: " . $r['billing_address'] . "</p>";
			echo "<p>Shipping Address: " . $r['shipping_address'] . "</p><br><br>";
		}
		
	mysqli_close($conn);
	
?>
</body>
</html>
