<?php
error_log('[Wardrobe Info] '.__FILE__.' line '.__LINE__.' : user logout '.$_SESSION['username']);
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['username']);
unset($_SESSION['user']);
unset($_SESSION['profpic']);
unset($_SESSION['db_mode']);
header("Location: ../login.php"); // Redirect
?>