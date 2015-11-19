<?php
// Preparations
if((isset($_GET["id"]))&&(isset($_POST["clothes"]))) {
	$id_outfit = $_GET["id"];
	$new_ids = $_POST["clothes"];
} else {
	header("Location: ../outfit-detail.php?id=".$_GET['id']);
}
session_start(); // Session
include "../db-connect.php"; // Connect

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	$old_ids = array();
	$query = "SELECT id_clothes FROM creates WHERE id_outfit='$id_outfit'";
	$result = mysql_query($query,$db);
	while($row = mysql_fetch_array($result)) {
		array_push($old_ids, $row['id_clothes']);
	}

	$removed_ids = array_merge(array(),array_diff($old_ids,$new_ids));
	$inserted_ids = array_merge(array(),array_diff($new_ids,$old_ids));

	// Query delete old clothes
	if($removed_ids) {
		$query = "DELETE FROM creates WHERE id_clothes IN (".implode(",",$removed_ids).")";	
	}
	//echo $query;
	$result = mysql_query($query,$db);
	if(!$result) die('{"status":404},"msg":"Error unlinking old clothes"');

	// Query insert new clothes
	for($i=0;$i<sizeof($inserted_ids);$i++) {
		echo $inserted_ids[0];
		$query = "INSERT INTO creates (id_outfit, id_clothes) VALUES (".$id_outfit.",".$inserted_ids[$i].")";
		//echo $query;
		$result = mysql_query($query,$db);
		if(!$result) die('{"status":404},{"msg":"Error linking new clothes"}');
	}
} else if($_SESSION['db_mode']=="Neo4j") {

}

// Back
header("Location: ../outfit-detail.php?id=".$id_outfit);
?>


