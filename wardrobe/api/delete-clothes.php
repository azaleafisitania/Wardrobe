<?php
session_start(); // Session
$username = $_SESSION['username'];
$id = $_GET['id']; // Get id clothes
include "../db-connect.php"; // Connect

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Delete old photo
	$query = "SELECT owner, photo FROM clothes WHERE id='$id'";
	$result = mysql_query($query,$db);
	if($result) {
		$row = mysql_fetch_array($result);
		chmod("../images/".$row['owner']."/".$row['photo'],0755); // Change permission
		if(is_writable("../images/".$row['owner']."/".$row['photo'])) {
			unlink("../images/".$row['owner']."/".$row['photo']); // Delete
		} else {
			error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : "cannot unlink photo, permission issue"');
		}
	} else {
		error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : "photo not found in db"');
	}
	// Query update clothes
	$query = "DELETE FROM clothes WHERE id = '$id'";
	echo $query;
	$result = mysql_query($query,$db);
	if(!$result) {
		error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : "clothes delete query error"');
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	// Cypher query SELECT old photo
	$query = "MATCH (n:Clothes) WHERE n.name='$id' RETURN n.photo";
	$response = $client->sendCypherQuery($query)->getRows();
	$old_photo = $response['n.photo'][0];
	// Erase old photo
	if($old_photo) {
		chmod("../images/".$username."/".$old_photo,0755); // Change permission
		if(is_writable("../images/".$username."/".$old_photo)) {
			unlink("../images/".$username."/".$old_photo); // Delete
		} else {
			error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : "cannot unlink photo, permission issue"');
		}
	} else {
		error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : "photo not found in db"');
	}
	// Cypher query DEELETE "clothes" and "own" relationship
	$query = "MATCH (u:User)-[r:OWN]->(n:Clothes) WHERE n.name = '$id' DELETE r,n";
	$response = $client->sendCypherQuery($query)->getResult();
	if(!$result) {
		error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : "clothes delete query error"');
	}
}

// Back
header('Location: ../clothes.php?');
?>


