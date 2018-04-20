<?php

# admin.php
#
# Author: Blake Swaidner
# Course: CS405G
# Final Project
#
# Admin backend page


session_start();		# get session started

# connect to database
$con = mysqli_connect('localhost', 'root', '');
if (!$con){
    die("Database Connection Failed" . mysqli_error($con));
}

$select_db = mysqli_select_db($con, 'bookstore');

if (!$select_db){
    die("Database Selection Failed" . mysqli_error($con));
}

$sql = "SELECT * FROM books";
$sql2 = "SELECT * from users";
$res = mysqli_query($con, $sql);
$res2 = mysqli_query($con, $sql2);

# necessary bootstrap CSS imports
  echo    '<style> .column {
              float: left;
              width: 40%;
              margin: 40px;
          }

          /* Clear floats after the columns */
          .row:after {
              content: "";
              display: table;
              clear: both;
          }</style>';


  echo '
  		<html>
  			<head>
  				<title>Admin</title>

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
                <li class="nav-item active">
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

# display books with params set
function display() {
	global $res;
  global $res2;
  global $res3;
  echo '<html>
          <body>

          <form action="addBook.php" method="post">
          <button type="submit button" class="btn btn-primary">Add Book</button>
          </form>

          <div class = "row">
          <div class="column">
          <h2>Books</h2>';
		while($r = mysqli_fetch_assoc($res)) {		# loop through books and display
			echo '
	    			<div class="thumbnail">
	      				<img src="img.png" alt="' . $r['name'] . '" style="width:100px; height:100px">
	      					<div class="caption">
	        					<h5>' . $r['name'] . ' - ' . $r['authors'] . '</h5>
	        					<p>$' . $r['price'] . '</p>
	        					<p>' . $r['description'] . '</p>
	        					<p style="font-size:10px">Quantity:&nbsp' . $r['quantity'] . '</p>
	        					<p><a href="admin_edit_book.php?id=' . $r['bid'] .'" class="btn btn-primary" role="button">Edit</a></p>
	      					</div>
	    			</div>';
    }
    echo '</div>
    <div class="column">
    <h2>Users</h2>';

    while($r = mysqli_fetch_assoc($res2)) {
      $admin = "User";
      if ($r['admin'] == 1) {
        $admin = "Admin";
      }
      echo'
                <h5>' . $r['firstName'] . " " . $r['middleName'] . " " . $r['lastName'] . '</h5>
                <p>' . $admin . '</p>
                <p><a href="admin_edit_user.php?id=' . $r['uid'] .'" class="btn btn-primary" role="button">Edit</a></p>
			';

	   }


}
display();

echo '</div></div></body></html>';		# finish up body and html tags

?>
