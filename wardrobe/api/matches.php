<?php
// Parameters
if(isset($_GET["id"])) {
	$id = $_GET["id"];
} else {
	error_log('Wardrobe '.__FILE__.' : clothes id is not set');
}

// Session
if (session_status() == PHP_SESSION_NONE) session_start();
$username = $_SESSION['username']; 

// Performance measurement log
include "performance-logger.php";
fwrite($file, "File: add-clothes.php, Mode: ".$_SESSION['db_mode']." \n\n");

include "db-connect.php"; // Connect
$data = array(); // Data
$error_message = 0;

// MySQL
if($_SESSION['db_mode']=="MySQL") {

	// Query SELECT matching clothes by id
	$query = "SELECT * FROM clothes WHERE id IN (SELECT DISTINCT id_clothes2 FROM matches WHERE id_clothes1 = $id)";
	
	// Performance measurement
	fwrite($file, "Function: delete clothes\n");
	$start = microtime(true); // Start timer
	$result = mysql_query($query,$db); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($result)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");
	
	// Push data
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
				"category" => $row["category"],
				"owner" => $username
			));
		}
	} else {
		$error_message = 1;
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	
	// Query SELECT matching clothes by id
	$query = "MATCH (n:Clothes)-[:MATCH]->(m:Clothes) WHERE n.name = '$id' RETURN m";
	
	// Performance measurement
	fwrite($file, "Function: delete clothes\n");
	$start = microtime(true); // Start timer
	$response = $client->sendCypherQuery($query)->getRows(); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($response)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");
	
	if(!empty($response)) {
		$clothes_all = $response['m'];
		for($i=0;$i<sizeof($clothes_all);$i++) {
			$clothes = $clothes_all[$i];
			// Photo
			if(($clothes['photo'])&&(file_exists("../images/".$username."/".$clothes['photo']))) {
				$photo = "images/".$username."/".$clothes['photo'];
			} else {
				$photo = "images/Photo Here.jpg";
			}
			// Push data
			array_push($data, array(
				"id" => $clothes["name"],
				"photo" => $photo,
				"category" => $clothes["category"],
				"owner" => $username
			));
		}
	} else {
		$error_message = 1;
	}
}

// Error message
switch ($error_message) {
	case 1:
		error_log('Wardrobe '.__FILE__.' : query select matches returns no result');
		break;
	default:
		break;
}

// Output dalam JSON
echo json_encode($data);
?>