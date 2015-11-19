<?php
// Preparations
if(isset($_GET["id"])) $id_outfit = $_GET["id"];
error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : "outfit id not set"');
if(isset($_GET["limit"])&&isset($_GET["start"]))  $LIMIT = "LIMIT ".$_GET["start"].",".$_GET["limit"];
else $LIMIT = "";
session_start(); // Session
$username = $_SESSION['username'];
include "../db-connect.php"; // Connect
$data = array(); // Data

// Mode MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Query SELECT, get clothes id(s) of outfit
	$checked_clothes = array();
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
		error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : "query select clothes error"');
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	//select clothes
}

// Output dalam JSON
echo json_encode($data);
?>