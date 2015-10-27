<?php
if(isset($_GET["_id"])) {
	$ID = "WHERE id = ".$_GET["_id"];
} else {
	$ID = "";
}
// Check if set
if(isset($_GET["_limit"])&&isset($_GET["_start"])) {
	$LIMIT = "LIMIT ".$_GET["_start"].",".$_GET["_limit"];
} else {
	$LIMIT = "";
}

// Connect DB
include "../db-connect.php";
$data = array();

// Select mode
$mode = "mysql"; //or "neo4j"
if($mode=="mysql"){
	// Query select outfit ids
	$outfits = array();
	$query = "SELECT id FROM outfits $ID $LIMIT";
	$result = mysql_query($query,$db);
	if($result) {
		while($row = mysql_fetch_array($result)){
			$id = $row['id'];
			// Query select clothes
			$clothes = array();
			$query2 = "SELECT id_clothes, id_outfit, photo, category FROM creates INNER JOIN clothes WHERE id_outfit='$id' AND creates.id_clothes=clothes.id ORDER BY category";
			$result2 = mysql_query($query2,$db);
			if($result2) {
				while($row2 = mysql_fetch_array($result2)) {
					array_push($clothes, array(
						"id" => $row2["id_clothes"],
						"photo" => $row2["photo"],
						"category" => $row2["category"])
					);
				}
			} else {
				die('{"status":404},"msg":"Unable to access clothes data"');			
			}
			array_push($outfits, array(
				"id" => $id,
				"clothes" => $clothes)
			);
		}
		// Output dalam JSON
		echo json_encode($outfits);
	} else {
		die('{"status":404},"msg":"Unable to access outfits data"');
	}
} else if($mode=="neo4j") {
} else {
	die('{"status":412},"msg":"Must choose MySQL or Neo4j"');
}
?>