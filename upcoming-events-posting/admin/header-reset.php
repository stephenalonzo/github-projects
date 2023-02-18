<?php

error_reporting (E_ALL ^ E_NOTICE);
error_reporting (E_ERROR | E_PARSE);

date_default_timezone_set('Pacific/Saipan');

include_once('./session.php');

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand">OPD CMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<br>