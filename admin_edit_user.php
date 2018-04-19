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
				<title>Edit User</title>

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
	$sql = 'SELECT * FROM users WHERE uid= "' . $_GET['id'] .'"';
	$res = mysqli_query($con, $sql); 	# get ordered book by id from books table in db
	$r = mysqli_fetch_assoc($res);



	echo '<h2>Edit User</h2>';
	echo '
  		<div>
  			<form action="updateUser.php" method="post">
          User ID: <input type="text" name = "uid" value="'. $r['uid']. '"readonly> <br/>
          First Name: <input type="text" name = "firstName" value="'. $r['firstName']. '"> <br/>
          Middle Name: <input type="text" name = "middleName" value="'. $r['middleName']. '"> <br/>
        	Last Name: <input type="text" name = "lastName" value="'. $r['lastName']. '"> <br/>
          Email: <input type="text" name = "email" value="'. $r['email']. '"> <br/>
          Password: <input type="text" name = "password" value="'. $r['password']. '"> <br/>
          Age: <input type="text" name = "age" value="'. $r['age']. '"> <br/>
          Gender: <input type="text" name = "gender" value="'. $r['gender']. '"> <br/>';

          if ($r['admin'] == 1) {
              echo '<input type="hidden" value="0" name="admin">
              Admin: <input type="checkbox" name = "admin" value= "1" checked = "checked"> <br/>';

          } else {
              echo '<input type="hidden" value="0" name="admin">
              Admin: <input type="checkbox" name = "admin" value= "1"'. $r['admin'].'"> <br/>';
          }
          echo'
          <button type="submit button" name = "button" class="btn btn-primary" value = "Update">Update</button>
          <button type="submit button" name = "button" class="btn btn-primary" value = "Delete">Delete</button>
  			</form>
  		</div>
  	</body>
  </html>';
}
?>
