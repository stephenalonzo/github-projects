<?php 

require_once ('AppController.php');

function getPayPeriod($params)
{

    // Select the equivalent pay period if it the start date and the end date is in current week
    $params['dba']['s'] = "SELECT * FROM pay_periods WHERE CURDATE() >= pp_start_date AND CURDATE() <= pp_end_date";
    $stmt = dbAccess($params);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;

}

?>