<?php

require_once('./app-functions.php');

if(!isset($_SESSION['id']))
{

    header("Location: login.php");

} else {

    // do nothing

}

?>
