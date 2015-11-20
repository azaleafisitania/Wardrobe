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
			array_push($data, array(
				"id" => $row["id"],
				"photo" => $row["photo"],
				"category" => $row["category"],
				"owner" => $username
			));
		}
	} else {
		error_log('Wardrobe: query select matches returns no result in '.__FILE__.' on line '.__LINE__);
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	// Query SELECT get matches
	$query = "MATCH (n:Clothes)-[:MATCH]->(m:Clothes) WHERE n.name = '$id' RETURN m";
	$response = $client->sendCypherQuery($query)->getRows();
	$clothes_all = $response['m'];
	if($clothes_all) {
		for($i=0;$i<sizeof($clothes_all);$i++) {
			$clothes = $clothes_all[$i];
			array_push($data, array(
				"id" => $clothes["name"],
				"photo" => $clothes["photo"],
				"category" => $clothes["category"],
				"owner" => $username
			));
		}
	}
}

// Output dalam JSON
echo json_encode($data);
?>