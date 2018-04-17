<?php 
# addRate.php
#
# Author: Noah Williamson
# Course: CS405G
# Final Project
#
# to insert rating into the ratings table in database

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

if( isset( $_POST['bookid'] ) && isset( $_POST['rating'] ) && isset( $_POST['description'] )){		# check to ensure we know what book to rate
	$bid = $_POST['bookid'];
	$rate = $_POST['rating'];
	$desc = $_POST['description'];
	$uid = $_SESSION['uid'];

	$sql = 'INSERT INTO ratings (bookid, uid, rating, review) 
			VALUES ("' . $bid . '", "' . $uid . '", "' . $rate . '", "' . $desc . '")';
	
	mysqli_query($con, $sql);	# make query

	header('Location: product.php');	# go back to products
}
else{		# if not filled out redirect to rate.php page
	header('Location: rate.php?id=' . $_POST['bookid']);
}
?>