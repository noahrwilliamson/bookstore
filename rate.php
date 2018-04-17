<?php 
# rate.php
#
# Author: Noah Williamson
# Course: CS405G
# Final Project
#
# to handle rating books

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
echo '<nav class="navbar navbar-default">
  		<div class="container-fluid">
   			<div class="navbar-header">
      			<a class="navbar-brand" href="product.php"><span class="glyphicon glyphicon-home"></span>Bookstore</a>
    		</div>
    		<ul class="nav navbar-nav navbar-right">
      			<li><a href="my_account.php"><span class="glyphicon glyphicon-briefcase"></span>My Account</a></li>
      			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
    		</ul>
  		</div>
	</nav>';

if( isset( $_GET['id'] )){		# check to ensure we know what book to rate
	$bid = $_GET['id'];

	echo '
		<h1>Rate book</h1>
		<br>
		<div class="text-center">
			<form method="POST" action="addRate.php">
				<input type="text" name="bookid" value="' . $bid . '" readonly><br>
				<input type="text" name="rating" placeholder="Rating from 1 to 5..."><br>
				<textarea name="description" placeholder="Write a short description here..."><br>
				<button type="submit button" class="btn btn-primary">Add review</button><br>
			</form>
		</div>
	';
}
else {		# make sure to send back if they try to rate 
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
