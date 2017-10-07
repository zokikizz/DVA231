<?php
ini_set('session.cookie_lifetime', 60 * 60 * 24 * 365);
ini_set('session.gc-maxlifetime', 60 * 60 * 24 * 365);
  session_start();
  session_destroy();

  header('Location: http://localhost:8013/index.php');


 ?>
