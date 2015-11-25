<?php
// Parameters
if(isset($_GET["id1"])&&isset($_GET["id2"])) {
	$id1 = $_GET["id1"];
	$id2 = $_GET["id2"];
} else {
	error_log('Wardrobe '.__FILE__.' : clothes id is not set in');
}

// Session
if (session_status() == PHP_SESSION_NONE) session_start();
$username = $_SESSION['username'];

// Performance measurement log
include "performance-logger.php";
fwrite($file, "File: add-clothes.php, Mode: ".$_SESSION['db_mode']." \n\n");

include "db-connect.php"; // Connect

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	
	// Query DELETE layers
	$query = "DELETE FROM creates WHERE id_outfit='$id1' AND id_clothes='$id2'";
	
	// Performance measurement
	fwrite($file, "Function: remove clothes from matches by id\n");
	$start = microtime(true); // Start timer
	$result = mysql_query($query,$db); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($result)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");
	
	if(!$result) {
		error_log('Wardrobe '.__FILE__.' : query delete matches error');
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	// Query DELETE relationship match
	$query = "MATCH (n:Clothes)-[r:CREATE]->(o:Outfit) WHERE o.name = '$id1' AND n.name = '$id2' DELETE r";
	
	// Performance measurement
	fwrite($file, "Function: remove clothes from matches by id\n");
	$start = microtime(true); // Start timer
	$response = $client->sendCypherQuery($query)->getResult(); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($response)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");
}

fclose($file); // Close
?>