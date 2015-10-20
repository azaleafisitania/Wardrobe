<?php
$id = $_GET['id'];
// Connect
include "../db-connect.php";

// Query update clothes
$query = "DELETE FROM clothes WHERE id = '$id'";
echo $query;
$result = mysql_query($query,$db);
header('Location: ../clothes.php?');
?>


