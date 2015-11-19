<?php
// Check if set
if(isset($_GET["quantity"])) {
	$LIMIT = "LIMIT ".$_GET["quantity"];
} else {
	$LIMIT = "";
}
if(isset($_GET["category"])) {
	$CATEGORY = ' category IN ('.implode(",",$_GET["_category"]).')';	
} else {
	$CATEGORY = "";
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