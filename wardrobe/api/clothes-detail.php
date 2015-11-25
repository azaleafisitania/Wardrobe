<?php
// Session
if (session_status() == PHP_SESSION_NONE) session_start();
$username = $_SESSION['username'];

// Performance measurement log
include "performance-logger.php";
fwrite($file, "File: clothes-detail.php, Mode: ".$_SESSION['db_mode']." \n\n");

// Parameters
if(isset($_GET["id"])) $id = $_GET["id"];
else error_log('Wardrobe '.__FILE__.' : clothes id is not set');

include "db-connect.php"; // Connect
$data = array(); // Data
$error_message = 0;

// MySQL
if($_SESSION['db_mode']=="MySQL"){
	
	// MySQL query SELECT clothes by id
	$query = "SELECT * FROM clothes WHERE id = $id AND owner = '$username'";
	
	// Performance measurement
	fwrite($file, "Function: select clothes detail by id\n");
	$start = microtime(true); // Start timer
	$result = mysql_query($query,$db); // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($result)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");
	
	// Result
	if($result) {
		while($row = mysql_fetch_array($result)){
			// Photo
			if(($row['photo'])&&(file_exists("../images/".$username."/".$row['photo']))) {
				$photo = "images/".$row['owner']."/".$row['photo'];
			} else {
				$photo = "images/Photo Here.jpg";
			}
			if($row['fav']!=null) $fav = $row['fav']; 
			else $fav = "";
			if($row['brand']!=null) $brand = $row['brand']; 
			else $brand = "";
			if($row['category']!=null) $category = $row['category']; 
			else $category = "";
			if($row['color']!=null) $color = $row['color']; 
			else $color = "";
			if($row['pattern']!=null) $pattern = $row['pattern']; 
			else $pattern = "";
			if($row['retailer']!=null) $retailer = $row['retailer']; 
			else $retailer = "";
			if($row['price']!=null) $price = $row['price']; 
			else $price = "";
			if($row['occasion']!=null) $occasion = $row['occasion']; 
			else $occasion = "";
			
			// Push data
			array_push($data, array(
				"id" => $row["id"],
				"owner" => $username,
				"photo" => $photo,
				"fav" => $fav,
				"brand" => $brand,
				"category" => $category,
				"color" => $color,
				"pattern" => $pattern,
				"retailer" => $retailer,
				"price" => $price,
				"occasion" => $occasion
			));
		}
	// No result
	} else {
		$error_message = 1;
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	
	// Cyper query SELECT clothes by id
	$query = "MATCH (u:User)-[:OWN]->(n:Clothes) WHERE u.username = '$username' AND n.name = '$id' RETURN n";
	
	// Performance measurement
	fwrite($file, "Function: select clothes detail by id\n");
	$start = microtime(true); // Start timer
	$response = $client->sendCypherQuery($query)->getRows();; // Execute query
	$time_elapsed = microtime(true) - $start; // End timer
	fwrite($file, "Execution time: ".$time_elapsed." microsecond\n");
	fwrite($file, "Memory usage: ".memory_usage($response)." byte\n");
	fwrite($file, date("Y-m-d h:m:s",time()));
	fwrite($file, "\n\n");
	
	// Result
	if(!empty($response)) {
		$clothes = $response['n'][0];
		// Photo
		if(($clothes['photo'])&&(file_exists("../images/".$username."/".$clothes['photo']))) {
			$photo = "images/".$username."/".$clothes['photo'];
		} else {
			$photo = "images/Photo Here.jpg";
		}
		if($clothes['fav']!=null) $fav = $clothes['fav']; 
		else $fav = "";
		if($clothes['category']!=null) $category = $clothes['category']; 
		else $category = "";
		if($clothes['brand']!=null) $brand = $clothes['brand']; 
		else $brand = "";
		if($clothes['color']!=null) $color = $clothes['color']; 
		else $color = "";
		if($clothes['pattern']!=null) $pattern = $clothes['pattern']; 
		else $pattern = "";
		if($clothes['retailer']!=null) $retailer = $clothes['retailer']; 
		else $retailer = "";
		if($clothes['price']!=null) $price = $clothes['price']; 
		else $price = "";
		if($clothes['occasion']!=null) $occasion = $clothes['occasion']; 
		else $occasion = "";
			
		// Push data
		array_push($data, array(
			"id" => $clothes["name"],
			"owner" => $username,
			"photo" => $photo,
			"fav" => $fav,
			"brand" => $brand,
			"category" => $category,
			"color" => $color,
			"pattern" => $pattern,
			"retailer" => $retailer,
			"price" => $price,
			"occasion" => $occasion
		));
	// No result
	} else {
			$error_message = 1;
	}
}

// Error message
switch ($error_message) {
	case 1:
		error_log('Wardrobe '.__FILE__.' : query select clothes returns no result');
		break;
	default:
		break;
}

// Output dalam JSON
echo json_encode($data);

fclose($file); // Close
?>