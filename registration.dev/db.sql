$ sudo apt-get install mysql-server
red
root pass: root
user pass user
Debian
user : erik
Pass: nikanika
$mysql -uroot -p
mysql> DELETE FROM users;
mysql> SHOW FIELDS from table;
mysql> DESCRIBE database1.users
mysql> SHOW COLUMNS IN database1.users;
mysql> SOURCE /tmp/tables.sql
DROP DATABASE IF EXISTS database1;
CREATE DATABASE database1;
USE database1;

DROP TABLE IF EXISTS users;

CREATE TABLE users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
username VARCHAR(30) NOT NULL,
password VARCHAR(65) NOT NULL,
email VARCHAR(30) NOT NULL,
active INT(1) NOT NULL DEFAULT 0,
regdate TIMESTAMP
);

DROP TABLE IF EXISTS items;

CREATE TABLE items (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
menu VARCHAR(30) NOT NULL,
item VARCHAR(30) NOT NULL,
image VARCHAR(30) NOT NULL,
price VARCHAR(30) NOT NULL,
regdate TIMESTAMP
);

DROP TABLE IF EXISTS basket;

CREATE TABLE basket (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
iditem INT(6) UNSIGNED NOT NULL,
Iduser INT(6) UNSIGNED NOT NULL,
regdate TIMESTAMP
);




INSERT INTO users (firstname, lastname, username, password, email)
VALUES ()




