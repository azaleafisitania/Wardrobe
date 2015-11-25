<?php
// Parameters
if(isset($_GET["id"])) $id_outfit = $_GET["id"];
else error_log('Wardrobe Notice '.__FILE__.' : outfit id not set');
if(isset($_GET["limit"])&&isset($_GET["start"]))  $LIMIT = "LIMIT ".$_GET["start"].",".$_GET["limit"];
else $LIMIT = "";

// Session
if (session_status() == PHP_SESSION_NONE) session_start();
$username = $_SESSION['username'];

include "db-connect.php"; // Connect
$data = array(); // Data
$checked_clothes = array(); // Temp
$error_message = 0;
	
// MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Query SELECT clothes id(s) of outfit
	$query = "SELECT id_clothes FROM creates WHERE id_outfit = '$id_outfit'";
	$result = mysql_query($query,$db);
	if($result) {
		while($row = mysql_fetch_array($result)) {
			array_push($checked_clothes, $row["id_clothes"]);
		}
	} else {
		$status_error = 1;
	}
	// Query SELECT all clothes
	$query = "SELECT * FROM clothes WHERE owner = '$username' ORDER BY category $LIMIT";
	$result = mysql_query($query,$db);
	// Result
	if($result) {
		while($row = mysql_fetch_array($result)) {
			// Checked and unchecked
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
		$error_message = 2;
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	// Query SELECT clothes id(s) of outfit
	$query = "MATCH (n:Clothes)-[:CREATE]->(o:Outfit) WHERE o.name = '$id_outfit' RETURN n.name";
	$response = $client->sendCypherQuery($query)->getRows();
	if(!empty($response)) {
		$checked_clothes = $response['n.name'];
	} else {
		$error_message = 1;
	}
	// Query SELECT all clothes
	$query = "MATCH (u:User)-[:OWN]->(n:Clothes) WHERE u.username = '$username' RETURN n";
	$response = $client->sendCypherQuery($query)->getRows();
	// Result
	if(!empty($response)) {
		$clothes_all = $response['n'];
		for($i=0;$i<sizeof($clothes_all);$i++) {
			$clothes = $clothes_all[$i];
			// Checked and unchecked
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
		$error_message = 2;
	}
}
unset($checked_clothes);

// Error message
if($error_message==1) {
	error_log('Wardrobe '.__FILE__.' : outfit is not linked to any clothes, moving on');
} else if($error_message==2) {
	error_log('Wardrobe '.__FILE__.' : query select clothes returns no result');
}

// Output dalam JSON
echo json_encode($data);
?>