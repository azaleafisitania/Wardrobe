<?php
// Preparations
$id = $_GET["id"];
session_start(); // Session
$username = $_SESSION['username'];
include "../db-connect.php"; // Connect
$clothes = array(); // Temp
$data = array(); // Data

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Query SELECT outfit
	$query = "SELECT * FROM outfits WHERE id = $id";
	$result = mysql_query($query,$db);
	if($result) {
		// Query SELECT clothes
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
			error_log('Wardrobe: query select clothes error in '.__FILE__);
		}
		// Push data
		array_push($data, array(
			"id" => $id,
			"clothes" => $clothes
		));
	} else {
		error_log('Wardrobe: query select outfit error in '.__FILE__);
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	$query = "MATCH (u:User)-[:OWN]->(n:Clothes)-[:CREATE]->(o:Outfit) WHERE u.username = '$username' AND o.name='$id' RETURN (o),(n)";
	$response = $client->sendCypherQuery($query)->getRows();
	// Result
	if(!empty($response)) {
		$id = $response['o'][0]['name'];
		$clothes_all = $response['n'];
		for($i=0;$i<sizeof($clothes_all);$i++) {
			// Check photo
			if(($clothes_all[$i]['photo'])&&(file_exists("../images/".$username."/".$clothes_all[$i]['photo']))) {
				$photo = "images/".$username."/".$clothes_all[$i]['photo'];
			} else {
				$photo = "images/Photo Here.jpg";
			}
			array_push($clothes, array(
				"id" => $clothes_all[$i]["name"],
				"photo" => $photo,
				"category" => $clothes_all[$i]["category"]
			));
		}
		// Push data
		array_push($data, array(
			"id" => $id,
			"clothes" => $clothes
		));
	} else {
		error_log('Wardrobe: query select outfit and clothes error in '.__FILE__);	
	}
}

// Output dalam JSON
echo json_encode($data);

// Cleanup
unset($clothes);
unset($data);
?>