<?php
// Check if set
if(isset($_GET["_category"])&&($_GET["_category"]!="")) {
	$CATEGORY = ' WHERE category = "'.$_GET["_category"].'"';	
} else {
	$CATEGORY = "";
}
if(isset($_GET["_limit"])) {
	$LIMIT = "LIMIT ".$_GET["_start"].",".$_GET["_limit"];
} else {
	$LIMIT = "";
}

// Connect DB
include "../db-connect.php";
$data = array();

$mode = "mysql"; //or "neo4j"

// Mode MySQL
if($mode=="mysql"){
	// Query select clothes
	$query = "SELECT id,photo,fav,category FROM clothes $CATEGORY ORDER BY category $LIMIT";
	//echo $query;
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

// Mode Neo4j
}else if($mode=="neo4j"){
	//select clothes

// No mode selected
}else{
	die('{"status":412},"msg":"must choose MySQL or Neo4j"');
}
?>