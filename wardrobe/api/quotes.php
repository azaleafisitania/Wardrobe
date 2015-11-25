<?php
// Session
session_start();

include "db-connect.php"; // Connect
$data = array(); // Data

if($_SESSION['db_mode']=="MySQL") {
	// Query SELECT quotes
	$query = "select * from quotes";
	$result = mysql_query($query,$db);
	if($result) {
		while($row = mysql_fetch_array($result)) {
			array_push($data, array(
				"id" => $row["id"],
				"quote" => $row["quote"],
				"author" => $row["author"],
				"position" => $row["position"]
				)
			);
		}
		
	}
} else if($_SESSION['db_mode']=="Neo4j") {
	// Query SELECT quotes
}

// Output dalam JSON
echo json_encode($data);
?>