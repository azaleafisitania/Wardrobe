<?php
// Session
session_start();
$username = $_SESSION['username'];

// Check parameter
if(isset($_GET["limit"])) $LIMIT = "LIMIT ".$_GET["start"].",".$_GET["limit"];
else $LIMIT = "";

include "../db-connect.php"; // Connect
$data = array();

// Mode MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Check parameter
	if(isset($_GET["category"])&&($_GET["category"]!="")) {
		$CATEGORY = "AND category = '".$_GET["category"]."'";	
	} else {
		$CATEGORY = "";
	}
	// MySQL query SELECT
	$query = "SELECT id, photo, fav, category, owner FROM clothes WHERE owner = '".$username."' $CATEGORY ORDER BY category $LIMIT";
	$result = mysql_query($query,$db);
	// Result
	if($result) {
		while($row = mysql_fetch_array($result)) {
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
				"fav" => $row["fav"],
				"category" => $row["category"],
				"owner" => $row["owner"]
			));
		}
	// Fail
	} else {
		error_log('[Wardrobe][ERROR] MySQL query SELECT ('.__FILE__.' line '.__LINE__.')');
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	// Check parameter
	if(isset($_GET["category"])&&($_GET["category"]!="")) {
		$CATEGORY = "AND n.category = ".$_GET["category"];	
	} else {
		$CATEGORY = "";
	}
	// Cypher query MATCH
	$query = "MATCH (u:User)-[:OWN]->(n:Clothes) WHERE u.username = '".$username."' $CATEGORY RETURN n, LABELS(n)";
	$response = $client->sendCypherQuery($query)->getRows();
	$clothes_all = $response['n'];
	$categories_all = $response['LABELS(n)'];
	// Result
	if($clothes_all) {
		for($i=0;$i<sizeof($clothes_all);$i++) {
			$clothes = $clothes_all[$i];
			$category = $categories_all[$i][1]; 
			if(($clothes['photo'])&&(file_exists("../images/".$username."/".$clothes['photo']))) {
				$photo = "images/".$username."/".$clothes['photo'];
			} else {
				$photo = "images/Photo Here.jpg";
			}
			// Push data
			array_push($data, array(
				"id" => $clothes["name"],
				"photo" => $photo,
				"fav" => $clothes["fav"],
				"category" => $category
			));
		}
	// Fail
	} else {
		error_log('[Wardrobe][ERROR] Cypher query SELECT ('.__FILE__.' line '.__LINE__.')');
	}
}

// Output dalam JSON
echo json_encode($data);
?>