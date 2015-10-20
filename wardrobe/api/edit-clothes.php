<?php
$id = $_GET['id'];
$category = $_POST['category'];
$brand = $_POST['brand'];
$color = $_POST['color'];
$pattern = $_POST['pattern'];
$retailer = $_POST['retailer'];
$price = $_POST['price'];
$occasion = $_POST['occasion'];

// Connect
include "../db-connect.php";

// Query update clothes
$query = "UPDATE clothes SET category = '$category', brand = '$brand', color = '$color', pattern = '$pattern', retailer = '$retailer', price = '$price', occasion = '$occasion' WHERE id = '$id'";
//echo $query;
$result = mysql_query($query,$db);
header('Location: ../clothes-detail.php?id='.$id);
?>


