<?php
// Parameters
if(isset($_GET["limit"])&&isset($_GET["start"])) $LIMIT = "LIMIT ".$_GET["start"].",".$_GET["limit"];
else $LIMIT = "";

// Session
if (session_status() == PHP_SESSION_NONE) session_start();
$username = $_SESSION['username'];

// Performance measurement log
include "performance-logger.php";
fwrite($file, "File: add-clothes.php, Mode: ".$_SESSION['db_mode']." \n\n");

include "db-connect.php"; // Connect
$outfits = array();
$clothes = array();
$error_message = 0;

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	
	// Query SELECT id outfits & clothes 
	$query = "SELECT DISTINCT outfits.id, id_clothes, photo, blob_image, category FROM outfits INNER JOIN creates INNER JOIN clothes WHERE outfits.id=creates.id_outfit AND creates.id_clothes=clothes.id AND clothes.owner = '$username' ORDER BY outfits.id";
	
	// Performance measurement
	fwrite($file, "Function: select all outfits with clothes\n");
	$start = microtime(true); // Start timer
	$result = mysql_query($query,$db); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($result)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");
	
	// Push data
	if($result) {
		$row = mysql_fetch_array($result);
		$id_outfit = $row['id']; // First outfit
		mysql_data_seek($result, 0);
		while($row = mysql_fetch_array($result)) {
			// Push outfit
			if($row['id']!=$id_outfit) {
				array_push($outfits, array(
					"id" => $id_outfit,
					"clothes" => $clothes
				));
				$id_outfit = $row['id']; // Next outfit
				$clothes = array();
			}
			// Check photo
			if(($row['photo'])&&(file_exists("../images/".$username."/".$row['photo']))) {
				$photo = "images/".$username."/".$row['photo'];
			} else {
				$photo = "images/Photo Here.jpg";
			}
			// Push clothes
			array_push($clothes, array(
				"id" => $row["id_clothes"],
				"photo" => $photo,
				"category" => $row["category"],
				"owner" => $username
				));
		}
		array_push($outfits, array(
			"id" => $id_outfit,
			"clothes" => $clothes
		));
	} else {
		$error_message = 1;
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	
	// Query SELECT clothes
	$query = "MATCH (u:User)-[:OWN]->(n:Clothes)-[:CREATE]->(o:Outfit) WHERE u.username = '$username' RETURN o,n ORDER BY o.name";
	
	// Performance measurement
	fwrite($file, "Function: select all outfits with clothes\n");
	$start = microtime(true); // Start timer
	$response = $client->sendCypherQuery($query)->getRows(); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($response)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");
	
	// Result
	if(!empty($response)) {
		$outfits_res = $response['o'];
		$clothes_res = $response['n'];
		$id_outfit = $outfits_res[0]['name']; // First outfit
		for($i=0;$i<sizeof($outfits_res);$i++) {
			// Push outfit 
			if($outfits_res[$i]['name']!==$id_outfit) {
				array_push($outfits, array(
					"id" => $id_outfit,
					"clothes" => $clothes
				));
				$id_outfit = $outfits_res[$i]['name']; // Next outfit
				$clothes = array();
			}
			// Check photo
			if(($clothes_res[$i]['photo'])&&(file_exists("../images/".$username."/".$clothes_res[$i]['photo']))) {
				$photo = "images/".$username."/".$clothes_res[$i]['photo'];
			} else {
				$photo = "images/Photo Here.jpg";
			}
			// Push clothes
			array_push($clothes, array(
				"id" => $clothes_res[$i]["name"],
				"photo" => $photo,
				"category" => $clothes_res[$i]["category"],
				"owner" => $username
			));
		}
		array_push($outfits, array(
			"id" => $id_outfit,
			"clothes" => $clothes
		));
	} else {
		$error_message = 1;
	}
}

// Error message
switch ($error_message) {
	case 1:
		error_log('Wardrobe '.__FILE__.' : query select outfits and clothes returns no result');
		break;
	default:
		break;
}

// Output dalam JSON
echo json_encode($outfits);

// Cleanup
unset($clothes);
unset($outfits);

fclose($file); // Close
?>