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
		error_log('Wardrobe: query select returns no result in '.__FILE__.' on line '.__LINE__);
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	// Check parameter
	if(isset($_GET["category"])&&($_GET["category"]!="")) {
		$CATEGORY = "AND n.category = '".$_GET["category"]."'";
	} else {
		$CATEGORY = "";
	}
	// Query LABEL
	$query = "MATCH (u:User)-[:OWN]->(n:Clothes) WHERE u.username = '$username' $CATEGORY RETURN DISTINCT n.category ORDER BY n.category";
	$response = $client->sendCypherQuery($query)->getRows();
	$categories = $response['n.category'];
	if($categories) {
		for($i=0;$i<sizeof($categories);$i++) {
			// Query COUNT
			$query2 = "MATCH (n:Clothes) WHERE n.category = '".$categories[$i]."' RETURN COUNT(n)";
			$response2 = $client->sendCypherQuery($query2)->getRows();
			$total = $response2['COUNT(n)'];
			// Push data
			array_push($data, array(
				"name" => $categories[$i],
				"total" => $total
			));
		}
	} else {
		error_log('Wardrobe: query select categories returns no result in '.__FILE__.' on line '.__LINE__);
	}
}

// Output dalam JSON
echo json_encode($data);
?>