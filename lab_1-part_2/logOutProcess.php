<?php
  session_start();

  if($_REQUEST['logOut'] != NULL)
    $_SESSION['username'] = NULL;

  header("Location: http://lab/index.php");


 ?>
