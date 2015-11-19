<?php
// Preparations
if(isset($_GET["id"])) {
	$id = $_GET["id"];
} else {
	error_log('[Wardrobe Eror] '.__FILE__.' line '.__LINE__.' : "clothes id is not set"');
}
session_start(); // Session
$username = $_SESSION['username'];
include "../db-connect.php"; // Connect
$data = array(); // Data

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Query SELECT, get id of layers 
	$layers = array();
	$query = "SELECT DISTINCT id_clothes2 FROM layers WHERE id_clothes1 = $id";
	$result = mysql_query($query,$db);
	if($result){
		while($row = mysql_fetch_array($result)) {
			array_push($layers, $row["id_clothes2"]);
		}
	}
	$query = "SELECT DISTINCT id_clothes1 FROM layers WHERE id_clothes2 = $id";
	$result = mysql_query($query,$db);
	if($result){
		while($row = mysql_fetch_array($result)) {
			array_push($layers, $row["id_clothes1"]);
		}
	}
	// Query SELECT, get layering clothes
	$layers = implode(",",array_unique($layers));
	$query = "SELECT * FROM clothes WHERE id IN ($layers)";
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
		error_log('[Wardrobe Eror] '.__FILE__.' line '.__LINE__.' : "query select layers error"');
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	//select clothes
}

// Output dalam JSON
echo json_encode($data);
?>