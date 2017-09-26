<!DOCTYPE html>
<html>

<?php
  session_start();

  if(!isset($_SESSION['username']))
  {
    header('Location: http://localhost/lab/index.php');
  }

  ?>
  <head>
    <meta charset="utf-8">
    <title><?php echo $_GET['movieName'] ?> is add to favorites</title>
    <link rel="stylesheet" href="2.css">
  </head>
  <body>
    <h2><?php echo $_GET['movieName'] ?> is add to favorites!</h2>
    <a href="index.php" class="facebookSingIn">
      <span class="facebookSingInText">
        Sing in with Facebook
      </span>
    </a>
  </body>
</html>
