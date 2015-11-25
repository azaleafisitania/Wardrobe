<?php
session_start();
if(isset($_GET['db_mode'])) {
	$_SESSION['db_mode'] = $_GET['db_mode'];
}
?>  