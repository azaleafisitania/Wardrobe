<?php
// Preparations
if(isset($_GET["id1"])&&isset($_GET["id2"])) {
	$id1 = $_GET["id1"];
	$id2 = $_GET["id2"];
} else {
	error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : "clothes ids not set"');
}
include "../db-connect.php"; //Connect
$data = array();

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Query INSERT, new matches
	$query = "INSERT INTO matches(id_clothes1, id_clothes2) VALUES ('$id1','$id2')";
	$result = mysql_query($query,$db);
	if(!$result) {
		error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : "query insert matches error"');
	}

// Neo4j	
} else if($_SESSION['db_mode']=="Neo4j") {
	// Query INSERT, new matches
}

// Back
header('Location: ../clothes-detail.php?id='.$id1);
?>