<?php

require_once('./calendar-form.php');

// if a session user is not the specified user or was not able to fetch user id, do the following
if(!isset($_SESSION['id']) || !isset($_SESSION['user']))
{

    header("Location: login.php");

} else {

}

?>