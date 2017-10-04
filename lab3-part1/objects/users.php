<?php
class user {

    var $id;
    var $username;
    function __construct($u, $i)
    {
      $this->username = $u;
      $this->id = $i;
    }
}
?>
