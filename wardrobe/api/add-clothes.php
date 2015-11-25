<?php
// Session
if (session_status() == PHP_SESSION_NONE) session_start();
$username = $_SESSION['username'];

// Performance measurement log
include "performance-logger.php";
fwrite($file, "File: add-clothes.php, Mode: ".$_SESSION['db_mode']." \n\n");

include "db-connect.php"; // Connect
$error_message = 0;

// Parameters
if(isset($_POST['category'])&&($_POST['category']!="")) $category = $_POST['category'];
else $category = "others";
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

// MySQL
if($_SESSION['db_mode']=="MySQL"){
	
	// Query SELECT get new id
	$query = "SELECT max(id) FROM clothes";
	
	// Performance measurement
	fwrite($file, "Function: select max(id) from clothes\n");
	$start = microtime(true); // Start timer
	$result = mysql_query($query,$db); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($result)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");
	
	// Result: new id
	if($result) {
		$row = mysql_fetch_array($result);
		$id = $row['max(id)']+1;	
	}

	// Query INSERT new clothes
	$query = "INSERT INTO clothes(id, owner, category, brand, fav, color, pattern, retailer, price, occasion) VALUES ('$id','$username','$category','$brand','$fav','$color','$pattern','$retailer','$price','$occasion')";
	
	// Performance measurement
	fwrite($file, "Function: insert clothes\n");
	$start = microtime(true); // Start timer
	$result = mysql_query($query,$db); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($result)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");

	// Success
	if($result) {

		// Upload photo
		if(($_FILES["file"]["name"])!="") {
			include "upload-photo.php"; // Determine value $uploadSuccess, $photo, $blob_image
			if($uploadSuccess) {
				
				// Query UPDATE photo
				$query = "UPDATE clothes SET photo = '$photo', blob_image = '".mysql_escape_string(base64_encode($blob_image))."' WHERE id = '$id'";
				
				// Performance measurement
				fwrite($file, "Function: set photo and blob_image\n");
				$start = microtime(true); // Start timer
				$result = mysql_query($query,$db); // Execute query
				$time_elapsed = microtime(true) - $start; // End timer
				fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
				fwrite($file, "Memory usage: ".memory_usage($result)." byte\n");
				fwrite($file, date("Y-m-d h:m:s",time()));
				fwrite($file, "\n\n");

			} else {
				$error_message = 3;
			}
		} else {
			$error_message = 2;
		}
	} else {
		$error_message = 1;
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	
	// Query SELECT get new id 
	$query = "MATCH (n:Clothes) RETURN MAX(n.name)";
	
	// Performance measurement
	fwrite($file, "Function: select max(id) from clothes\n");
	$start = microtime(true); // Start timer
	$response = $client->sendCypherQuery($query)->getRows(); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($response)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");
	
	// Result: new id
	$id = $response['MAX(n.name)']+1;
	
	// Query INSERT new clothes
	$query = "MATCH (u:User) WHERE u.username = '$username' CREATE (u)-[:OWN]->(n:Clothes {name:'$id', category: '$category', brand:'$brand', fav:'$fav', color:'$color', pattern:'$pattern', retailer:'$retailer', price:'$price', occasion:'$occasion'})";
	
	// Performance measurement
	fwrite($file, "Function: insert clothes\n");
	$start = microtime(true); // Start timer
	$response = $client->sendCypherQuery($query)->getResult(); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($response)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");
	
	// Result
	if($response) {
		// Upload photo
		if(($_FILES["file"]["name"])!="") {
			include "upload-photo.php"; // Determine value $uploadSuccess, $photo, $blob_image
			if($uploadSuccess) {
				
				// Query UPDATE photo
				$query = "MATCH (n:Clothes { name: '$id' }) SET n.photo = '$photo', n.blob_image = '".base64_encode($blob_image)."'";
				
				// Performance measurement
				fwrite($file, "Function: set photo and blob_image\n");
				$start = microtime(true); // Start timer
				$response = $client->sendCypherQuery($query)->getResult(); // Execute query
				$time_elapsed = microtime(true) - $start; // End timer
				fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
				fwrite($file, "Memory usage: ".memory_usage($response)." byte\n");
				fwrite($file, date("Y-m-d h:m:s",time()));
				fwrite($file, "\n\n");	
			
			} else {
				$error_message = 3;
			}
		} else {
			$error_message = 2;
		}
	} else {
		$error_message = 1;
	}
}

// Error message
switch ($error_message) {
	case 1:
		error_log('Wardrobe '.__FILE__.' : failed to insert clothes to database');
		header('Location: ../add-clothes.php'); // Redirect
		break;
	case 2:
		error_log('Wardrobe '.__FILE__.' : no photo uploaded, moving on');
		break;
	case 3:
		error_log('Wardrobe '.__FILE__.' : failed to set uploaded photo in database');
		break;	
	default:
		break;
}

// Back
header('Location: ../clothes-detail.php?id='.$id.'&success=1');

fclose($file); // Close
?>