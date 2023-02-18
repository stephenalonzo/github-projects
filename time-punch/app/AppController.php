<?php 

error_reporting (E_ALL ^ E_NOTICE);
error_reporting (E_ERROR | E_PARSE);
date_default_timezone_set ('Pacific/Saipan');

// ==========================================

require_once ('DbAccess.php');
require_once ('UserLogin.php');
require_once ('PunchProcess.php');
require_once ('RetrievePayPeriod.php');
require_once ('EmployeeData.php');
require_once ('PunchData.php');
require_once ('LeaveProcess.php');

// ==========================================

foreach ($_REQUEST as $key => $value) {

    switch ($key) {

        case 'emp_login':
            userLogin($params);
        break;

        case 'emp_logout':
            userLogout($params);
        break;

        case 'punch_time_in':
            // Uncomment to active debugger
            // $params = punchProcess($params);
            punchProcess($params);
        break;

        case 'punch_lunch_out':
            // Uncomment to active debugger
            // $params = punchProcess($params);
            punchProcess($params);
        break;

        case 'punch_lunch_in':
            // Uncomment to active debugger
            // $params = punchProcess($params);
            punchProcess($params);
        break;

        case 'punch_time_out':
            // Uncomment to active debugger
            // $params = punchProcess($params);
            punchProcess($params);
        break;

        case 'apply_for_leave':
            // Uncomment to activate debugger
            // $params = leaveProcess($params);
            leaveProcess($params);
        break;

    }

}

// ==========================================

print_r($params['debug']);

?>