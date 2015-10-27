<?php
// Check if set
if(isset($_GET["_id"])) 
	$id = $_GET["_id"];
else 
	die('{"status":404},"msg":"Clothes id not selected"');

//Connect
include "../db-connect.php";
$matches_id = array();
$data = array();

// Select mode
$mode = "mysql"; //or "neo4j"
if($mode=="mysql"){
	// Query select matches id
	$query = "SELECT DISTINCT id_clothes2 FROM matches WHERE id_clothes1 = $id";
	$result = mysql_query($query,$db);
	if($result){
		while($row = mysql_fetch_array($result)) {
			array_push($matches_id, $row["id_clothes2"]);
		}
	} else {
		die('{"status":404}');
	}
	$query = "SELECT DISTINCT id_clothes1 FROM matches WHERE id_clothes2 = $id";
	$result = mysql_query($query,$db);
	if($result){
		while($row = mysql_fetch_array($result)) {
			array_push($matches_id, $row["id_clothes1"]);
		}
	} else {
		die('{"status":404}');
	}

	// Query select clothes
	$query = "SELECT * FROM clothes ORDER BY category";
	$result = mysql_query($query,$db);
	if($result) {
		while($row = mysql_fetch_array($result)) {
			if(in_array($row["id"],$matches_id)) {
				$match = 1;
			} else {
				$match = 0;
			}
			array_push($data, array(
				"id" => $row["id"],
				"photo" => $row["photo"],
				"category" => $row["category"],
				"match" => $match
			));
		}
	} else {
		die('{"status":404}');
	}
	//output dalam JSON
	echo json_encode($data);
}else if($mode=="neo4j"){
	//select clothes
}else{
	die('{"status":412},"msg":"must choose MySQL or Neo4j"');
}
?>