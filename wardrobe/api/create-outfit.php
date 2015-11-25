<?php
// Parameters
if (isset($_POST["clothes"])) {
	$clothes_ids = $_POST["clothes"];
} else {
	error_log('Wardrobe '.__FILE__.' : clothes id(s) are not set');
	header("Location: ../create-outfit.php");
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
	// Query SELECT get new id
	$query = "SELECT max(id) FROM outfits";
	$result = mysql_query($query,$db);
	
	if($result) {
		$row = mysql_fetch_array($result);
		$id = $row['max(id)']+1;
	} else {
		$id = 1;
	}
	
	// Query INSERT new outfit
	$query = "INSERT INTO outfits(id) VALUES ('$id')";
	
	// Performance measurement
	fwrite($file, "Function: insert outfit\n");
	$start = microtime(true); // Start timer
	$result = mysql_query($query,$db); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($result)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");
	
	if($result) {
		for($i=0;$i<sizeof($clothes_ids);$i++) {
			$clothes_ids[$i] = "(".$id.",".$clothes_ids[$i].")";
		}
		
		// Query INSERT creates
		$query = "INSERT INTO creates(id_outfit, id_clothes) VALUES ".implode(",", $clothes_ids);
		
		// Performance measurement
		fwrite($file, "Function: insert creates\n");
		$start = microtime(true); // Start timer
		$result = mysql_query($query,$db); // Execute query
		$time_elapsed = microtime(true) - $start; // End timer
		fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
		fwrite($file, "Memory usage: ".memory_usage($result)." byte\n");
		fwrite($file, date("Y-m-d h:m:s",time()));
		fwrite($file, "\n\n");

		if(!$result) {
			error_log('Wardrobe '.__FILE__.' : failed to link clothes to outfit');
		}
	} else {
		error_log('Wardrobe '.__FILE__.' : failed to insert new outfit');
		header('Location: ../outfits.php');
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	
	// Query SELECT get new id
	$query = "MATCH (u:User)-[:OWN]->(n:Clothes)-[:CREATE]->(o:Outfit) WHERE u.username = '$username' RETURN MAX(o.name)";
	$response = $client->sendCypherQuery($query)->getRows();
	
	$id = $response['MAX(o.name)'][0]+1;
	
	// Query INSERT new outfit
	$query = "CREATE (o:Outfit {name:'$id'})";

	fwrite($file, "Function: insert outfit\n");
	$start = microtime(true); // Start timer
	$response = $client->sendCypherQuery($query)->getResult(); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($response)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");

	// Query INSERT creates
	$query = 'MATCH (u:User)-[:OWN]->(n:Clothes),(o:Outfit) WHERE u.username = "'.$username.'" AND n.name IN '.json_encode($clothes_ids).' AND o.name = "'.$id.'" CREATE (n)-[:CREATE]->(o)';
	
	fwrite($file, "Function: insert creates\n");
	$start = microtime(true); // Start timer
	$response = $client->sendCypherQuery($query)->getResult(); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($response)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");
}

// Continue
header('Location: ../outfit-detail.php?id='.$id);

fclose($file); // Close
?>