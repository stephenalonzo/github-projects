<?php 

require_once ('../controller.php');

function authUser() {

    if (!isset($_SESSION['id']) || !isset($_SESSION['user'])) {

        header ("Location: login.php");
    
    } else {
    
        
    }

}

authUser();

?>