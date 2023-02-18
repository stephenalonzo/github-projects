<?php 

require_once ('AppController.php');

function leaveProcess($params)
{

    $params = filterParams($params);

    if (date('Y-m-d', strtotime($params['leave_start'])) < date('Y-m-d') && date('Y-m-d', strtotime($params['leave_end'])) < date('Y-m-d'))
    {

        // no execution

    } else {

        switch ($params['leave_type'])
        {
    
            case 1:
                $params['leave_type'] = 'AL';
            break;
    
            case 2:
                $params['leave_type'] = 'SL';
            break;
    
            case 3:
                $params['leave_type'] = 'VL';
            break;
    
        }
    
        $params['dba']['i']     = "INSERT INTO leave_applications (emp_name, emp_number, leave_type, leave_start, leave_end) VALUES (:emp_name, :emp_number, :leave_type, :leave_start, :leave_end)";
        $params['bind_params']  = array(
            ':emp_name'     => $_SESSION['emp_name'],
            ':emp_number'   => $_SESSION['emp_number'], 
            ':leave_type'   => $params['leave_type'],
            ':leave_start'  => $params['leave_start'], 
            ':leave_end'    => $params['leave_end']
        );
    
        dbAccess($params);
    
        if ($params['dba']['i'])
        {
    
            $params['dba']['i']     = "INSERT INTO employee_punches (emp_name, emp_number, punch_date, punch_time_in, punch_time_out, punch_type) VALUES (:emp_name, :emp_number, :punch_date, :punch_time_in, :punch_time_out, :punch_type)";
            $params['bind_params']  = array(
                ':emp_name'         => $_SESSION['emp_name'],
                ':emp_number'       => $_SESSION['emp_number'],
                ':punch_date'       => date('Y-m-d', strtotime($params['leave_start'])),
                ':punch_time_in'    => date('H:i:s', strtotime($params['leave_start'])),
                ':punch_time_out'    => date('H:i:s', strtotime($params['leave_end'])),
                ':punch_type'       => $params['leave_type'],
            );
        
            dbAccess($params);
    
        }
    
        // Declare debugger
        // $params['debug'] = array(
        //     ':emp_name'     => $_SESSION['emp_name'],
        //     ':emp_number'   => $_SESSION['emp_number'],
        //     'Leave Type'    => $params['leave_type'],
        //     'Leave Start'   => $params['leave_start'],
        //     'Leave End'   => $params['leave_end']
        // );
    

    }

    return $params;

}

?>