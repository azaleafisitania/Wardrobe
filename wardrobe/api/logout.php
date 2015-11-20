<?php
error_log('Wardrobe: user '.$_SESSION['username'].' logs out');
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['username']);
unset($_SESSION['user']);
unset($_SESSION['profpic']);
//unset($_SESSION['db_mode']);
header("Location: ../login.php"); // Redirect
?>