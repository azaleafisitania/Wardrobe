<?php
// Session
session_start();
$username = $_SESSION['username'];

// Check if id is set
if(isset($_GET["id"])) {
	$id = $_GET["id"];
} else {
	header('Location: ../clothes.php');
}

// Connect
include "../db-connect.php";
$data = array();

// MySQL
if($_SESSION['db_mode']=="MySQL"){
	// MySQL query SELECT
	$query = "SELECT * FROM clothes WHERE id = $id";
	$result = mysql_query($query,$db);
	// Result
	if($result){
		while($row = mysql_fetch_array($result)){
			// Checks
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
			if($row['price']!=null) $price = "IDR ".number_format(($row['price'])); 
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
	// Fail
	} else {
		error_log('[Wardrobe][ERROR] MySQL query SELECT ('.__FILE__.' line '.__LINE__.')');
	}

// Neo4j
}else if($_SESSION['db_mode']=="Neo4j"){
	// Cyper query SELECT
	$query = "MATCH (n:Clothes) WHERE n.name = '".$id."' RETURN n, LABELS(n)";
	$response = $client->sendCypherQuery($query)->getRows();
	$clothes = $response['n'][0];
	$category = $response['LABELS(n)'][0][1];
	// Result
	if($clothes) {
		// Checks
		if(($clothes['photo'])&&(file_exists("../images/".$username."/".$clothes['photo']))) {
				$photo = "images/".$username."/".$clothes['photo'];
			} else {
				$photo = "images/Photo Here.jpg";
			}
			if($clothes['fav']!=null) $fav = $clothes['fav']; 
			else $fav = "";
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
	} else {
		error_log('[Wardrobe][ERROR] Cypher query SELECT ('.__FILE__.' line '.__LINE__.')');
	}
}

// Output dalam JSON
echo json_encode($data);
?>