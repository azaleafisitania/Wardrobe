<?php
// Parameters
if(isset($_GET["id"])) $id = $_GET["id"];
else error_log('Wardrobe '.__FILE__.' : clothes id is not set');

// Session
if (session_status() == PHP_SESSION_NONE) session_start();
$username = $_SESSION['username'];

// Performance measurement log
include "performance-logger.php";
fwrite($file, "File: add-clothes.php, Mode: ".$_SESSION['db_mode']." \n\n");

include "db-connect.php"; // Connect
$data = array(); // Data
$matches_id = array();
$error_message = 0;

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Query SELECT get id(s) of matches
	$query = "SELECT DISTINCT id_clothes1, id_clothes2 FROM matches WHERE id_clothes1 = $id";
	$result = mysql_query($query,$db);
	if($result) {
		while($row = mysql_fetch_array($result)) {
			array_push($matches_id, $row["id_clothes2"]);
		}
	}
	// Result: no matching clothes
	if(empty($matches_id)) {
		$error_message = 1;
	}
	// Query SELECT all clothes
	$query = "SELECT * FROM clothes WHERE owner = '$username' AND id<>$id ORDER BY category";
	$result = mysql_query($query,$db);
	// Push data
	if($result) {
		while($row = mysql_fetch_array($result)) {
			// Checked and unchecked
			if(in_array($row["id"],$matches_id)) {
				$checked = "checked";
			} else {
				$checked = "";
			}
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
				"owner" => $row["owner"],
				"checked" => $checked
			));
		}
	} else {
		$error_message = 2;
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	// Query SELECT, get id(s) of matches
	$query = "MATCH (n:Clothes)-[:MATCH]->(m:Clothes) WHERE n.name = '$id' RETURN m.name";
	$response = $client->sendCypherQuery($query)->getRows();
	// Result
	if(!empty($response)) {
		$matches_id = $response['m.name'];
	} else {
		$error_message = 1;
	}
	// Query SELECT all clothes
	$query2 = "MATCH (u:User)-[:OWN]->(n:Clothes) WHERE u.username = '$username' RETURN n ORDER BY n.category";
	$response2 = $client->sendCypherQuery($query2)->getRows();
	// Result
	if(!empty($response2)) {
		$clothes_all = $response2['n'];
		for($i=0;$i<sizeof($clothes_all);$i++) {
			$clothes = $clothes_all[$i];
			if(in_array($clothes["name"],$matches_id)) {
				$checked = "checked";
			} else {
				$checked = "";
			}
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
				"owner" => $username,
				"checked" => $checked
			));
		}
	} else {
		$error_message = 2;
	}
}

// Error message
switch ($error_message) {
	case 1:
		error_log('Wardrobe Notice '.__FILE__.' : this clothes has no matching clothes, moving on');
		break;
	case 2:
		error_log('Wardrobe Notice '.__FILE__.' : query select clothes returns no result');
		break;
	default:
		break;
}

// Output dalam JSON
echo json_encode($data);

fclose($file); // Close
?>