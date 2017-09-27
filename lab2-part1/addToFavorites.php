<!DOCTYPE html>
<html>

<?php
  session_start();

  if(!isset($_SESSION['username']))
  {
    header('Location: http://localhost:8013/index.php');
  }

  ?>
  <head>
    <meta charset="utf-8">
    <title><?php echo $_GET['movieName'] ?> is add to favorites</title>
    <link rel="stylesheet" href="2.css">
    <link rel="stylesheet" href="addToFavorites.css">
  </head>
  <body>
    <form>

      <h2>Movie<?php echo $_GET['movieName'] ?> is add to favorites!</h2>
      <a href="index.php" class="facebookSingIn">
        <span class="facebookSingInText">
          Back
        </span>
      </a>

    </form>

  </body>
</html>
