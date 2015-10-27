<?php
$id = $_GET['id'];
// Connect
include "../db-connect.php";

// Query update clothes
$query = "DELETE FROM outfits WHERE id = '$id'";
$result = mysql_query($query,$db);
header('Location: ../outfits.php?');
?>


