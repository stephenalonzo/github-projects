<?php 

require_once ('AppController.php');

function userLogin($params)
{

    $params     = filterParams($params);
    $params     = getPayPeriod($params);
    $results    = getEmployeeData($params);

    foreach ($results as $row)
    {

        if ($row['emp_status'] == 'IN')
        {

            $params['dba']['s']     = "SELECT * FROM employees WHERE emp_number = :emp_number";
            $params['bind_params']  = array(':emp_number' => $params['emp_number']);
            
            $stmt   = dbAccess($params);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result['emp_number'] == $params['emp_number']) {
        
                // Declare session variables and assign to retrieve employee info
                $_SESSION['emp_number']     = $params['emp_number'];
                $_SESSION['emp_name']       = $result['emp_name'];
                $_SESSION['emp_position']	= $result['emp_position'];
                $_SESSION['emp_manager']    = $result['emp_manager'];
                $_SESSION['punch_token'] 	= $row['punch_token'];
        
                header("Location: index.php");
        
            } else {
        
                header("Location: login.php");
        
            }


        } elseif ($row['emp_status'] == 'LUNCH') {

            $params['dba']['s']     = "SELECT * FROM employees WHERE emp_number = :emp_number";
            $params['bind_params']  = array(':emp_number' => $params['emp_number']);
            
            $stmt   = dbAccess($params);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result['emp_number'] == $params['emp_number']) {
        
                $_SESSION['emp_number']     = $params['emp_number'];
                $_SESSION['emp_name']       = $result['emp_name'];
                $_SESSION['emp_position']	= $result['emp_position'];
                $_SESSION['emp_manager']    = $result['emp_manager'];
                $_SESSION['punch_token'] 	= $row['punch_token'];
        
                header("Location: index.php");
        
            } else {
        
                header("Location: login.php");
        
            }

        } else {

            $params['dba']['s']     = "SELECT * FROM employees WHERE emp_number = :emp_number";
            $params['bind_params']  = array(':emp_number' => $params['emp_number']);
            
            $stmt                   = dbAccess($params);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result['emp_number'] == $params['emp_number']) {
        
                $_SESSION['emp_number']     = $params['emp_number'];
                $_SESSION['emp_name']       = $result['emp_name'];
                $_SESSION['emp_position']	= $result['emp_position'];
                $_SESSION['emp_manager']    = $result['emp_manager'];
                $_SESSION['punch_token'] 	= bin2hex(random_bytes(8));
                
                $params['dba']['i']     = "UPDATE employees SET punch_token = :punch_token WHERE emp_number = :emp_number";
                $params['bind_params']  = array(
                    ':punch_token'  => $_SESSION['punch_token'],
                    ':emp_number'   => $_SESSION['emp_number']
                );

                dbAccess($params);

                header("Location: index.php");
        
            } else {
        
                header("Location: login.php");
        
            }

        }

    }

    return $params;

}

function userLogout() {

	session_start();
    session_destroy();

	header("Location: login.php");

}

?>