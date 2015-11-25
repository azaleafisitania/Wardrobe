<?php
// Session
if (session_status() == PHP_SESSION_NONE) session_start();
$username = $_SESSION['username'];

// Performance measurement log
include "performance-logger.php";
fwrite($file, "File: add-to-outfit.php, Mode: ".$_SESSION['db_mode']." \n\n");

// Parameters
if(isset($_GET["id1"])&&isset($_GET["id2"])) {
	$id1 = $_GET["id1"];
	$id2 = $_GET["id2"];
} else {
	error_log('Wardrobe '.__FILE__.': clothes id(s) are not set');
}
include "db-connect.php"; // Connect
$data = array(); // Data

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	
	// Query INSERT creates
	$query = "INSERT INTO creates(id_outfit, id_clothes) VALUES ('$id1','$id2')";
	
	// Performance measurement
	fwrite($file, "Function: add to outfit\n");
	$start = microtime(true); // Start timer
	$result = mysql_query($query,$db); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($result)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");
	
	if(!$result) {
		error_log('Wardrobe '.__FILE__.' : failed to insert outfit to database');
	}

// Neo4j	
} else if($_SESSION['db_mode']=="Neo4j") {
	
	// Query INSERT creates
	$query = "MATCH (n:Clothes),(o:Outfit) WHERE o.name = '$id1' AND n.name = '$id2' CREATE (n)-[:CREATE]->(o)";
	
	// Performance measurement
	fwrite($file, "Function: add to outfit\n");
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