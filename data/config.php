<?php
define('DB_SERVER', 'mariadb');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'toor');
define('DB_NAME', 'bookstore');

// Attempt to connect to MySQL database
$mysql_db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (!$mysql_db) {
	die("Error: Unable to connect " . $mysql_db->connect_error);
}