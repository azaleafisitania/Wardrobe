<?php
// Settings for Neo4j
require __DIR__.'/vendor/autoload.php';
use Neoxygen\NeoClient\ClientBuilder;

// Session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['db_mode'])) {
	$_SESSION['db_mode'] = "MySQL";
	error_log('Wardrobe: database mode not defined, switch to default, MySQL in '.__FILE__.' line '.__LINE__);
}

// Connect MySQL
if($_SESSION['db_mode']=="MySQL") {
	$host = "127.0.0.1";
	$user = "root";
	$password = "";
	$db_name = "wardrobe";
	$db = mysql_connect($host, $user, $password) or die("Cannot connect to MySQL");
	mysql_select_db($db_name, $db) or die("Cannot select database");

// Connect Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	$host = "127.0.0.1";
	$port = 7474;
	$user = "neo4j";
	$password = "password";
	
	$client = ClientBuilder::create()
	->addConnection('default', 'http', $host, $port, true, $user, $password)
	->setAutoFormatResponse(true)
	->build();
}
?>


