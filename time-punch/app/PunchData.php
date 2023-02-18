<?php 

require_once ('AppController.php');

function getTotalPunches($params)
{

    $params['dba']['s']     = "SELECT * FROM employee_punches WHERE emp_number = :emp_number";
    $params['bind_params']  = array(':emp_number' => $_SESSION['emp_number']);

    $stmt       = dbAccess($params);
    $results    = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;

}

?>