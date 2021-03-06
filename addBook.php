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
				<title>Add Book</title>

				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
				<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
			</head>
			<body>';

# add navbar
  echo '
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="admin_page.php">Admin</a>
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
                    <a class="nav-link" href="admin_page.php"><span class="glyphicon glyphicon-briefcase"></span>Manager Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a>
                </li>
            </ul>
        </div>
      </nav>';

	echo '<h2>Add Book</h2>';
	echo '
  		<div>
  			<form action="addBookProcessor.php" method="post">
          ISBN: <input type="text" name = "isbn" placeholder="0123456789"> <br/>
          Name: <input type="text" name = "name" placeholder="Title"> <br/>
        	Authors: <input type="text" name = "authors" placeholder="John Smith"> <br/>
          Subject: <input type="text" name = "subject" placeholder="Math"> <br/>
          Description: <input type="text" name = "description" placeholder="This book is about Math"> <br/>
          Language: <input type="text" name = "language" placeholder="English"> <br/>
          Publisher: <input type="text" name = "publisher" placeholder="Scholastic"> <br/>
          Publish Date: <input type="text" name = "publishdate" placeholder="0000-00-00"> <br/>
          Price: <input type="text" name = "price" placeholder="20"> <br/>
          Quantity: <input type="text" name = "quantity" placeholder="5"> <br/>
    			<button type="submit button" name = "button" class="btn btn-primary" value = "Update">Add</button>
  			</form>
  		</div>
  	</body>
  </html>';

?>
