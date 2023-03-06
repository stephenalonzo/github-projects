<?php

// [environment] ----------------------------------------------

error_reporting (E_ALL ^ E_NOTICE);
error_reporting (E_ERROR | E_PARSE);
date_default_timezone_set ('Pacific/Saipan');

// [includes] -------------------------------------------------

require_once ('php/PHPMailer/src/Exception.php');
require_once ('php/PHPMailer/src/PHPMailer.php');
require_once ('php/PHPMailer/src/SMTP.php');
require_once ('php/app.php');

// [main] -----------------------------------------------------

foreach ($_REQUEST as $key => $value) {

    switch ($key) {

        case 'userLogin':
            login($params);
            break;

        case 'userLogout':
            logOut();
            break;

        case 'confirmReservation':
            confirmReservation($params);
            break;

        case 'presentationSignUp':
            $params = presentationSignUp($params);
            break;

        case 'sendMessage':
            $params = contactUs($params);
            break;

        case 'reserveFacility':
            $params = reserveFacility($params);
            break;

        case 'calendarReserve':
            $params = calendarReserveFacility($params);
            break;

        case 'manualReservation':
            manualReservation($params);
            break;

    }

}

// [debug] -------------------------------------------------

echo '<pre>';
print_r($params['debug']);
echo '</pre>';

?>