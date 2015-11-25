<?php
// Parameters
$id = $_GET["id"];

// Session
session_start(); 
$username = $_SESSION['username'];

// Performance measurement log
include "performance-logger.php";
fwrite($file, "File: add-clothes.php, Mode: ".$_SESSION['db_mode']." \n\n");

include "db-connect.php"; // Connect
$clothes = array(); // Temp
$data = array(); // Data
$error_message = 0;

// MySQL
if($_SESSION['db_mode']=="MySQL") {

	// Query SELECT outfit and clothes
	$query = "SELECT * FROM outfits INNER JOIN creates INNER JOIN clothes WHERE outfits.id='$id' AND creates.id_outfit=outfits.id AND creates.id_clothes=clothes.id ORDER BY category";

	// Performance measurement
	fwrite($file, "Function: select outfit detail by id\n");
	$start = microtime(true); // Start timer
	$result = mysql_query($query,$db); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($result)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");

	if($result) {
		while($row = mysql_fetch_array($result)) {
			// Check photo
			if(($row['photo'])&&(file_exists("../images/".$username."/".$row['photo']))) {
				$photo = "images/".$username."/".$row['photo'];
			} else {
				$photo = "images/Photo Here.jpg";
			}
			array_push($clothes, array(
				"id" => $row["id_clothes"],
				"photo" => $photo,
				"category" => $row["category"]
			));
		}
		// Push data
		array_push($data, array(
			"id" => $id,
			"clothes" => $clothes
		));
	} else {
		$error_message = 1;
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	
	// Query SELECT outfit detail
	$query = "MATCH (u:User)-[:OWN]->(n:Clothes)-[:CREATE]->(o:Outfit) WHERE u.username = '$username' AND o.name='$id' RETURN (o),(n)";
	
	// Performance measurement
	fwrite($file, "Function: delete clothes\n");
	$start = microtime(true); // Start timer
	$response = $client->sendCypherQuery($query)->getRows(); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($response)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");
	
	// Result
	if(!empty($response)) {
		$id = $response['o'][0]['name'];
		$clothes_all = $response['n'];
		for($i=0;$i<sizeof($clothes_all);$i++) {
			// Check photo
			if(($clothes_all[$i]['photo'])&&(file_exists("../images/".$username."/".$clothes_all[$i]['photo']))) {
				$photo = "images/".$username."/".$clothes_all[$i]['photo'];
			} else {
				$photo = "images/Photo Here.jpg";
			}
			array_push($clothes, array(
				"id" => $clothes_all[$i]["name"],
				"photo" => $photo,
				"category" => $clothes_all[$i]["category"]
			));
		}
		// Push data
		array_push($data, array(
			"id" => $id,
			"clothes" => $clothes
		));
	} else {
		$error_message = 1;
	}
}

// Error message
switch ($error_message) {
	case 1:
		error_log('Wardrobe '.__FILE__.' : query select outfit and clothes returns no result');
		break;
	default:
		break;
}

// Output dalam JSON
echo json_encode($data);

// Cleanup
unset($clothes);
unset($data);

fclose($file); // Close
?>