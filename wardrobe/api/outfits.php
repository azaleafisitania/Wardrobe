<?php
// Preparations
if(isset($_GET["limit"])&&isset($_GET["start"])) $LIMIT = "LIMIT ".$_GET["start"].",".$_GET["limit"];
else $LIMIT = "";
session_start(); // Session
$username = $_SESSION['username'];
include "../db-connect.php"; // Connect
$data = array();

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Query SELECT id outfits & clothes 
	$outfits = array();
	$clothes = array();
	$query = "SELECT DISTINCT outfits.id, id_clothes, photo, category, owner FROM outfits INNER JOIN creates INNER JOIN clothes WHERE outfits.id=creates.id_outfit AND creates.id_clothes=clothes.id AND clothes.owner = '".$username."' ORDER BY outfits.id";
	$result = mysql_query($query,$db);
	// Push data
	if($result) {
		$row = mysql_fetch_array($result);
		$id_outfit = $row['id']; // First outfit
		mysql_data_seek($result, 0);
		while($row = mysql_fetch_array($result)) {
			// Push outfit
			if($row['id']!=$id_outfit) {
				array_push($outfits, array(
					"id" => $id_outfit,
					"clothes" => $clothes
				));
				$id_outfit = $row['id']; // Next outfit
				$clothes = array();
			}
			// Check photo
			if(($row['photo'])&&(file_exists("../images/".$username."/".$row['photo']))) {
				$photo = "images/".$username."/".$row['photo'];
			} else {
				$photo = "images/Photo Here.jpg";
			}
			// Push clothes
			array_push($clothes, array(
				"id" => $row["id_clothes"],
				"photo" => $photo,
				"category" => $row["category"],
				"owner" => $row["owner"]
				));
		}
		array_push($outfits, array(
			"id" => $id_outfit,
			"clothes" => $clothes
		));
	} else {
		error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : query select outfit and clothes error');		
	}

// Neo4j
} else if($_SESSION=="Neo4j") {

}

// Output dalam JSON
echo json_encode($outfits);
?>