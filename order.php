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



if( isset( $_GET['id'] )){
	$bid = $_GET['id'];
	$sql = 'SELECT * FROM books WHERE bid= "' . $_GET['id'] .'"';
	$res = mysqli_query($con, $sql); 	# get ordered book by id from books table in db
	$r = mysqli_fetch_assoc($res);


	echo '<h2>Order Success!</h2>';

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
	        					<br><p><a href="product.php" class="btn btn-primary" role="button">Continue Shopping</a></p>
	      					</div>
	    			</div>
	  			</div>
			';

	# now insert book into orders table
	# TODO: add way to get credit card number and billing/shipping address
	$osql = 'INSERT INTO orders(bookid, buyer, date, quantity, cost, status, credit_card_number, billing_address, shipping_address) 
				VALUES (' . $bid . ', ' . $_SESSION['uid'] . ', CURDATE(), 1, ' . $r['price'] . ', "ordered", 1234123412341234, "1234", "1234")';

	if(mysqli_query($con, $osql)){		# query successful
		echo '<p>Inserted into orders table with no problems</p>';
	}
	else{					# error
		echo "error in query " . mysqli_error($con);
	}
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
