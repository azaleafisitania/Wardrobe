<?php
// Preparations
if(isset($_GET["id"])) {
	$id = $_GET["id"];
} else {
	error_log('Wardrobe: clothes id  not set'.__FILE__);
}
session_start(); // Session
$username = $_SESSION['username'];
include "../db-connect.php"; // Connect
$data = array(); // Data
$matches_id = array();

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Query SELECT, get id of matches
	$query = "SELECT DISTINCT id_clothes2 FROM matches WHERE id_clothes1 = $id";
	$result = mysql_query($query,$db);
	if($result) {
		while($row = mysql_fetch_array($result)) {
			array_push($matches_id, $row["id_clothes2"]);
		}
	}
	$query = "SELECT DISTINCT id_clothes1 FROM matches WHERE id_clothes2 = $id";
	$result = mysql_query($query,$db);
	if($result) {
		while($row = mysql_fetch_array($result)) {
			array_push($matches_id, $row["id_clothes1"]);
		}
	}
	// Query SELECT, get all clothes
	$query = "SELECT * FROM clothes WHERE owner = '$username' AND id<>$id ORDER BY category";
	$result = mysql_query($query,$db);
	// Push data
	if($result) {
		while($row = mysql_fetch_array($result)) {
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
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	// Query SELECT, get matches
	$query = "MATCH (n:Clothes)-[:MATCH]->(m:Clothes) WHERE n.name = '$id' RETURN m.name";
	$response = $client->sendCypherQuery($query)->getRows();
	if(!empty($response)) {
		$matches_id = $response['m.name'];
		// Query SELECT, get all clothes	
	} else {
		error_log('Wardrobe: clothes id $id has no matching clothes in '.__FILE__);
	}
	$query2 = "MATCH (u:User)-[:OWN]->(n:Clothes) WHERE u.username = '$username' RETURN n ORDER BY n.category";
	$response2 = $client->sendCypherQuery($query2)->getRows();
	if(!empty($response2)) {
		$clothes_all = $response2['n'];
		for($i=0;$i<sizeof($clothes_all);$i++) {
			$clothes = $clothes_all[$i];
			if(in_array($clothes["name"],$matches_id)) {
				$match = 1;
			} else {
				$match = 0;
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
				"match" => $match
			));
		}
	} else {
		error_log('Wardrobe: query select clothes returns no result in '.__FILE__.' on line '.__LINE__);
	}
}

// Output dalam JSON
echo json_encode($data);
?>