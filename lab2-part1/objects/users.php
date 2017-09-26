<?php
class user {

    var $username;
    var $password;

    function __construct($u, $p)
    {
      $this->username = $u;
      $this->password = $p;
    }
}
?>
