<?php

// [environment] ----------------------------------------------

error_reporting (E_ALL ^ E_NOTICE);
error_reporting (E_ERROR | E_PARSE);
date_default_timezone_set ('Pacific/Saipan');

// [includes] -------------------------------------------------

require_once ('./app.php');

// [main] -----------------------------------------------------

foreach ($_REQUEST as $key => $value) {

    switch ($key) {

        case 'empLogin':
            employeeLogin($params);
        break;

        case 'empLogout':
            employeeLogout();
        break;
            
        case 'timeIn':
            punchProcess($params);
        break;

        case 'lunchOut':
            punchProcess($params);
        break;

        case 'lunchIn':
            punchProcess($params);
        break;

        case 'timeOut':
            punchProcess($params);
        break;

        case 'submitLeave':
            punchProcess($params);
        break;

    }

}

// [debug] -------------------------------------------------

// echo '<pre>';
// print_r($params['debug']);
// echo '</pre>';

?>