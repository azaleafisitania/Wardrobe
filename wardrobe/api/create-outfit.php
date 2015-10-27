<?php
// Check parameter
if (isset($_POST["clothes"])) {
	$clothes_ids = $_POST["clothes"];
	//echo $clothes_ids;
} else {
	header("Location: ../create-outfit.php");
}

//Connect DB
include "../db-connect.php";

// Select mode
$mode = "mysql"; //or "neo4j"
if($mode=="mysql") {
	
	// Query get max id
	$query = "SELECT max(id) FROM outfits";
	$result = mysql_query($query,$db);
	if($result) {
		$row = mysql_fetch_array($result);
		$id = $row['max(id)']+1;
	} else {
		$id = 1;
	}
	$query = "INSERT INTO outfits(id) VALUES ('".$id."')";
	$result = mysql_query($query,$db);
	if($result) {
		for($i=0;$i<sizeof($clothes_ids);$i++) {
			$query = "INSERT INTO creates(id_outfit, id_clothes) VALUES ('".$id."','".$clothes_ids[$i]."')";
			$result = mysql_query($query,$db);
			if(!$result) {
				die('{"status":404},"msg":"Failed to link new outfit with clothes"');
			}
		}
		header('Location: ../outfits.php?id='.$id);
	} else {
		die('{"status":404},"msg":"Failed to insert new outfit"');
	}
} else if($mode=="neo4j") {
	//select clothes
} else {
	die('{"status":412},"msg":"Must choose MySQL or Neo4j"');
}
?>