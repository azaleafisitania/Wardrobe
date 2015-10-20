<?php
// Check if set
$category = $_GET["_category"];
if($category=="") $category = "";
else $category = ' WHERE category = "'.$category.'"';

// Connect DB
include "../db-connect.php";
$data = array();

// Select mode
$mode = "mysql"; //or "neo4j"
if($mode=="mysql"){
	// Query select clothes
	$query = "SELECT * FROM clothes $category ORDER BY category";
	$result = mysql_query($query,$db);
	if($result){
		while($row = mysql_fetch_array($result)){
			array_push($data, array(
				"id" => $row["id"],
				"photo" => $row["photo"],
				"fav" => $row["fav"],
				"category" => $row["category"]
				)
			);
		}
		//output dalam JSON
		echo json_encode($data);
	}else{
		die('{"status":404}');
	}
}else if($mode=="neo4j"){
	//select clothes
}else{
	die('{"status":412},"msg":"must choose MySQL or Neo4j"');
}
?>