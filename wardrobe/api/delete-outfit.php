<?php
// Session
if (session_status() == PHP_SESSION_NONE) session_start();
$username = $_SESSION['username'];

// Performance measurement log
include "performance-logger.php";
fwrite($file, "File: add-clothes.php, Mode: ".$_SESSION['db_mode']." \n\n");

$id = $_GET['id']; // Get id outfit
include "db-connect.php"; // Connect

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Query DELETE outfit
	$query = "DELETE FROM outfits WHERE id = '$id'";
	
	// Performance measurement
	fwrite($file, "Function: delete outfit\n");
	$start = microtime(true); // Start timer
	$result = mysql_query($query,$db); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($result)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");
	
	if(!$result) {
		error_log('Wardrobe '.__FILE__.' : failed to delete outfit');
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	// Query DELETE outfit
	$query = "MATCH ()-[r]->(o:Outfit) WHERE o.name = '$id' DELETE r,o";
	
	// Performance measurement
	fwrite($file, "Function: delete outfit\n");
	$start = microtime(true); // Start timer
	$response = $client->sendCypherQuery($query)->getResult(); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($response)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");
}

// Back
header('Location: ../outfits.php');

fclose($file); // Close
?>