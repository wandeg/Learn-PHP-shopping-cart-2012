CREATE DATABASE IF NOT EXISTS books_cart;

USE books_cart;

CREATE TABLE customers
(
  customerid INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  NAME CHAR(60) NOT NULL,
  address CHAR(80) NOT NULL,
  city CHAR(30) NOT NULL,
  state CHAR(20),
  zip CHAR(10),
  country CHAR(20) NOT NULL
);

CREATE TABLE orders
(
  orderid INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  customerid INT UNSIGNED NOT NULL,
  amount FLOAT(6,2),
  DATE DATE NOT NULL,
  order_status CHAR(10),
  ship_name CHAR(60) NOT NULL,
  ship_address CHAR(80) NOT NULL,
  ship_city CHAR(30) NOT NULL,
  ship_state CHAR(20),
  ship_zip CHAR(10),
  ship_country CHAR(20) NOT NULL
);

CREATE TABLE books
(
   isbn CHAR(13) NOT NULL PRIMARY KEY,
   author CHAR(80),
   title CHAR(100),
   cat_id INT UNSIGNED,
   price FLOAT(4,2) NOT NULL,
   description VARCHAR(255)
);

CREATE TABLE categories
(
  cat_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  catname CHAR(60) NOT NULL
);

CREATE TABLE order_items
(
  orderid INT UNSIGNED NOT NULL,
  isbn CHAR(13) NOT NULL,
  item_price FLOAT(4,2) NOT NULL,
  quantity TINYINT UNSIGNED NOT NULL,
  PRIMARY KEY (orderid, isbn)
);

CREATE TABLE admin
(
  username CHAR(16) NOT NULL PRIMARY KEY,
  PASSWORD CHAR(40) NOT NULL
);

GRANT SELECT, INSERT, UPDATE, DELETE
ON books_cart.*
TO root@localhost IDENTIFIED BY '';
