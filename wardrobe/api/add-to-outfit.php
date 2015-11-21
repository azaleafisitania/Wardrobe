<?php
// Preparations
if(isset($_GET["id1"])&&isset($_GET["id2"])) {
	$id1 = $_GET["id1"];
	$id2 = $_GET["id2"];
} else {
	error_log('Wardrobe: clothes ids not set'.__FILE__);
}
include "../db-connect.php"; //Connect
$data = array(); // Data

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Query INSERT, new matches
	$query = "INSERT INTO creates(id_outfit, id_clothes) VALUES ('$id1','$id2')";
	$result = mysql_query($query,$db);
	if(!$result) {
		error_log('Wardrobe: query insert to outfit error in '.__FILE__);
	}

// Neo4j	
} else if($_SESSION['db_mode']=="Neo4j") {
	// Query INSERT, new matches
	$query = "MATCH (n:Clothes),(o:Outfit) WHERE o.name = '$id1' AND n.name = '$id2' CREATE (n)-[:CREATE]->(o)";
	$response = $client->sendCypherQuery($query)->getResult();
}
?>