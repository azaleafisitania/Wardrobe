<?php
// Check if set
if(isset($_GET["_category"])&&($_GET["_category"]!="")) {
	$CATEGORY = ' WHERE name = "'.$_GET["_category"].'"';	
} else {
	$CATEGORY = "";
}

// Connect DB
include "../db-connect.php";
$data = array();
$mode = "mysql"; //or "neo4j"
if($mode=="mysql"){
	//select categories
	$query = "SELECT * FROM category $CATEGORY";
	$result = mysql_query($query,$db);
	if($result){
		while($row = mysql_fetch_array($result)){
			array_push($data, array(
				"id" => $row["id"],
				"name" => $row["name"],
				"total" => $row["total"]
				)
			);
		}
		//output dalam JSON
		echo json_encode($data);
	}else{
		die('{"status":404}');
	}
}else if($mode=="neo4j"){
	//select categories
}else{
	die('{"status":412},"msg":"must choose MySQL or Neo4j"');
}
?>