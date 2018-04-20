<?php
# order.php
#
# Author: Noah Williamson
# Course: CS405G
# Final Project
#
# to handle ordering after user clicks order button while viewing products

session_start();		# get session started

# connect to database
$con = mysqli_connect('localhost', 'root', '');
if (!$con){
    die("Database Connection Failed" . mysqli_error($connection));
}

$select_db = mysqli_select_db($con, 'bookstore');

if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}

# necessary bootstrap CSS imports
echo '
		<html>
			<head>
				<title>Order</title>

				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
				<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
			</head>
			<body>
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
            		<li class="nav-item">
                		<a class="nav-link" href="my_account.php"><span class="glyphicon glyphicon-briefcase"></span>My Account</a>
            		</li>
            		<li class="nav-item">
                		<a class="nav-link" href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a>
            		</li>
        		</ul>
    		</div>
    	</nav>';


if( isset( $_GET['id'] ) && isset($_POST['cc'] ) && isset( $_POST['shipAddr'] ) && isset($_POST['billAddr']) ){
	$billing = $_POST['billAddr'];
	$shipping = $_POST['shipAddr'];		# billing and shipping addresses
	$ccNum = $_POST['cc'];				# credit card number, TODO: hash this!
	
	$bid = $_GET['id'];
	
	$sql = 'SELECT * FROM books WHERE bid= "' . $_GET['id'] .'"';
	$res = mysqli_query($con, $sql); 	# get ordered book by id from books table in db
	$r = mysqli_fetch_assoc($res);


	echo '<h2>Order Success!</h2>';

	echo '	<h5>Order details:</h5>
				<div class="col-sm-6 col-md-3">
	    			<div class="thumbnail">
	      				<img src="img.png" alt="' . $r['name'] . '" style="width:100px; height:100px">
	      					<div class="caption">
	        					<h5>' . $r['name'] . ' - ' . $r['authors'] . '</h5>
	        					<p>$' . $r['price'] . '</p>
	        					<p>' . $r['description'] . '</p>
	        					<p style="font-size:10px">Quantity:&nbsp' . $r['quantity'] . '</p>
	        					<p style="font-size:10px"> ISBN:&nbsp' . $r['isbn'] . '</p>
	        					<p style="font-size:10px"> Subject:&nbsp' . $r['subject'] . '</p>
	        					<p style="font-size:10px"> Language:&nbsp' . $r['language'] . '</p>
	        					<p style="font-size:10px"> Publisher:&nbsp' . $r['publisher'] . '</p>
	        					<p style="font-size:10px"> Publish Date:&nbsp' . $r['publishdate'] . '</p>
	        					<br><p><a href="product.php" class="btn btn-primary" role="button">Continue Shopping</a></p>
	      					</div>
	    			</div>
	  			</div>
			';

	# now insert book into orders table
	# TODO: add way to get credit card number and billing/shipping address
	$osql = 'INSERT INTO orders(bookid, buyer, date, quantity, cost, status, credit_card_number, billing_address, shipping_address) 
				VALUES (' . $bid . ', ' . $_SESSION['uid'] . ', CURDATE(), 1, ' . $r['price'] . ', "ordered",' . $ccNum . ', "' . $billing . '", "' . $shipping . '")';

	if(mysqli_query($con, $osql)){		# query successful
		echo '<p>Thank you for your order.</p>';
	}
	else{					# error
		echo "error in query " . mysqli_error($con);
	}
}
elseif( isset( $_GET['id'] ) ){
	$bid = $_GET['id'];
	$sql = 'SELECT * FROM books WHERE bid= "' . $bid . '"';
	$res = mysqli_query($con, $sql); 	# get book to order by id from books table in db
	$r = mysqli_fetch_assoc($res);


	echo '<h2>Confirm Order</h2>';

	echo '
				<div class="col-sm-6 col-md-3">
	    			<div class="thumbnail">
	      				<img src="img.png" alt="' . $r['name'] . '" style="width:100px; height:100px">
	      					<div class="caption">
	        					<h5>' . $r['name'] . ' - ' . $r['authors'] . '</h5>
	        					<p>$' . $r['price'] . '</p>
	        					<p>' . $r['description'] . '</p>
	        					<p style="font-size:10px">Quantity:&nbsp' . $r['quantity'] . '</p>
	        					<p style="font-size:10px"> ISBN:&nbsp' . $r['isbn'] . '</p>
	        					<p style="font-size:10px"> Subject:&nbsp' . $r['subject'] . '</p>
	        					<p style="font-size:10px"> Language:&nbsp' . $r['language'] . '</p>
	        					<p style="font-size:10px"> Publisher:&nbsp' . $r['publisher'] . '</p>
	        					<p style="font-size:10px"> Publish Date:&nbsp' . $r['publishdate'] . '</p>
	      					</div>
	    			</div>
	  			</div>
			';

		echo '
			<div class="text-center">
			<form method="POST" action="order.php?id=' . $bid . '">
				<input type="text" name="cc" placeholder="Credit Card Number"><br>
				<input type="text" name="billAddr" placeholder="Billing Address"><br>
				<input type="text" name="shipAddr" placeholder="Shipping Address"><br>
				<button type="submit button" class="btn btn-primary">Confirm Order</button><br>
			</form>
			</div>
			';
}
else{
	echo '
		<div class="text-center">
			<h1>Oops!</h1>
			<p>Looks like you took a wrong turn.</p>
			<p><a href="product.php" class="btn btn-primary" role="button">Continue Shopping</a></p>
		</div>
	';
}

echo '</body></html>';


?>
