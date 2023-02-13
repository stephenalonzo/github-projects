<?php 

require_once ('./controller.php');

$params		= filterParams($params);
$results 	= getStaffTimesheet($params);

$params['open_file']	= fopen('php://memory', 'w');

$params['csv_headers'] 	= array('Date', 'Time In', 'Lunch Out', 'Lunch In', 'Time Out');
fputcsv($params['open_file'], $params['csv_headers'], ",");

foreach ($results as $row) {

    $params['insert_data']	= array(
        date('Y-m-d', strtotime($row['emp_punch_date'])),
        date('Y-m-d', strtotime($row['emp_time_in'])),
        date('Y-m-d', strtotime($row['emp_lunch_out'])),
        date('Y-m-d', strtotime($row['emp_lunch_in'])),
        date('Y-m-d', strtotime($row['emp_time_out']))
    );

    fputcsv($params['open_file'], $params['insert_data'], ",");

}

fseek($params['open_file'], 0);

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="'.$params['file_name'].'";');

fpassthru($params['open_file']);

exit;

?>