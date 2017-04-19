<?php
session_start();

if(!isset($_SESSION["username"]))
{
	header("Location: test_login.php");
	exit();
}

?>
