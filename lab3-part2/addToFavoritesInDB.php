<?php

include 'objects/users.php';

session_start();

if(isset($_POST['id']))
  {

    $conn = mysqli_connect('localhost','root','');

    if(mysqli_connect_errno())
      exit();

    mysqli_select_db($conn,'dva231');

    $result = mysqli_query($conn,
    "INSERT INTO favorite_movies (user_id, movie_id) VALUES("
    . $_SESSION['user']->id . "," . $_POST['id'] . ");");

    $res = mysqli_query($conn, "SELECT movie_id FROM favorite_movies
			WHERE user_id=" . $_SESSION['user']->id .
			";" );

			unset($_SESSION['favoriteMovies']);
      $_SESSION['favoriteMovies'] = array();

			while( $row = mysqli_fetch_array($res))
			{
				array_push($_SESSION['favoriteMovies'], $row[0]);
			}


    $conn->close();

    //header('Content-Type: application/json');
    echo json_encode($_REQUEST);

  }
 ?>
