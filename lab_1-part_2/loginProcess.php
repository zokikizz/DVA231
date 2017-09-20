<?php

session_start();

if($_REQUEST != NULL )
	if($_REQUEST["username"]=="zoki" && $_REQUEST["password"]=="kizz")
	{
		$_SESSION['username'] = $_REQUEST['username'];
		header('Location: http://lab/index.php'); //redirect
	}
	else {
		header('Location: http://lab/login.php');
	}

?>
