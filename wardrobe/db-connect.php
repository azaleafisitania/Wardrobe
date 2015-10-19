<?php
$host = "127.0.0.1";
$user = "root";
$password = "";
$db_name = "wardrobe";
$db = mysql_connect($host, $user, $password) or die("Cannot connect to MySQL");
mysql_select_db($db_name, $db) or die("Cannot select database");
$path = "img/azalea/";
?>