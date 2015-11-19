<?php
// Prearations
if(isset($_GET["id1"])&&isset($_GET["id2"])) {
	$id1 = $_GET["id1"];
	$id2 = $_GET["id2"];
} else {
	error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : "clothes id not set"');
}
session_start(); // Session
include "../db-connect.php"; // Connect
$data = array();

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Query DELETE layers
	$query = "DELETE FROM layers WHERE ((id_clothes1='$id1' AND id_clothes2='$id2') OR (id_clothes1='$id2' AND id_clothes2='$id1'))";
	$result = mysql_query($query,$db);
	if(!$result) {
		error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : "query delete layers error"');
	}

// Neo4j
}else if($_SESSION['db_mode']=="Neo4j") {
	// Query DELETE layers & relationship
}

// Back
header('Location: ../clothes-detail.php?id='.$id1);
?>