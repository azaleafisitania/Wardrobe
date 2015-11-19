<?php
// Session
session_start();
$username = $_SESSION['username'];

// Connect DB
include "../db-connect.php";
$data = array();

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Check parameter
	if(isset($_GET["category"])&&($_GET["category"]!="")) {
		$CATEGORY = 'AND category = "'.$_GET["category"].'"';	
	} else {
		$CATEGORY = "";
	}
	// Query SELECT
	$query = "SELECT DISTINCT category FROM clothes WHERE owner = '".$username."' $CATEGORY GROUP BY CATEGORY";
	$result = mysql_query($query,$db);
	if($result) {
		while($row = mysql_fetch_array($result)) {
			// Query SELECT COUNT
			$query2 = "SELECT count(id) FROM clothes WHERE owner = '".$username."' AND category = '".$row['category']."' GROUP BY CATEGORY";
			$result2 = mysql_query($query2,$db);
			$row2 = mysql_fetch_array($result2);
			// Push data
			array_push($data, array(
				"name" => $row['category'],
				"total" => $row2['count(id)']
			));
		}
	} else {
		error_log('[Wardrobe][ERROR] MySQL query select ('.__FILE__.' line '.__LINE__.')');
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	// Check parameter
	if(isset($_GET["category"])&&($_GET["category"]!="")) {
		$CATEGORY = ":".$_GET["category"];	
	} else {
		$CATEGORY = "";
	}
	// Cypher Query LABEL
	$query = "MATCH (u:User)-[:OWN]->(n:Clothes".$CATEGORY.") WHERE u.username = '".$username."' RETURN DISTINCT LABELS(n)";
	$response = $client->sendCypherQuery($query)->getRows();
	$labels = $response['LABELS(n)'];
	if($labels) {
		for($i=0;$i<sizeof($labels);$i++) {
			// Cypher Query COUNT
			$query2 = "MATCH (n:Clothes:".$labels[$i][1].") RETURN COUNT(n)";
			$response2 = $client->sendCypherQuery($query2)->getRows();
			$total = $response2['COUNT(n)'];
			// Push data
			array_push($data, array(
				"name" => $labels[$i][1],
				"total" => $total
			));
		}
	} else {
		error_log('[Wardrobe][ERROR] Cypher query select ('.__FILE__.' line '.__LINE__.')');
	}
}

// Output dalam JSON
echo json_encode($data);
?>