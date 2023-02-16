<?php 

require_once ('AppController.php');

function punchProcess($params)
{
    
    // Debugger
    // $params['debug'] = array(
    //     'Employee'          => $_SESSION['emp_name'],
    //     'Employee Number'   => $_SESSION['emp_number'],
    //     'Punch Date'        => date('Y-m-d')
    // );

    foreach ($_REQUEST as $key => $value)
    {

        switch ($key)
        {

            case 'punch_time_in':

                $results = getSessionPunch($params);

                foreach ($results as $row)
                {

                    if (empty($row['punch_token']) && empty($_SESSION['punch_token']))
                    {

                        $_SESSION['punch_token'] = bin2hex(random_bytes(8));

                        $params['dba']['i']     = "INSERT INTO employee_punches (emp_name, emp_number, punch_date, punch_time_in, punch_token) VALUES (:emp_name, :emp_number, :punch_date, :punch_time_in, :punch_token)";
                        $params['bind_params']  = array(
                            ':emp_name'         => $_SESSION['emp_name'],
                            ':emp_number'       => $_SESSION['emp_number'],
                            ':punch_date'       => date('Y-m-d'),
                            ':punch_time_in'    => date('H:i:s'),
                            ':punch_token'      => $_SESSION['punch_token']
                        );
                    
                        dbAccess($params);
                    
                        if ($params['dba']['i']) {
                    
                            $params['dba']['u']     = "UPDATE employees SET emp_status = 'IN', punch_token = :punch_token WHERE emp_number = :emp_number";
                            $params['bind_params']  = array(
                                ':emp_number'   => $_SESSION['emp_number'],
                                ':punch_token'  => $_SESSION['punch_token']
                            );
                    
                            dbAccess($params);
                    
                        }

                    } elseif (empty($row['punch_token']) && !empty($_SESSION['punch_token'])) {

                        $_SESSION['punch_token'] = bin2hex(random_bytes(8));

                        $params['dba']['i']     = "INSERT INTO employee_punches (emp_name, emp_number, punch_date, punch_time_in, punch_token) VALUES (:emp_name, :emp_number, :punch_date, :punch_time_in, :punch_token)";
                        $params['bind_params']  = array(
                            ':emp_name'         => $_SESSION['emp_name'],
                            ':emp_number'       => $_SESSION['emp_number'],
                            ':punch_date'       => date('Y-m-d'),
                            ':punch_time_in'    => date('H:i:s'),
                            ':punch_token'      => $_SESSION['punch_token']
                        );
                    
                        dbAccess($params);
                    
                        if ($params['dba']['i']) {
                    
                            $params['dba']['u']     = "UPDATE employees SET emp_status = 'IN', punch_token = :punch_token WHERE emp_number = :emp_number";
                            $params['bind_params']  = array(
                                ':emp_number'   => $_SESSION['emp_number'],
                                ':punch_token'  => $_SESSION['punch_token']
                            );
                    
                            dbAccess($params);
                    
                        }

                    } else {

                        $params['dba']['i']     = "INSERT INTO employee_punches (emp_name, emp_number, punch_date, punch_time_in, punch_token) VALUES (:emp_name, :emp_number, :punch_date, :punch_time_in, :punch_token)";
                        $params['bind_params']  = array(
                            ':emp_name'         => $_SESSION['emp_name'],
                            ':emp_number'       => $_SESSION['emp_number'],
                            ':punch_date'       => date('Y-m-d'),
                            ':punch_time_in'    => date('H:i:s'),
                            ':punch_token'      => $row['punch_token']
                        );
                    
                        dbAccess($params);
                    
                        if ($params['dba']['i']) {
                    
                            $params['dba']['u']     = "UPDATE employees SET emp_status = 'IN' WHERE emp_number = :emp_number";
                            $params['bind_params']  = array(':emp_number' => $_SESSION['emp_number']);
                    
                            dbAccess($params);
                    
                        }

                    }

                }
            break;

            case 'punch_lunch_out':
                $params['dba']['u']     = "UPDATE employee_punches SET punch_lunch_out = :punch_lunch_out WHERE punch_token = :punch_token";
                $params['bind_params']  = array(
                    ':punch_lunch_out'    => date('H:i:s'),
                    ':punch_token'      => $_SESSION['punch_token']
                );
            
                dbAccess($params);
            
                if ($params['dba']['u']) {
            
                    $params['dba']['u']     = "UPDATE employees SET emp_status = 'LUNCH' WHERE emp_number = :emp_number";
                    $params['bind_params']  = array(':emp_number' => $_SESSION['emp_number']);
            
                    dbAccess($params);
            
                }
            break;

            case 'punch_lunch_in':

                $results = getSessionPunch($params);
                
                foreach ($results as $row)
                {

                    if (empty($row['punch_token']))
                    {

                        $params['dba']['u']     = "UPDATE employee_punches SET punch_lunch_in = :punch_lunch_in WHERE punch_token = :punch_token";
                        $params['bind_params']  = array(
                            ':punch_lunch_in'    => date('H:i:s'),
                            ':punch_token'      => $_SESSION['punch_token']
                        );
                    
                        dbAccess($params);
                    
                        if ($params['dba']['u']) {
                    
                            $params['dba']['u']     = "UPDATE employees SET emp_status = 'IN' WHERE emp_number = :emp_number";
                            $params['bind_params']  = array(':emp_number' => $_SESSION['emp_number']);
                    
                            dbAccess($params);
                    
                        }

                    } else {

                        $params['dba']['u']     = "UPDATE employee_punches SET punch_lunch_in = :punch_lunch_in WHERE punch_token = :punch_token";
                        $params['bind_params']  = array(
                            ':punch_lunch_in'    => date('H:i:s'),
                            ':punch_token'      => $row['punch_token']
                        );
                    
                        dbAccess($params);
                    
                        if ($params['dba']['u']) {
                    
                            $params['dba']['u']     = "UPDATE employees SET emp_status = 'IN' WHERE emp_number = :emp_number";
                            $params['bind_params']  = array(':emp_number' => $_SESSION['emp_number']);
                    
                            dbAccess($params);
                    
                        }
                        
                    }

                }
            break;

            case 'punch_time_out':
                $params['dba']['u']     = "UPDATE employee_punches SET punch_time_out = :punch_time_out WHERE punch_token = :punch_token";
                $params['bind_params']  = array(
                    ':punch_time_out'    => date('H:i:s'),
                    ':punch_token'      => $_SESSION['punch_token']
                );
            
                dbAccess($params);
            
                if ($params['dba']['u']) {

                    $_SESSION['punch_token'] = '';
            
                    $params['dba']['u']     = "UPDATE employees SET emp_status = 'OUT', punch_token = :punch_token WHERE emp_number = :emp_number";
                    $params['bind_params']  = array(
                        ':emp_number'   => $_SESSION['emp_number'],
                        ':punch_token'  => $_SESSION['punch_token']
                    );
            
                    dbAccess($params);
            
                }
            break;

        }

    }

    return $params;

}

?>