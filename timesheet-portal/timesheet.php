<?php

require_once('./controller.php');
require_once('./header.php');
require_once('./authentication.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Punch Portal</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/jquery-3.6.3.min.js"></script>
</head>

<body>
    <main>
        <section class="p-3 container mx-auto">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" style="width: 128px;">Date</th>
                        <th scope="col" style="width: 128px;">Time In</th>
                        <th scope="col" style="width: 128px;">Lunch Out</th>
                        <th scope="col" style="width: 128px;">Lunch In</th>
                        <th scope="col" style="width: 128px;">Time Out</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $results = singleEmployeeTimesheet($params);

                    foreach ($results as $row) {

                    ?>
                        <tr>
                            <td><?php echo date('m/d/Y', strtotime($row['emp_punch_date'])); ?></td>
                            <td><?php echo date('h:i A', strtotime($row['emp_time_in'])); ?></td>
                            <td><?php echo date('h:i A', strtotime($row['emp_lunch_out'])); ?></td>
                            <td><?php echo date('h:i A', strtotime($row['emp_lunch_in'])); ?></td>
                            <td><?php echo date('h:i A', strtotime($row['emp_time_out'])); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
        <section class="p-3 container mx-auto">
            <div class="d-flex justify-content-center align-items-start w-100">
                <div class="card me-5" style="width: 18rem;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><b>Regular Hours</b></span>
                            <span>
                                <?php 

                                $results = singleEmployeeTimesheet($params);

                                $hours = 0;

                                foreach ( $results as $row ) {
                                    
                                    if ($row['punch_type'] == 'AL' || $row['punch_type'] == 'SL' || $row['punch_type'] == 'VL') {


                                    } else {

                                        $start = strtotime($row['emp_time_in']);
                                        $hours += ( strtotime($row['emp_time_out']) - $start ) / 3600;
                                        
                                    }

                                }

                                if ($hours > '80.00') {

                                    $overtime = $hours - $hours + 80;

                                    echo round($overtime, 2);

                                } else {

                                    echo round($hours, 2);

                                }

                                ?>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><b>Overtime</b></span>
                            <span>
                                <?php 

                                $results = singleEmployeeTimesheet($params);

                                $hours = 0;

                                foreach ( $results as $row ) {

                                    if ($row['punch_type'] == 'AL' || $row['punch_type'] == 'SL' || $row['punch_type'] == 'VL') {


                                    } else {

                                        $start = strtotime($row['emp_time_in']);
                                        $hours += ( strtotime($row['emp_time_out']) - $start ) / 3600;
                                        
                                    }

                                }

                                if ($hours > '80.00') {

                                    $overtime = $hours - 80;

                                    echo round($overtime, 2);

                                } else {

                                    echo '0.00';

                                }

                                ?>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><b>Sick Leave</b></span>
                            <span>
                                <?php 

                                $results = singleEmployeeTimesheet($params);

                                $hours = 0;

                                foreach ( $results as $row ) {

                                    if ($row['punch_type'] == 'SL') {

                                        $start = strtotime($row['emp_time_in']);
                                        $hours += ( strtotime($row['emp_time_out']) - $start ) / 3600;

                                    } 

                                }

                                echo round($hours, 2);

                                ?>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><b>Annual/Vacation Leave</b></span>
                            <span>
                                <?php 

                                $results = singleEmployeeTimesheet($params);

                                $hours = 0;

                                foreach ( $results as $row ) {

                                    if ($row['punch_type'] == 'AL' || $row['punch_type'] == 'VL') {

                                        $start = strtotime($row['emp_time_in']);
                                        $hours += ( strtotime($row['emp_time_out']) - $start ) / 3600;

                                    } 

                                }

                                echo round($hours, 2);

                                ?>
                            </span>
                        </li>
                    </ul>
                </div>
                <div class="card w-50">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span><b>Employee Name:</b></span>
                            <p class="m-0"><?php echo $_SESSION['emp_name']; ?></p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span><b>Manager Name:</b></span>
                            <p class="m-0"><?php echo $_SESSION['emp_name']; ?></p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span><b>Pay-period:</b></span>
                            <p class="m-0">
                                <?php
                                
                                $results = getPayPeriod($params);

                                foreach ($results as $row) {

                                    if (date('Y-m-d') >= date('Y-m-d', strtotime($row['pp_start'])) && date('Y-m-d') <= date('Y-m-d', strtotime($row['pp_end']))) {

                                        echo date('m/d/Y', strtotime($row['pp_start'])).' - '.date('m/d/Y', strtotime($row['pp_end']));

                                    }

                                }
                                
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>
</body>

</html>