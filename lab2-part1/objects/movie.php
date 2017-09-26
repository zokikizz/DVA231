<?php

class movie {

  var $name;
  var $description;
  var $posterUrl;

  function __construct($n, $d, $url)
  {
    $this->name = $n;
    $this->description = $d;
    $this->posterUrl = $url;
  }



}


?>
