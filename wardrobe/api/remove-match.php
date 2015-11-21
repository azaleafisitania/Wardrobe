<?php
// Preparations
if(isset($_GET["id1"])&&isset($_GET["id2"])) {
	$id1 = $_GET["id1"];
	$id2 = $_GET["id2"];
} else {
	error_log('Wardrobe: clothes id not set in '.__FILE__);
}
session_start(); // Session
include "../db-connect.php"; // Connect
$data = array();

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Query DELETE layers
	$query = "DELETE FROM matches WHERE ((id_clothes1='$id1' AND id_clothes2='$id2') OR (id_clothes1='$id2' AND id_clothes2='$id1'))";
	$result = mysql_query($query,$db);
	if(!$result) {
		error_log('Wardrobe: query delete matches error '.__FILE__);
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	// Query DELETE relationship match
	$query = "MATCH (n:Clothes)-[r:MATCH]->(m:Clothes) WHERE (n.name = '$id1' AND m.name = '$id2') OR (n.name = '$id2' AND m.name = '$id1') DELETE r";
	$response = $client->sendCypherQuery($query)->getResult();
}
?>