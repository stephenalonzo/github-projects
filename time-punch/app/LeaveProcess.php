<?php 

require_once ('AppController.php');

function leaveProcess($params)
{

    $params = filterParams($params);

    // Declare debugger
    $params['debug'] = array(
        'Leave Type'    => $params['leave_type'],
        'Leave Start'   => $params['leave_start'],
        'Leave End'   => $params['leave_end']
    );

    return $params;

}

?>