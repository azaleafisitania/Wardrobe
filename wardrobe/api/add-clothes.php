<?php
// Upload photo
include "upload-photo.php"; //$uploadSuccess is determined here

// Check if upload succeed 
if(!$uploadSuccess) {
	header('Location: ../add-clothes.php');
} else {
	$photo = $_FILES["file"]["name"];
	if(isset($_POST['category'])) $category = $_POST['category'];
	else $category = "";
	if(isset($_POST['brand'])) $brand = $_POST['brand'];
	else $brand = "";
	if(isset($_POST['color'])) $color = $_POST['color'];
	else $color = "";
	if(isset($_POST['pattern'])) $pattern = $_POST['pattern'];
	else $pattern = "";
	if(isset($_POST['retailer'])) $retailer = $_POST['retailer'];
	else $retailer = "";
	if(isset($_POST['price'])) $price = $_POST['price'];
	else $price = "";
	if(isset($_POST['occasion'])) $occasion = $_POST['occasion'];
	else $occasion = "";

	//Connect
	include "../db-connect.php";
	$data = array();

	// Select mode
	$mode = "mysql"; //or "neo4j"
	if($mode=="mysql"){

		// Query get max id
		$query = "SELECT max(id) FROM clothes WHERE category='$category'";
		$result = mysql_query($query,$db);
		if($result) {
			$row = mysql_fetch_array($result);
			echo $row['max(id)'];
			$id = $row['max(id)']+1;	
		}

		//Query check id
		$query = "SELECT id FROM clothes WHERE id='$id'";
		$result = mysql_query($query,$db);
		if($result) {
			// Query get new max id
			$query = "SELECT max(id) FROM clothes";
			$result = mysql_query($query,$db);
			if($result) {
				$row = mysql_fetch_array($result);
				$id = $row['max(id)']+1;
			}
		}

		// Query update matches
		$query = "INSERT INTO clothes(id, category, photo, brand, fav, color, pattern, retailer, occasion, price) VALUES ('$id','$category','$photo','$brand','$color','$pattern','$retailer','$price','$occasion','$price')";
		$result = mysql_query($query,$db);
		if($result) {
			header('Location: ../clothes-detail.php?id='.$id);
		} else {
			die('{"status":404},"msg":"Failed to insert data"');
		}
	}else if($mode=="neo4j"){
		//select clothes
	}else{
		die('{"status":412},"msg":"Must choose MySQL or Neo4j"');
	}
}
?>