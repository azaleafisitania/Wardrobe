<?php

// Session
if (session_status() == PHP_SESSION_NONE) session_start();
$username = $_SESSION['username'];

// Performance measurement log
include "performance-logger.php";
fwrite($file, "File: clothes.php, Mode: ".$_SESSION['db_mode']." \n\n");

include "db-connect.php"; // Connect
$data = array(); // Data
$error_message = 0;

// Mode MySQL
if($_SESSION['db_mode']=="MySQL") {
	
	// Parameter
	if(isset($_GET["category"])&&($_GET["category"]!="")) {
		$CATEGORY = "AND category = '".$_GET["category"]."'";	
	} else {
		$CATEGORY = "";
	}
	
	// MySQL query SELECT clothes
	$query = "SELECT * FROM clothes WHERE owner = '$username' $CATEGORY ORDER BY category";
	
	// Performance measurement
	fwrite($file, "Function: select all clothes\n");
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
			// Photo
			if(($row['photo'])&&(file_exists("../images/".$username."/".$row['photo']))) {
				$photo = "images/".$username."/".$row['photo'];
			} else {
				$photo = "images/Photo Here.jpg";
			}
			// Push data
			array_push($data, array(
				"id" => $row["id"],
				"photo" => $photo,
				"fav" => $row["fav"],
				"category" => $row["category"],
				"owner" => $row["owner"]
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
	// Query SELECT clothes
	$query = "MATCH (u:User)-[:OWN]->(n:Clothes) WHERE u.username = '$username' $CATEGORY RETURN n ORDER BY n.category";
	
	// Performance measurement
	fwrite($file, "Function: select all clothes\n");
	$start = microtime(true); // Start timer
	$response = $client->sendCypherQuery($query)->getRows(); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($response)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");
	
	// Result
	if(!empty($response)) {
		$clothes_all = $response['n'];
		for($i=0;$i<sizeof($clothes_all);$i++) {
			$clothes = $clothes_all[$i];
			if(($clothes['photo'])&&(file_exists("../images/".$username."/".$clothes['photo']))) {
				$photo = "images/".$username."/".$clothes['photo'];
			} else {
				$photo = "images/Photo Here.jpg";
			}
			// Push data
			array_push($data, array(
				"id" => $clothes["name"],
				"photo" => $photo,
				"fav" => $clothes["fav"],
				"category" => $clothes['category']
			));
		}
	// No result
	} else {
		$error_message = 1;
	}
}

// Error message
if($error_message==1) {
	error_log('Wardrobe '.__FILE__.' : query select clothes returns no result');
}

// Output dalam JSON
echo json_encode($data);

fclose($file); // Close
?>