<?php
// Preparations
if(isset($_GET["id1"])&&isset($_GET["id2"])) {
	$id1 = $_GET["id1"];
	$id2 = $_GET["id2"];
} else {
	error_log('Wardrobe: clothes ids not set'.__FILE__.' line '.__LINE__);
}
include "../db-connect.php"; //Connect
$data = array(); // Data

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Query INSERT, new matches
	$query = "INSERT INTO matches(id_clothes1, id_clothes2) VALUES ('$id1','$id2')";
	$result = mysql_query($query,$db);
	if(!$result) {
		error_log('Wardrobe: query insert matches error '.__FILE__.' line '.__LINE__);
	}

// Neo4j	
} else if($_SESSION['db_mode']=="Neo4j") {
	// Query INSERT, new matches
	$query = "MATCH (n:Clothes),(m:Clothes) WHERE n.name = '$id1' AND m.name = '$id2' CREATE (n)-[:MATCH]->(m)";
	$response = $client->sendCypherQuery($query)->getResult();
	$query = "MATCH (n:Clothes),(m:Clothes) WHERE n.name = '$id1' AND m.name = '$id2' CREATE (m)-[:MATCH]->(n)";
	$response = $client->sendCypherQuery($query)->getResult();
}

// Back
header('Location: ../clothes-detail.php?id='.$id1);
?>