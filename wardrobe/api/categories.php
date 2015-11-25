<?php
// Session
if (session_status() == PHP_SESSION_NONE) session_start();
$username = $_SESSION['username'];

// Performance measurement log
include "performance-logger.php";
fwrite($file, "File: categories.php, Mode: ".$_SESSION['db_mode']." \n\n");

include "db-connect.php"; // Connect
$data = array(); // Data
$error_message = 0;

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Check parameter
	if(isset($_GET["category"])&&($_GET["category"]!="")) {
		$CATEGORY = 'AND category = "'.$_GET["category"].'"';	
	} else {
		$CATEGORY = "";
	}

	// Query SELECT categories
	$query = "SELECT DISTINCT category FROM clothes WHERE owner = '$username' $CATEGORY GROUP BY category";
	
	fwrite($file, "Function: get categories\n");
	$start = microtime(true); // Start timer
	$result = mysql_query($query,$db); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($result)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");
	
	// Result
	if($result) {
		while($row = mysql_fetch_array($result)) {
			// Query SELECT COUNT
			$query2 = "SELECT count(id) FROM clothes WHERE owner = '$username' AND category = '".$row['category']."' GROUP BY CATEGORY";
			$result2 = mysql_query($query2,$db);
			$row2 = mysql_fetch_array($result2);
			// Push data
			array_push($data, array(
				"name" => $row['category'],
				"total" => $row2['count(id)']
			));
		}
	// No result
	} else {
		$error_message = 1;
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	// Check parameter
	if(isset($_GET["category"])&&($_GET["category"]!="")) {
		$CATEGORY = "AND n.category = '".$_GET["category"]."'";
	} else {
		$CATEGORY = "";
	}
	
	// Query SELECT categories
	$query = "MATCH (u:User)-[:OWN]->(n:Clothes) WHERE u.username = '$username' $CATEGORY RETURN DISTINCT n.category ORDER BY n.category";
	
	fwrite($file, "Function: get categories\n");
	$start = microtime(true); // Start timer
	$response = $client->sendCypherQuery($query)->getRows(); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($response)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");
	
	// Result
	if(!empty($response)) {
		$categories = $response['n.category'];
		for($i=0;$i<sizeof($categories);$i++) {
			// Query COUNT
			$query2 = "MATCH (n:Clothes) WHERE n.category = '".$categories[$i]."' RETURN COUNT(n)";
			$response2 = $client->sendCypherQuery($query2)->getRows();
			$total = $response2['COUNT(n)'];
			// Push data
			array_push($data, array(
				"name" => $categories[$i],
				"total" => $total
			));
		}
	// No result
	} else {
		$error_message = 1;
	}
}

// Error message
if($error_message==1) {
	error_log('Wardrobe '.__FILE__.': query select categories returns no result');
}

// Output dalam JSON
echo json_encode($data);

fclose($file); // Close
?>