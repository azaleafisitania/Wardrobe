<?php
// Preparations
$id = $_GET["id"];
if(isset($_GET["limit"])) $LIMIT = "LIMIT ".$_GET["start"].",".$_GET["limit"];
else $LIMIT = "";
session_start(); // Session
$username = $_SESSION['username'];
include "../db-connect.php"; // Connect
$data = array();

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Query SELECT outfit
	$query = "SELECT * FROM outfits WHERE id = $id $LIMIT";
	$result = mysql_query($query,$db);
	if($result) {
		// Query SELECT clothes
		$clothes = array();
		$query = "SELECT id_clothes, id_outfit, photo, category FROM creates INNER JOIN clothes WHERE id_outfit='$id' AND creates.id_clothes=clothes.id ORDER BY category";
		$result = mysql_query($query,$db);
		if($result) {
			while($row = mysql_fetch_array($result)) {
				// Check photo
				if(($row['photo'])&&(file_exists("../images/".$username."/".$row['photo']))) {
					$photo = "images/".$username."/".$row['photo'];
				} else {
					$photo = "images/Photo Here.jpg";
				}
				array_push($clothes, array(
					"id" => $row["id_clothes"],
					"photo" => $photo,
					"category" => $row["category"]
					));
			}
		} else {
			error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : query select clothes error');
		}
		// Push data
		array_push($data, array(
			"id" => $id,
			"clothes" => $clothes
			));
	} else {
		error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : query select outfit error');
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {

}

// Output dalam JSON
echo json_encode($data);
?>