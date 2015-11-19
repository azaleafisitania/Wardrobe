<?php
// Preparations
if(isset($_GET["id"])) {
	$id = $_GET["id"];
} else {
	error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : "clothes id is not set"');
}
session_start(); // Session
$username = $_SESSION['username'];
include "../db-connect.php"; // Connect
$data = array(); // Data
$layers_id = array();

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Query SELECT, get id of matches
	$query = "SELECT DISTINCT id_clothes2 FROM layers WHERE id_clothes1 = $id";
	$result = mysql_query($query,$db);
	if($result) {
		while($row = mysql_fetch_array($result)) {
			array_push($layers_id, $row["id_clothes2"]);
		}
	}
	$query = "SELECT DISTINCT id_clothes1 FROM layers WHERE id_clothes2 = $id";
	$result = mysql_query($query,$db);
	if($result) {
		while($row = mysql_fetch_array($result)) {
			array_push($layers_id, $row["id_clothes1"]);
		}
	}
	// Query SELECT, get all clothes
	$query = "SELECT * FROM clothes WHERE owner = '$username' ORDER BY category";
	$result = mysql_query($query,$db);
	// Push data
	if($result) {
		while($row = mysql_fetch_array($result)) {
			if(in_array($row["id"],$layers_id)) {
				$layer = 1;
			} else {
				$layer = 0;
			}
			array_push($data, array(
				"id" => $row["id"],
				"photo" => $row["photo"],
				"category" => $row["category"],
				"owner" => $row["owner"],
				"layer" => $layer
			));
		}
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	// Query SELECT
}

// Output dalam JSON
echo json_encode($data);
?>