<?php

$id = $_GET['id'];
// Connect
include "../db-connect.php";

// Upload photo 
if(($_FILES["file"]["name"])!="") {
	include "upload-photo.php"; //$uploadSuccess is determined here	
	// Check if upload succeed 
	if(!$uploadSuccess) {
		header('Location: ../clothes-detail.php?id='.$id);
	} else {
		$query = "SELECT photo FROM clothes WHERE id='$id'";
		$result = mysql_query($query,$db);
		$row = mysql_fetch_array($result);
		chmod("../images/azalea/".$row['photo']);
		unlink("../images/azalea/".$row['photo']);
		$photo = $_FILES["file"]["name"];
		$query_photo = "photo = '$photo', ";
		//echo $query_photo;
	}
} else {
	$query_photo = "";
}
$category = $_POST['category'];
$brand = $_POST['brand'];
$color = $_POST['color'];
$pattern = $_POST['pattern'];
$retailer = $_POST['retailer'];
$price = $_POST['price'];
$occasion = $_POST['occasion'];

// Query update clothes
$query = "UPDATE clothes SET $query_photo category = '$category', brand = '$brand', color = '$color', pattern = '$pattern', retailer = '$retailer', price = '$price', occasion = '$occasion' WHERE id = '$id'";
//echo $query;
$result = mysql_query($query,$db);
header('Location: ../clothes-detail.php?id='.$id);
?>


