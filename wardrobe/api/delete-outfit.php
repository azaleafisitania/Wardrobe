<?php
session_start(); // Session
$id = $_GET['id']; // Get id outfit
include "../db-connect.php"; // Connect

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Query DELETE outfit
	$query = "DELETE FROM outfits WHERE id = '$id'";
	$result = mysql_query($query,$db);

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	// Query DELETE outfit
	$query = "MATCH ()-[r]->(o:Outfit) WHERE o.name = '".$id."' DELETE r,o";
	$response = $client->sendCypherQuery($query)->getRows();
}

// Back
header('Location: ../outfits.php');
?>