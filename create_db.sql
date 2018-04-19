/*
 * Author: Noah Williamson
 *
 */

/* drop previous instance of database */
DROP DATABASE IF EXISTS bookstore;

/* create fresh bookstore database and use it */
CREATE DATABASE bookstore;
USE bookstore;


/*-----------------------------------------------------------------------------------------------------------------------------------------
  bid         -> book ID is the primary key for the book
  name        -> title of book
  isbn        -> ISBN number of book
  authors     -> author(s) of book
  subject     -> subject of book (1 subj. only, e.g. science)
  description -> short description of book
  language    -> language book is written in
  publisher   -> name of company that published book
  publishdate -> date book was published in YYYY-MM-DD format
  price       -> price of book in USD
  quantity    -> on hand quantity of book
-------------------------------------------------------------------------------------------------------------------------------------------
*/
CREATE TABLE books(
	bid INT(11) PRIMARY KEY AUTO_INCREMENT, 
	name VARCHAR(100), 
	isbn VARCHAR(17), 
	authors VARCHAR(100), 
	subject VARCHAR(50), 
	description VARCHAR(1000), 
	language VARCHAR(20), 
	publisher VARCHAR(50), 
	publishdate DATE, 
	price DECIMAL, 
	quantity INT(255));



/*-----------------------------------------------------------------------------------------------------------------------------------------
  kid        -> keyword ID is the primary key for the keyword
  bookid     -> id of book the keyword describes
  keyword    -> actual keyword for book
-------------------------------------------------------------------------------------------------------------------------------------------
*/
CREATE TABLE keywords(
	kid INT(11) PRIMARY KEY AUTO_INCREMENT, 
	bookid INT(11), 
	keyword VARCHAR(50),
	FOREIGN KEY (bookid) REFERENCES books(bid));



/*-----------------------------------------------------------------------------------------------------------------------------------------
  uid         -> user ID is the primary key for the user
  firstName   -> user's first name
  middleName  -> user's middle name
  lastName    -> user's last name
  email       -> user's email address
  password    -> user's password
  age         -> user's age in years
  gender      -> male or female
  admin       -> TRUE if admin, FALSE otherwise
-------------------------------------------------------------------------------------------------------------------------------------------
*/
CREATE TABLE users(
	uid INT(8) PRIMARY KEY AUTO_INCREMENT,
	firstName VARCHAR(50),
	middleName VARCHAR(50),
	lastName VARCHAR(50),
	email VARCHAR(100),
	password VARCHAR(50),
	age INT(3),
	gender VARCHAR(10),
	admin BOOLEAN);



/*-----------------------------------------------------------------------------------------------------------------------------------------
  rid      -> rating ID is the primary key for the rating
  bookid   -> ID of book rating is about, foreign key
  email    -> email address of user who left rating/comment
  uid      -> user ID of user who left rating/comment
  rating   -> rating, can be 1-5
  review   -> comment about book
-------------------------------------------------------------------------------------------------------------------------------------------
*/
CREATE TABLE ratings(
	rid INT(11) PRIMARY KEY AUTO_INCREMENT, 
	bookid INT(11), 
	email VARCHAR(100), 
	uid INT(8),
	rating INT(5), 
	review VARCHAR(1000),
	FOREIGN KEY (bookid) REFERENCES books(bid),
	FOREIGN KEY (uid) REFERENCES users(uid));



/*-----------------------------------------------------------------------------------------------------------------------------------------
  oid                  -> order ID is the primary key for the order
  bookid    		   -> ID of book ordered, foreign key referencing bid in books table
  buyer     		   -> user ID of user who placed the order, foreign key referencing uid in users table
  date      		   -> date order was placed in YYYY-MM-DD format
  quantity  		   -> number of books ordered
  cost       		   -> total price paid
  status               -> status of order (e.g. processing, shipped, delivered)
  credit_card_number   -> user's credit card number for payment
  billing_address      -> user's billing address as one string
  shipping_address     -> user's shipping address as one string
-------------------------------------------------------------------------------------------------------------------------------------------
*/
CREATE TABLE orders(
	oid INT(11) PRIMARY KEY AUTO_INCREMENT,
 	bookid INT(11),
 	buyer INT(8),
 	date DATE,
 	quantity INT,
 	cost FLOAT,
 	status VARCHAR(20),
 	credit_card_number VARCHAR(16),
 	billing_address VARCHAR(50),
 	shipping_address VARCHAR(50),
 	FOREIGN KEY (bookid) REFERENCES books(bid),
 	FOREIGN KEY (buyer) REFERENCES users(uid));
