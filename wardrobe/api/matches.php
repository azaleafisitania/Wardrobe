<?php
// Preparations
if(isset($_GET["id"])) {
	$id = $_GET["id"];
} else {
	error_log('Wardrobe: clothes id not set in '.__FILE__.' on line '.__LINE__);
}
session_start(); // Session
$username = $_SESSION['username']; 
include "../db-connect.php"; // Connect
$data = array(); // Data

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Query SELECT, get id of matches
	$matches = array();
	$query = "SELECT DISTINCT id_clothes2 FROM matches WHERE id_clothes1 = $id";
	$result = mysql_query($query,$db);
	if($result){
		while($row = mysql_fetch_array($result)) {
			array_push($matches, $row["id_clothes2"]);
		}
	}
	$query = "SELECT DISTINCT id_clothes1 FROM matches WHERE id_clothes2 = $id";
	$result = mysql_query($query,$db);
	if($result){
		while($row = mysql_fetch_array($result)) {
			array_push($matches, $row["id_clothes1"]);
		}
	}
	// Query SELECT, get matching clothes
	$matches = implode(",",array_unique($matches));
	$query = "SELECT id, photo, category, owner FROM clothes WHERE id IN ($matches)";
	$result = mysql_query($query,$db);
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
		error_log('Wardrobe: query select matches returns no result in '.__FILE__);
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	// Query SELECT get matches
	$query = "MATCH (n:Clothes)-[:MATCH]->(m:Clothes) WHERE n.name = '$id' RETURN m";
	$response = $client->sendCypherQuery($query)->getRows();
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
		error_log('Wardrobe: query select matches returns no result in '.__FILE__);
	}
}

// Output dalam JSON
echo json_encode($data);
?>