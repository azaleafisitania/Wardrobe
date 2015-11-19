<?php
session_start(); // Session
$username = $_SESSION['username'];
$id = $_GET['id']; // Get id clothes
include "../db-connect.php"; // Connect

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
		$query = "SELECT owner, photo FROM clothes WHERE id='$id'";
		$result = mysql_query($query,$db);
		if($result) {
			$row = mysql_fetch_array($result);
			chmod("../images/".$username."/".$row['photo'],0755); // Change permission
			if(is_writable("../images/".$username."/".$row['photo'])) {
				rename("../images/".$username."/".$row['photo'], "../images/".$username."/delete_".$row['photo']); // Rename
			} else {
				error_log('[Wardrobe] '.__FILE__.' line '.__LINE__.' : "[ERROR] cannot rename photo, permission issue"');
			}
		}
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
			error_log('[Wardrobe] '.__FILE__.' line '.__LINE__.' : "[ERROR] fail to upload, but old photo is save"');
		}
	}
		
	// Query update clothes
	$query = "UPDATE clothes SET $query_photo $query_blob category = '$category', fav = '$fav', brand = '$brand', color = '$color', pattern = '$pattern', retailer = '$retailer', price = '$price', occasion = '$occasion' WHERE id = '$id'";
	$result = mysql_query($query,$db);
	if(!$result) {
		error_log('[Wardrobe Error] MySQL query update clothes ('.__FILE__.' line '.__LINE__.')');
	}

// Neo4j
}else if($_SESSION['db_mode']=="Neo4j"){
	// Photo handling
	$query_photo = "";
	$query_blob = "";
	if(($_FILES["file"]["name"])!=""){
		// Get old photo
		$query = "MATCH (n:Clothes) WHERE n.name = '$id' RETURN n.photo";
		$response = $client->sendCypherQuery($query)->getRows();
		$old_photo = $response['n.photo'][0];
		// Result
		if($old_photo){
			chmod("../images/".$username."/".$old_photo,0755); // Change permission
			if(is_writable("../images/".$username."/".$old_photo)) {
				rename("../images/".$username."/".$old_photo, "../images/".$username."/delete_".$old_photo); // Rename
			} else {
				error_log('[Wardrobe Error] Cannot rename photo, permission issue ('.__FILE__.' line '.__LINE__.')');
			}
		}
		// Upload photo
		include "upload-photo.php"; // Determine value $uploadSuccess, $photo, $blob_image
		// Success
		if($uploadSuccess){
			unlink("../images/".$username."/delete_".$old_photo); // Delete
			$query_photo = "n.photo = '".$photo."',"; // Subquery for photo
			$query_blob = "n.blob_image = '".base64_encode($blob_image)."',"; // Subquery for blob_image
		// Fail
		}else{
			rename("../images/".$username."/delete_".$old_photo, "../images/".$username."/".$old_photo); // Rename
			error_log('[Wardrobe Error] Fail to upload, but old photo is save ('.__FILE__.' line '.__LINE__.')');
		}
	}
	// Query update clothes
	$query = "MATCH (n:Clothes) WHERE n.name = '$id' SET $query_photo $query_blob n.category = '$category', n.fav = '$fav', n.brand = '$brand', n.color = '$color', n.pattern = '$pattern', n.retailer = '$retailer', n.price = '$price', n.occasion = '$occasion'";
	$response = $client->sendCypherQuery($query)->getResult();
}

// Back
header('Location: ../clothes-detail.php?id='.$id);
?>


