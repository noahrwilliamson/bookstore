<?php
#logout.php
#
# Author: Noah Williamson
# to handle logging out of the bookstore

session_start();
session_destroy();

header('Location: index.html');		# redirect to home page

?>
