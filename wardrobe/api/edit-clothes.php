<?php
// Session
if (session_status() == PHP_SESSION_NONE) session_start();
$username = $_SESSION['username'];

// Performance measurement log
include "performance-logger.php";
fwrite($file, "File: add-clothes.php, Mode: ".$_SESSION['db_mode']." \n\n");

$id = $_GET['id']; // Get id clothes
include "db-connect.php"; // Connect
$error_message = 0;

// Get parameters
$category = $_POST['category'];
$fav = $_POST['fav'];
$brand = $_POST['brand'];
$color = $_POST['color'];
$pattern = $_POST['pattern'];
$retailer = $_POST['retailer'];
$price = $_POST['price'];
$occasion = $_POST['occasion'];

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	
	// Photo handling
	$query_photo = "";
	$query_blob = "";
	if(($_FILES["file"]["name"])!="") {
		// Get old photo
		$query = "SELECT owner, photo  FROM clothes WHERE id='$id'";
		$result = mysql_query($query,$db);
		if($result) {
			$row = mysql_fetch_array($result);
			chmod("../images/".$username."/".$row['photo'],0755); // Change permission
			if(is_writable("../images/".$username."/".$row['photo'])) {
				rename("../images/".$username."/".$row['photo'], "../images/".$username."/delete_".$row['photo']); // Rename

				// Upload photo
				include "upload-photo.php"; // Determine value $uploadSuccess, $photo, $blob_image
				// Success
				if($uploadSuccess) {
					unlink("../images/".$username."/delete_".$row['photo']); // Delete
					$query_photo = "photo = '$photo',"; // Subquery for photo
					$query_blob = "blob_image = '".mysql_escape_string($blob_image)."',"; // Subquery for blob_image
				// Fail
				} else {
					rename("../images/".$username."/delete_".$row['photo'], "../images/".$username."/".$row['photo']); // Rename
					$error_message = 2;
				}
			} else {
				$error_message = 1;
			}
		}
	}
		
	// Query update clothes
	$query = "UPDATE clothes SET $query_photo $query_blob category = '$category', fav = '$fav', brand = '$brand', color = '$color', pattern = '$pattern', retailer = '$retailer', price = '$price', occasion = '$occasion' WHERE id = '$id'";
	
	// Performance measurement
	fwrite($file, "Function: edit clothes\n");
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
	// Photo handling
	$query_photo = "";
	$query_blob = "";
	if(($_FILES["file"]["name"])!="") {
		// Get old photo
		$query = "MATCH (n:Clothes) WHERE n.name = '$id' RETURN n.photo";
		$response = $client->sendCypherQuery($query)->getRows();
		$old_photo = $response['n.photo'][0];
		// Result
		if($old_photo){
			chmod("../images/".$username."/".$old_photo,0755); // Change permission
			if(is_writable("../images/".$username."/".$old_photo)) {
				rename("../images/".$username."/".$old_photo, "../images/".$username."/delete_".$old_photo); // Rename
				
				// Upload photo
				include "upload-photo.php"; // Determine value $uploadSuccess, $photo, $blob_image
				// Success
				if($uploadSuccess){
					unlink("../images/".$username."/delete_".$old_photo); // Delete
					$query_photo = "n.photo = '".$photo."',"; // Subquery for photo
					$query_blob = "n.blob_image = '".base64_encode($blob_image)."',"; // Subquery for blob_image
				// Fail
				} else {
					rename("../images/".$username."/delete_".$old_photo, "../images/".$username."/".$old_photo); // Rename
					$error_message = 2;
				}
			} else {
				$error_message = 1;
			}
		}
	}
	// Query update clothes
	$query = "MATCH (n:Clothes) WHERE n.name = '$id' SET $query_photo $query_blob n.category = '$category', n.fav = '$fav', n.brand = '$brand', n.color = '$color', n.pattern = '$pattern', n.retailer = '$retailer', n.price = '$price', n.occasion = '$occasion'";
	
	// Performance measurement
	fwrite($file, "Function: edit clothes\n");
	$start = microtime(true); // Start timer
	$response = $client->sendCypherQuery($query)->getResult(); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($response)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");
}

// Error message
switch ($error_message) {
	case 1:
		error_log('Wardrobe '.__FILE__.' : "cannot mark old photo to be deleted, permission issue"');
		break;
	case 2:
		error_log('Wardrobe '.__FILE__.' : failed to upload new photo, but old photo is save');
		break;
	case 3:
		error_log('Wardrobe '.__FILE__.' :  failed to update clothes');
		break;
	default:
		break;
}

// Back
header('Location: ../clothes-detail.php?id='.$id);

fclose($file); // Close
?>


