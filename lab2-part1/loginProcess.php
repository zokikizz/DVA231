<?php
ini_set('session.cookie_lifetime', 60 * 60 * 24 * 365);
ini_set('session.gc-maxlifetime', 60 * 60 * 24 * 365);
session_start();

if($_REQUEST != NULL )
	if($_REQUEST["username"]=="zoki" && $_REQUEST["password"]=="kizz")
	{
		$_SESSION['username'] = $_REQUEST['username'];
		
		header('Location: http://localhost:8013/index.php'); //redirect
	}
	else {
		header('Location: http://localhost:8013/login.php');
	}

?>
