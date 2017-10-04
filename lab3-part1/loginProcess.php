<?php

include 'objects/users.php';

ini_set('session.cookie_lifetime', 60 * 60 * 24 * 365);
ini_set('session.gc-maxlifetime', 60 * 60 * 24 * 365);
session_start();



if($_REQUEST != NULL )
{

		$conn = mysqli_connect('localhost','root','');

		if (mysqli_connect_errno())
		{
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
		}


		mysqli_select_db($conn, 'dva231');

		$result = mysqli_query($conn, "SELECT * FROM users
			WHERE username='" . $_REQUEST["username"] .
			"' AND password='" . $_REQUEST["password"] . "';" );
	$row = $result->fetch_row();
	if($row != NULL)
 	{
		$_SESSION['user'] = new user($row[1], $row[0]);

		$res = mysqli_query($conn, "SELECT movie_id FROM favorite_movies
			WHERE user_id=" . $_SESSION['user']->id .
			";" );

			$_SESSION['favoriteMovies'] = array();

			while( $row = mysqli_fetch_array($res))
			{
				array_push($_SESSION['favoriteMovies'], $row[0]);
			}

			$conn->close();
		header('Location: http://localhost/lab/index.php'); //redirect
	}
	else
	{
		header('Location: http://localhost/lab/login.php');
	}

}
else
{
	header('Location: http://localhost/lab/login.php');
}



?>
