<?php

// [environment] ----------------------------------------------

error_reporting (E_ALL ^ E_NOTICE);
error_reporting (E_ERROR | E_PARSE);
date_default_timezone_set ('Pacific/Saipan');

// [includes] -------------------------------------------------

require_once ('admin/app-functions.php');

// [main] -----------------------------------------------------

foreach ($_REQUEST as $key => $value) {

    switch ($key) {

        case 'login':
            loginSuccessful($params);
        break;

        case 'submit':
            $params = insertReport($params);
        break;

        case 'edit':
            $params = editReport($params);
        break;

        case 'delete':
            $params = deleteReport($params);
        break;

        case 'deleteAll':
            $params = deleteAll($params);
        break;

        case 'deleteSelected':
            $params = deleteSelected($params);
        break;

        default:
        break;

    }

}

// [debug] -------------------------------------------------

// echo '<pre>';
// print_r($params['debug']);
// echo '</pre>';

?>