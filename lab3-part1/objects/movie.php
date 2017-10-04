<?php

class movie {

  var $id;
  var $title;
  var $description;
  var $posterUrl;

  function __construct($i, $n, $d, $url)
  {
    $this->id = $i;
    $this->title = $n;
    $this->description = $d;
    $this->posterUrl = $url;
  }



}


?>
