<?php

# product.php
# 
# Author: Noah Williamson
# Course: CS405G
# Final Project
#
# Products page to display all available products and allow a faceted search.


# connect to database
$con = mysqli_connect('localhost', 'root', '');
if (!$con){
    die("Database Connection Failed" . mysqli_error($connection));
}

$select_db = mysqli_select_db($con, 'bookstore');

if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}
	
$sql = "SELECT * FROM books";
$res = mysqli_query($con, $sql); 	# get all books from books table in db

# display search feature
function drawSearchForm() {

	# add link to user account in the top right corner, start html output
	echo '
		<html>
			<head>
				<title>Products</title>

				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
				<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

				<style type="text/css">
 					.topcorner{
   						position:absolute;
   						top:0;
   						right:0;
  					}
  					#hr{
    					width: 95%
    					font-size: 1px;
    					color: rgba(0, 0, 0, 0);
    					line-height: 1px;

    					background-color: grey;
    					margin-top: -6px;
    					margin-bottom: 10px;
    				}
				</style>
			</head>
			<body>
			<div class="topcorner"><a href="my_account.php">My Account</a></div>';   # link to my account page
	
	echo '
		<br>
		<div class="text-center">
			<form method="POST" action="product.php">
				<input type="text" name="searchTerm" placeholder="Search...">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
				<input type="radio" name="searchType" value="title">Title&nbsp
				<input type="radio" name="searchType" value="authors">Author&nbsp
				<input type="radio" name="searchType" value="subject">Subject&nbsp
				<input type="radio" name="searchType" value="keyword">Keyword&nbsp
				<input type="radio" name="searchType" value="date">Date&nbsp
				<input type="radio" name="searchType" value="price">Price&nbsp&nbsp
				<button type="submit button" class="btn-xs btn-primary">Search!</button><br><br>

				<hr>
			</form>
		</div>';		# search bar form
}

# display books with params set
function displayBooks($searchTerm, $searchType) {
	global $res;

	if($searchTerm == "" || $searchType == "") {		# if searchTerm or searchType is empty, display all books
		echo '<h2>All books:</h2><br>';
		while($r = mysqli_fetch_assoc($res)) {		# loop through books and display
			echo '
				<div class="col-sm-6 col-md-3">
	    			<div class="thumbnail">
	      				<img src="img.png" alt="' . $r['name'] . '" style="width:100px; height:100px">
	      					<div class="caption">
	        					<h5>' . $r['name'] . ' - ' . $r['authors'] . '</h5>
	        					<p>$' . $r['price'] . '</p>
	        					<p>' . $r['description'] . '</p>
	        					<p><a href="order.php?id=' . $r['bid'] .'" class="btn btn-primary" role="button">Order</a></p>
	      					</div>
	    			</div>
	  			</div>
			';
		}

	}
	else {					# attempt to display books with specified search terms
		
		global $con;
		$sql = 'SELECT * FROM books ';

		switch ($searchType) {			# append WHERE clause to SQL statement based on searchType
			case "title":
				$sql .= 'WHERE name LIKE "%' . $searchTerm . '%"';
				break;

			case "authors":
				$sql .= 'WHERE authors LIKE "%' . $searchTerm . '%"';
				break;

			case "subject":
				$sql .= 'WHERE subject LIKE "%' . $searchTerm . '%"';
				break;

			case "keyword":
				$sql .= '';
				break;

			case "date":
				$sql .= 'WHERE date LIKE "%' . $searchTerm . '%"';
				break;

			case "price":
				$sql .= 'WHERE price LIKE "%' . $searchTerm . '%"';
				break;

		}

		$result = mysqli_query($con, $sql);			# now query for search term

		echo '<h2>Books with ' . ( ucfirst($searchType) ) . ' matching "' . $searchTerm . '" : </h2><br>';

		while($r = mysqli_fetch_assoc($result)) {		# loop through resultant book array and display
			echo '
				<div class="col-sm-6 col-md-3">
	    			<div class="thumbnail">
	      				<img src="img.png" alt="' . $r['name'] . '" style="width:100px; height:100px">
	      					<div class="caption">
	        					<h5>' . $r['name'] . ' - ' . $r['authors'] . '</h5>
	        					<p>$' . $r['price'] . '</p>
	        					<p>' . $r['description'] . '</p>
	        					<p><a href="order.php?id=' . $r['bid'] .'" class="btn btn-primary" role="button">Order</a></p>
	      					</div>
	    			</div>
	  			</div>
			';
		}

	}
}

drawSearchForm();	# draw search form

if( isset($_POST['searchTerm']) && isset($_POST['searchType']) ) { 		# check if search param is set

	$searchTermInput = $_POST['searchTerm'];
	$searchTypeInput = $_POST['searchType'];

	displayBooks($searchTermInput, $searchTypeInput);
}
else {			# otherwise send an empty string to display books
	$searchTermInput = "";
	$searchTypeInput = "";

	displayBooks($searchTermInput, $searchTypeInput);
}

echo '</body></html>';		# finish up body and html tags

?>
