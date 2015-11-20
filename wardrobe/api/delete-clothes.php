<?php
session_start(); // Session
$username = $_SESSION['username'];
$id = $_GET['id']; // Get id clothes
include "../db-connect.php"; // Connect

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Query DELETE old photo
	$query = "SELECT owner, photo FROM clothes WHERE id='$id'";
	$result = mysql_query($query,$db);
	if($result) {
		$row = mysql_fetch_array($result);
		chmod("../images/".$row['owner']."/".$row['photo'],0755); // Change permission
		if(is_writable("../images/".$row['owner']."/".$row['photo'])) {
			unlink("../images/".$row['owner']."/".$row['photo']); // Delete
		} else {
			error_log('Wardrobe: php unable to unlink photo, permission issue in '.__FILE__);
		}
	} else {
		error_log('Wardrobe: query select photo returns no result in '.__FILE__);
	}
	// Query DELETE clothes
	$query = "DELETE FROM clothes WHERE id = '$id'";
	echo $query;
	$result = mysql_query($query,$db);
	if(!$result) {
		error_log('Wardrobe: query delete clothes error in '.__FILE__);
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	// Query SELECT old photo
	$query = "MATCH (n:Clothes) WHERE n.name='$id' RETURN n.photo";
	$response = $client->sendCypherQuery($query)->getRows();
	$old_photo = $response['n.photo'][0];
	// Erase old photo
	if($old_photo) {
		chmod("../images/".$username."/".$old_photo,0755); // Change permission
		if(is_writable("../images/".$username."/".$old_photo)) {
			unlink("../images/".$username."/".$old_photo); // Delete
		} else {
			error_log('Wardrobe: php unable to unlink photo, permission issue in '.__FILE__);
		}
	} else {
		error_log('Wardrobe: query select photo returns no result in '.__FILE__);
	}
	// Query DELETE clothes
	$query = "MATCH ()-[r]->(n:Clothes) WHERE n.name = '$id' DELETE r,n";
	$response = $client->sendCypherQuery($query)->getResult();
	if(!$response) {
		error_log('Wardrobe: query delete clothes error in '.__FILE__);
	}
}

// Back
header('Location: ../clothes.php?');
?>


