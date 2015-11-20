<?php
// Preparations
if (isset($_POST["clothes"])) {
	$clothes_ids = $_POST["clothes"];
} else {
	error_log('Wardrobe: ids clothes not set in '.__FILE__);
	header("Location: ../create-outfit.php");
}
session_start(); // Session
$username = $_SESSION['username'];
include "../db-connect.php"; // Connect

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Query SELECT get new id
	$query = "SELECT max(id) FROM outfits";
	$result = mysql_query($query,$db);
	if($result) {
		$row = mysql_fetch_array($result);
		$id = $row['max(id)']+1;
	} else {
		$id = 1;
	}
	// Query INSERT new outfit
	$query = "INSERT INTO outfits(id) VALUES ('".$id."')";
	$result = mysql_query($query,$db);
	if($result) {
		for($i=0;$i<sizeof($clothes_ids);$i++) {
			// Query INSERT new creates
			$query = "INSERT INTO creates(id_outfit, id_clothes) VALUES ('".$id."','".$clothes_ids[$i]."')";
			$result = mysql_query($query,$db);
			if(!$result) {
				error_log('Wardrobe: query insert clothes-outfit relationship error in '.__FILE__);
				header('Location: ../outfits.php?');
			}
		}
	} else {
		error_log('Wardrobe: query insert outfit error in '.__FILE__);
		header('Location: ../outfits.php?');
	}

// Neo4j
} else if($_SESSION['db_mode']=="Neo4j") {
	// Query SELECT get new id
	$query = "MATCH (u:User)-[:OWN]->(n:Clothes)-[:CREATE]->(o:Outfit) WHERE u.username = '$username' RETURN MAX(o.name)";
	$response = $client->sendCypherQuery($query)->getRows();
	$id = $response['MAX(o.name)'][0]+1;
	// Query INSERT new outfit
	$query = "CREATE (o:Outfit {name:'$id'})";
	echo $query;
	$response = $client->sendCypherQuery($query)->getResult();
	$query = 'MATCH (u:User)-[:OWN]->(n:Clothes),(o:Outfit) WHERE u.username = "'.$username.'" AND n.name IN '.json_encode($clothes_ids).' AND o.name = "'.$id.'" CREATE (n)-[:CREATE]->(o)';
	$response = $client->sendCypherQuery($query)->getResult();
}

// Continue
header('Location: ../outfit-detail.php?id='.$id);
?>