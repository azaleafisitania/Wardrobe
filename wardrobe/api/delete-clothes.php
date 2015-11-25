<?php
// Session
if (session_status() == PHP_SESSION_NONE) session_start();
$username = $_SESSION['username'];

// Performance measurement log
include "performance-logger.php";
fwrite($file, "File: add-clothes.php, Mode: ".$_SESSION['db_mode']." \n\n");

$id = $_GET['id']; // Parameter
include "db-connect.php"; // Connect
$error_message = 0;

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
			$error_message = 2;
		}
	} else {
		$error_message = 1;
	}
	// Query DELETE clothes
	$query = "DELETE FROM clothes WHERE id = '$id'";
	
	// Performance measurement
	fwrite($file, "Function: delete clothes\n");
	$start = microtime(true); // Start timer
	$result = mysql_query($query,$db); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($result)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");

	if(!$result) {
		$error_message = 3;
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
			$error_message = 2;
		}
	} else {
		$error_message = 1;
	}
	// Query DELETE clothes
	$query = "MATCH ()-[r]->(n:Clothes) WHERE n.name = '$id' DELETE r,n";
	
	// Performance measurement
	fwrite($file, "Function: delete clothes\n");
	$start = microtime(true); // Start timer
	$response = $client->sendCypherQuery($query)->getResult(); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($response)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");
	
	if(!$response) {
		$error_message = 3;
	}
}

// Error message
switch ($error_message) {
	case 1:
		error_log('Wardrobe '.__FILE__.' : query select photo returns no result');
		break;
	case 2:
		error_log('Wardrobe '.__FILE__.' : php unable to unlink photo, permission issue, moving on');
		break;
	case 3:
		error_log('Wardrobe '.__FILE__.' : failed to delete clothes');
		break;	
	default:
		break;
}

// Back
header('Location: ../clothes.php');

fclose($file); // Close
?>


