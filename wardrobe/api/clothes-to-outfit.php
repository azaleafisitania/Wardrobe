<?php
// Preparations
if(isset($_GET["id"])) $id_outfit = $_GET["id"];
error_log('Wardrobe: outfit id not set in '.__FILE__);
if(isset($_GET["limit"])&&isset($_GET["start"]))  $LIMIT = "LIMIT ".$_GET["start"].",".$_GET["limit"];
else $LIMIT = "";
session_start(); // Session
$username = $_SESSION['username'];
include "../db-connect.php"; // Connect
$data = array(); // Data
$checked_clothes = array();
	
// MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Query SELECT, get clothes id(s) of outfit
	$query = "SELECT id_clothes FROM creates WHERE id_outfit = '$id_outfit'";
	$result = mysql_query($query,$db);
	while($row = mysql_fetch_array($result)) {
		array_push($checked_clothes, $row["id_clothes"]);
	}
	// Query SELECT all clothes
	$query = "SELECT id,photo,category FROM clothes WHERE owner = '$username' ORDER BY category $LIMIT";
	$result = mysql_query($query,$db);
	if($result) {
		while($row = mysql_fetch_array($result)) {
			if(in_array($row["id"],$checked_clothes)) {
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
				"checked" => $checked
			));
		}
	} else {
		error_log('Wardrobe: query select clothes returns no result '.__FILE__);
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	// Query SELECT, get clothes id(s) of outfit
	$query = "MATCH (n:Clothes)-[:CREATE]->(o:Outfit) WHERE o.name = '$id_outfit' RETURN n.name";
	$response = $client->sendCypherQuery($query)->getRows();
	$checked_clothes = $response['n.name'];
	// Query SELECT all clothes
	$query = "MATCH (u:User)-[:OWN]->(n:Clothes) WHERE u.username = '$username' RETURN n";
	$response = $client->sendCypherQuery($query)->getRows();
	if(!empty($response)) {
		$clothes_all = $response['n'];
		for($i=0;$i<sizeof($clothes_all);$i++) {
			$clothes = $clothes_all[$i];
			if(in_array($clothes["name"],$checked_clothes)) {
				$checked = "checked";
			} else {
				$checked = "";
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
				"checked" => $checked
			));
		}
	} else {
		error_log('Wardrobe: query select clothes returns no result '.__FILE__);
	}
}

// Output dalam JSON
echo json_encode($data);
?>