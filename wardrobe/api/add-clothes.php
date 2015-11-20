<?php
session_start(); // Session
include "../db-connect.php"; //Connect

// Get parameters
if(isset($_POST['category'])) $category = $_POST['category'];
else $category = "unknown";
if(isset($_POST['brand'])) $brand = $_POST['brand'];
else $brand = "";
if(isset($_POST['fav'])) $fav = $_POST['fav'];
else $fav = "0";
if(isset($_POST['color'])) $color = $_POST['color'];
else $color = "";
if(isset($_POST['pattern'])) $pattern = $_POST['pattern'];
else $pattern = "";
if(isset($_POST['retailer'])) $retailer = $_POST['retailer'];
else $retailer = "";
if(isset($_POST['price'])) $price = $_POST['price'];
else $price = "0";
if(isset($_POST['occasion'])) $occasion = $_POST['occasion'];
else $occasion = "";
if(isset($_POST['owner'])) $username = $_POST['owner'];
else $username = $_SESSION['username'];

// MySQL
if($_SESSION['db_mode']=="MySQL"){
	// Query SELECT, get new id
	$query = "SELECT max(id) FROM clothes WHERE category='$category'";
	$result = mysql_query($query,$db);
	if($result){
		$row = mysql_fetch_array($result);
		$id = $row['max(id)']+1;	
	}
	$query = "SELECT id FROM clothes WHERE id='$id'";
	$result = mysql_query($query,$db);
	if($result) {
		$query = "SELECT max(id) FROM clothes";
		$result = mysql_query($query,$db);
		if($result) {
			$row = mysql_fetch_array($result);
			$id = $row['max(id)']+1;
		}
	}
	// Query INSERT new clothes
	$query = "INSERT INTO clothes(id, owner, category, brand, fav, color, pattern, retailer, price, occasion) VALUES ('$id','$username','$category','$brand','$fav','$color','$pattern','$retailer','$price','$occasion')";
	$result = mysql_query($query,$db);
	// Result
	if($result) {
		// Upload photo
		if(($_FILES["file"]["name"])!="") {
			include "upload-photo.php"; // Determine value $uploadSuccess, $photo, $blob_image
			if($uploadSuccess) {
				// Query UPDATE photo
				$query = "UPDATE clothes SET photo = '$photo', blob_image = '".mysql_escape_string(base64_encode($blob_image))."' WHERE id = '$id'";
				$result = mysql_query($query,$db);
			} else {
				error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : query update photo fail');
			}
		} else {
			error_log('[Wardrobe Info] '.__FILE__.' line '.__LINE__.' : no photo');
		}
	} else {
		error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : query insert clothes fail');
		header('Location: ../add-clothes.php'); // Redirect
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	// Query SELECT get new id 
	$query = "MATCH (n:Clothes) RETURN MAX(n.name)";
	$response = $client->sendCypherQuery($query)->getRows();
	$id = $response['MAX(n.name)']+1;
	// Query INSERT new clothes
	$query = "MATCH (u:User) WHERE u.username = '$username' CREATE (u)-[:OWN]->(n:Clothes {name:'$id', category: '$category', brand:'$brand', fav:'$fav', color:'$color', pattern:'$pattern', retailer:'$retailer', price:'$price', occasion:'$occasion'})";
	$response = $client->sendCypherQuery($query)->getResult();
	// Result
	if($response) {
		// Upload photo
		if(($_FILES["file"]["name"])!="") {
			include "upload-photo.php"; // Determine value $uploadSuccess, $photo, $blob_image
			if($uploadSuccess) {
				// Query UPDATE photo
				$query = "MATCH (n:Clothes { name: '$id' }) SET n.photo = '$photo', n.blob_image = '".base64_encode($blob_image)."'";
				$response = $client->sendCypherQuery($query)->getResult();
			} else {
				error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : query update photo fail');
			}
		} else {
			error_log('[Wardrobe Info] '.__FILE__.' line '.__LINE__.' : no photo');
		}
	} else {
		error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : query insert clothes fail');
		header('Location: ../add-clothes.php'); // Redirect
	}
}

// Back
header('Location: ../clothes-detail.php?id='.$id.'&success=1');
?>