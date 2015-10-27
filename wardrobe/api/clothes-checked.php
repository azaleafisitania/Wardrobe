<?php
// Check if set
if(isset($_GET["_id"])) {
	$id_outfit = $_GET["_id"];	
} else {
	die('{"status":404},"msg":"Outfit id not selected"');
}
if(isset($_GET["_limit"])&&isset($_GET["_start"])) {
	$LIMIT = "LIMIT ".$_GET["_start"].",".$_GET["_limit"];
} else {
	$LIMIT = "";
}
// Connect DB
include "../db-connect.php";
$data = array();

$mode = "mysql"; //or "neo4j"

// Mode MySQL
if($mode=="mysql"){
	// Query select clothes in outfit
	$checked_clothes = array();
	$query = "SELECT id_clothes FROM creates WHERE id_outfit = '$id_outfit'";
	$result = mysql_query($query,$db);
	while($row = mysql_fetch_array($result)) {
		array_push($checked_clothes, $row["id_clothes"]);
	}
		
	// Query select clothes
	$query = "SELECT id,photo,fav,category FROM clothes ORDER BY category $LIMIT";
	$result = mysql_query($query,$db);
	if($result) {
		while($row = mysql_fetch_array($result)) {
			if(in_array($row["id"],$checked_clothes)) {
				$checked = "checked";
			} else {
				$checked = "";
			}
			array_push($data, array(
				"id" => $row["id"],
				"photo" => $row["photo"],
				"fav" => $row["fav"],
				"category" => $row["category"],
				"checked" => $checked
				)
			);
		}
		//output dalam JSON
		echo json_encode($data);
	}else{
		die('{"status":404}');
	}

// Mode Neo4j
}else if($mode=="neo4j"){
	//select clothes

// No mode selected
}else{
	die('{"status":412},"msg":"must choose MySQL or Neo4j"');
}
?>