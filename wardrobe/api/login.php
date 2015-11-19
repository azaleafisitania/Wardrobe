<?php
// Preparations
session_start(); // Session
$_SESSION['db_mode'] = "MySQL";
include "../db-connect.php"; // Connect

// Get parameters
if(isset($_POST['username'])) {
	$username = $_POST['username'];
} else {
	error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : username not specified');
	header("Location: ../login.php");
}
if(isset($_POST['password'])) {
	$password = $_POST['password'];
} else {
	error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : password not specified');
	header("Location: ../login.php");
}

// Query SELECT, get username
$query = "SELECT username FROM user WHERE username='$username'";
$result = mysql_query($query,$db);
// Result: User exists
if($result) {
	// Query SELECT, get password etc
	$query = "SELECT name, password, profpic FROM user WHERE username='$username'";
	$result = mysql_query($query,$db);
	$row = mysql_fetch_array($result);
	// Password match
	if($password==$row['password']) {
		$_SESSION['username'] = $username;
		$_SESSION['name'] = $row['name'];
		$_SESSION['profpic'] = $row['profpic'];
		error_log('[Wardrobe Info] '.__FILE__.' line '.__LINE__.' : user login '.$_SESSION['username']);
		header("Location: ../index.php"); // Redirect
	// Password not match
	} else {
		error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : wrong password');
		header("Location: ../login.php");
	}
// Result: User not found
} else {
	error_log('[Wardrobe Error] '.__FILE__.' line '.__LINE__.' : user not found in database');
	header("Location: ../login.php");
}
?>