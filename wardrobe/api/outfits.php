<?php
// Preparations
if(isset($_GET["limit"])&&isset($_GET["start"])) $LIMIT = "LIMIT ".$_GET["start"].",".$_GET["limit"];
else $LIMIT = "";
session_start(); // Session
$username = $_SESSION['username'];
include "../db-connect.php"; // Connect
$outfits = array();
$clothes = array();

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Query SELECT id outfits & clothes 
	$query = "SELECT DISTINCT outfits.id, id_clothes, photo, category FROM outfits INNER JOIN creates INNER JOIN clothes WHERE outfits.id=creates.id_outfit AND creates.id_clothes=clothes.id AND clothes.owner = '".$username."' ORDER BY outfits.id";
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
				"owner" => $username
				));
		}
		array_push($outfits, array(
			"id" => $id_outfit,
			"clothes" => $clothes
		));
	} else {
		error_log('Wardrobe: query select outfit and clothes returns no result in '.__FILE__);		
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	// Query SELECT clothes
	$query = "MATCH (u:User)-[:OWN]->(n:Clothes)-[:CREATE]->(o:Outfit) WHERE u.username = '".$username."' RETURN o,n ORDER BY o.name";
	$response = $client->sendCypherQuery($query)->getRows();
	// Result
	if(!empty($response)) {
		$outfits_res = $response['o'];
		$clothes_res = $response['n'];
		$id_outfit = $outfits_res[0]['name']; // First outfit
		for($i=0;$i<sizeof($outfits_res);$i++) {
			// Push outfit 
			if($outfits_res[$i]['name']!==$id_outfit) {
				array_push($outfits, array(
					"id" => $id_outfit,
					"clothes" => $clothes
				));
				$id_outfit = $outfits_res[$i]['name']; // Next outfit
				$clothes = array();
			}
			// Check photo
			if(($clothes_res[$i]['photo'])&&(file_exists("../images/".$username."/".$clothes_res[$i]['photo']))) {
				$photo = "images/".$username."/".$clothes_res[$i]['photo'];
			} else {
				$photo = "images/Photo Here.jpg";
			}
			// Push clothes
			array_push($clothes, array(
				"id" => $clothes_res[$i]["name"],
				"photo" => $photo,
				"category" => $clothes_res[$i]["category"],
				"owner" => $username
			));
		}
		array_push($outfits, array(
			"id" => $id_outfit,
			"clothes" => $clothes
		));
	} else {
		error_log('Wardrobe: query select outfits returns no result in '.__FILE__);
	}
}

// Output dalam JSON
echo json_encode($outfits);
?>