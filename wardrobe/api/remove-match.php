<?php
// Check if set
if(isset($_GET["id1"])&&isset($_GET["id2"])) {
	$id1 = $_GET["id1"];
	$id2 = $_GET["id2"];
}
else 
	die('{"status":404},"msg":"Clothes id not selected"');

//Connect
include "../db-connect.php";
$data = array();

// Select mode
$mode = "mysql"; //or "neo4j"
if($mode=="mysql"){
	// Query update matches
	$query = "DELETE FROM matches WHERE ((id_clothes1='$id1' AND id_clothes2='$id2') OR (id_clothes1='$id2' AND id_clothes2='$id1'))";
	$result = mysql_query($query,$db);
	if($result) {
		header('Location: ../clothes-detail.php?id='.$id1);
	} else {
		die('{"status":404},"msg":"Failed to remove data"');
	}
}else if($mode=="neo4j"){
	//select clothes
}else{
	die('{"status":412},"msg":"Must choose MySQL or Neo4j"');
}
?>