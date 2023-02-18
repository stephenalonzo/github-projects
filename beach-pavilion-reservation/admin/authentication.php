<?php 

require_once ('../controller.php');

function authUser() {

    if (!isset($_SESSION['id']) || !isset($_SESSION['user']) || ($_SESSION['user']) != 'dlnr-admin') {

        header ("Location: login.php");
    
    } else {
    
        
    }

}

authUser();

?>