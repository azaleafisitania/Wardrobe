<?php
// Check if set
if(isset($_GET["_id"])) 
	$id = $_GET["_id"];
else 
	header('Location: ../clothes.php');

//Connect
include "../db-connect.php";
$data = array();

// Select mode
$mode = "mysql"; //or "neo4j"
if($mode=="mysql"){
	//select clothes
	$query = "SELECT * FROM clothes WHERE id = $id";
	$result = mysql_query($query,$db);
	if($result){
		while($row = mysql_fetch_array($result)){
			array_push($data, array(
				"id" => $row["id"],
				"photo" => $row["photo"],
				"fav" => $row["fav"],
				"brand" => $row["brand"],
				"category" => $row["category"],
				"color" => $row['color'],
				"pattern" => $row["pattern"],
				"retailer" => $row["retailer"],
				"price" => $row["price"],
				"occasion" => $row["occasion"],
			));
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