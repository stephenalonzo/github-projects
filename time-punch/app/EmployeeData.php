<?php 

require_once ('AppController.php');

function getEmployeeData($params)
{

    $params = filterParams($params);

    if (isset($_SESSION['emp_number']))
    {

        $params['dba']['s']     = "SELECT * FROM employees WHERE emp_number = :emp_number";
        $params['bind_params']  = array(':emp_number' => $_SESSION['emp_number']);
    
        $stmt       = dbAccess($params);
        $results    = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $results;

    } else {

        $params = filterParams($params);

        $params['dba']['s']     = "SELECT * FROM employees WHERE emp_number = :emp_number";
        $params['bind_params']  = array(':emp_number' => $params['emp_number']);
    
        $stmt       = dbAccess($params);
        $results    = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $results;

    }

    return $params;

}

?>