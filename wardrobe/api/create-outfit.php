<?php
// Preparations
if (isset($_POST["clothes"])) {
	$clothes_ids = $_POST["clothes"];
} else {
	error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : ids clothes not set');
	header("Location: ../create-outfit.php");
}
session_start(); // Session
include "../db-connect.php"; // Connect

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Query SELECT get new id
	$query = "SELECT max(id) FROM outfits";
	$result = mysql_query($query,$db);
	if($result) {
		$row = mysql_fetch_array($result);
		$id = $row['max(id)']+1;
	} else {
		$id = 1;
	}
	// Query INSERT new outfit
	$query = "INSERT INTO outfits(id) VALUES ('".$id."')";
	$result = mysql_query($query,$db);
	if($result) {
		for($i=0;$i<sizeof($clothes_ids);$i++) {
			// Query INSERT new creates
			$query = "INSERT INTO creates(id_outfit, id_clothes) VALUES ('".$id."','".$clothes_ids[$i]."')";
			$result = mysql_query($query,$db);
			if(!$result) {
				error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : query insert clothes-outfit relationship error');
				header('Location: ../outfits.php?');
			}
		}
	} else {
		error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : query insert outfit error');
		header('Location: ../outfits.php?');
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	// Query SELECT get new id
}

// Continue
header('Location: ../outfit-detail.php?id='.$id);
?>