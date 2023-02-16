<?php 

require_once ('app/AppController.php');

if (!isset($_SESSION['emp_number'])) {

    header("Location: login.php");

} else {


}

?>