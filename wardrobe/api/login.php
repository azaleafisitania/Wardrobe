<?php
// Preparations
session_start(); // Session
if(!isset($_SESSION['db_mode'])) $_SESSION['db_mode'] = "MySQL";
include "../db-connect.php"; // Connect

// Get parameters
if(isset($_POST['username'])) {
	$username = $_POST['username'];
} else {
	error_log('Wardrobe: username not specified in '.__FILE__);
	header("Location: ../login.php");
}
if(isset($_POST['password'])) {
	$password = $_POST['password'];
} else {
	error_log('Wardrobe: password not specified in '.__FILE__);
	header("Location: ../login.php");
}

// MySQL
if($_SESSION['db_mode']=="MySQL") {
	// Query SELECT, get username
	$query = "SELECT * FROM user WHERE username='$username'";
	$result = mysql_query($query,$db);
	// Result: User exists
	if($result) {
		$row = mysql_fetch_array($result);
		if($password==$row['password']) {
			$_SESSION['username'] = $username;
			$_SESSION['name'] = $row['name'];
			$_SESSION['profpic'] = $row['profpic'];
			error_log('Wardrobe: user '.$username.' logs in');
			header("Location: ../index.php"); // Redirect
		} else {
			error_log('Wardrobe: error password does not match');
			header("Location: ../login.php");
		}
	// Result: User not found
	} else {
		error_log('Wardrobe: error user is not found in database');
		header("Location: ../login.php");
	}

} else if($_SESSION['db_mode']=="Neo4j") {
	// Query SELECT, get username
	$query = "MATCH (u:User) WHERE u.username = '$username' RETURN u";
	$response = $client->sendCypherQuery($query)->getRows();
	// Result: User exists
	if(!empty($response)) {
		$user = $response['u'][0];
		if($password==$user['password']) {
			$_SESSION['username'] = $username;
			$_SESSION['name'] = $user['name'];
			$_SESSION['profpic'] = $user['profpic'];
			error_log('Wardrobe: user '.$username.' logs in');
			header("Location: ../index.php"); // Redirect
		} else {
			error_log('Wardrobe: error password does not match');
			header("Location: ../login.php");
		}
	} else {
		error_log('Wardrobe: error user is not found in database');
		header("Location: ../login.php");
	}
}
?>