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
				<title>Add Keyword</title>

				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
				<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
			</head>
			<body>';

# add navbar
echo '<nav class="navbar navbar-default">
  		<div class="container-fluid">
   			<div class="navbar-header">
      			<a class="navbar-brand" href="product.php"><span class="glyphicon glyphicon-home"></span>Bookstore</a>
    		</div>
    		<ul class="nav navbar-nav navbar-right">
      			<li><a href="my_account.php"><span class="glyphicon glyphicon-briefcase"></span>My Account</a></li>
      			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
            <li><a href="admin_page.php">Admin Home</a></li>
    		</ul>
  		</div>
	</nav>';

  if( isset( $_GET['id'] )) {
  	$bid = $_GET['id'];
  }

	echo '<h2>Add Keyword</h2>';
	echo '
  		<div>
  			<form action="addKeywordProcessor.php" method="post">
          Book ID: <input type="text" name = "bid" value=" '. $bid . '"readonly> <br/>
          Keyword: <input type="text" name = "keyword" placeholder="science"> <br/>
    			<button type="submit button" name = "button" class="btn btn-primary" value = "Update">Add</button>
  			</form>
  		</div>
  	</body>
  </html>';

?>
