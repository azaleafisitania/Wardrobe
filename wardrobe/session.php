<?php
session_start();
$_SESSION['db_mode']=$_GET['_db_mode'];
echo $_SESSION['db_mode'];
?>  