<?php
// Preparations
if(isset($_GET["id"])) {
	$id = $_GET["id"];
} else {
	error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : "clothes id is not set"');
}
session_start(); // Session
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
				"owner" => $row['owner']
			));
		}
	} else {
		error_log('[Wardrobe Eror] '.__FILE__.' line '.__LINE__.' : "query select matches error"');
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	// Query SELECT, get clothes
}

// Output dalam JSON
echo json_encode($data);
?>