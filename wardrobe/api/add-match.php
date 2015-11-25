<?php
// Session
if (session_status() == PHP_SESSION_NONE) session_start();
$username = $_SESSION['username'];

// Performance measurement log
include "performance-logger.php";
fwrite($file, "File: add-clothes.php, Mode: ".$_SESSION['db_mode']." \n\n");

// Parameters
if(isset($_GET["id1"])&&isset($_GET["id2"])) {
	$id1 = $_GET["id1"];
	$id2 = $_GET["id2"];
} else {
	error_log('Wardrobe '.__FILE__.' : clothes id(s) are not set');
}
include "db-connect.php"; //Connect
$data = array(); // Data

// MySQL
if($_SESSION['db_mode']=="MySQL") {

	// Query INSERT new matches
	$query = "INSERT INTO matches(id_clothes1, id_clothes2) VALUES ('$id1','$id2'), ('$id2','$id1')";
	
	// Performance measurement
	fwrite($file, "Function: add matches\n");
	$start = microtime(true); // Start timer
	$result = mysql_query($query,$db); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($result)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");

	// Result
	if(!$result) {
		error_log('Wardrobe '.__FILE__.' : failed to insert matches');
	}

// Neo4j	
} else if($_SESSION['db_mode']=="Neo4j") {
	
	// Query INSERT new matches
	$query = "MATCH (n:Clothes),(m:Clothes) WHERE n.name = '$id1' AND m.name = '$id2' CREATE (n)-[:MATCH]->(m), (m)-[:MATCH]->(n)";
	
	// Performance measurement
	fwrite($file, "Function: add matches\n");
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