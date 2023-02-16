<?php

require_once('app/AppHeader.php');
require_once('app/AppAuthentication.php');
require_once('app/AppController.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Punch</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./dist/output.css">
</head>

<body>
    <section class="px-4 py-6">
        <div class="container mx-auto flex flex-row items-center justify-center">
            <form action="" method="post">
                <div class="p-4 flex flex-row justify-between items-center w-[500px] bg-gray-200/20">
                    <div class="flex flex-col items-start space-y-6">
                        <div class="flex flex-col items-start">
                            <div class="flex flex-row items-center space-x-2">
                                <h1 class="font-semibold text-xl text-start"><?php echo $_SESSION['emp_name']; ?></h1>
                                <?php 
                            
                                $results = getSessionPunch($params);

                                foreach ($results as $row) {

                                    if ($row['emp_status'] == 'IN') {

                                ?>
                                <span class="px-3 py-1 bg-green-200 text-green-400 text-xs rounded-sm">IN</span>
                                <?php } elseif ($row['emp_status'] == 'LUNCH') { ?>
                                <span class="px-3 py-1 bg-blue-200 text-blue-400 text-xs rounded-sm">LUNCH</span>
                                <?php } else { ?>
                                <span class="px-3 py-1 bg-red-200 text-red-400 text-xs rounded-sm">OUT</span>
                                <?php } ?>
                                <?php } ?>
                            </div>
                            <p class="text-sm"><?php echo $_SESSION['emp_position']; ?></p>
                        </div>
                        <p class="text-sm">
                            <span class="font-semibold">Pay Period:</span>
                            <?php 
                            
                            $results = getPayPeriod($params);

                            foreach ($results as $row) {

                                echo date('m/d', strtotime($row['pp_start_date']))." - ".date('m/d/Y', strtotime($row['pp_end_date']));

                            }
                            
                            ?>
                        </p>
                    </div>
                    <div class="flex flex-col items-center text-center space-y-4">
                        <?php 
                        
                        $results = getSessionPunch($params);
                        
                        foreach ($results as $row) { 
                            
                            if (isset($_POST['punch_time_in'])) {
                            
                        ?>
                        <button type="submit" name="punch_time_out" class="px-4 py-2 font-semibold bg-red-600 text-white w-48 rounded-sm">Time Out</button>
                        <button type="submit" name="punch_lunch_out" class="px-4 py-2 font-semibold bg-gray-600 text-white w-48 rounded-sm">Lunch Out</button>
                        <a href="./apply-for-leave.php" class="px-4 py-2 font-semibold bg-orange-600 text-white w-48 rounded-sm">Apply for Leave</a>
                        <?php }  elseif (isset($_POST['punch_lunch_out'])) { ?>
                        <button type="submit" name="punch_time_out" class="px-4 py-2 font-semibold bg-red-600 text-white w-48 rounded-sm">Time Out</button>
                        <button type="submit" name="punch_lunch_in" class="px-4 py-2 font-semibold bg-blue-600 text-white w-48 rounded-sm">Lunch In</button>
                        <a href="./apply-for-leave.php" class="px-4 py-2 font-semibold bg-orange-600 text-white w-48 rounded-sm">Apply for Leave</a>
                        <?php } elseif ($row['emp_status'] == 'LUNCH') { ?>
                        <button type="submit" name="punch_time_out" class="px-4 py-2 font-semibold bg-red-600 text-white w-48 rounded-sm">Time Out</button>
                        <button type="submit" name="punch_lunch_in" class="px-4 py-2 font-semibold bg-blue-600 text-white w-48 rounded-sm">Lunch In</button>
                        <a href="./apply-for-leave.php" class="px-4 py-2 font-semibold bg-orange-600 text-white w-48 rounded-sm">Apply for Leave</a>
                        <?php } elseif ($row['emp_status'] == 'IN' && isset($_POST['punch_lunch_in'])) { ?>
                        <button type="submit" name="punch_time_out" class="px-4 py-2 font-semibold bg-red-600 text-white w-48 rounded-sm">Time Out</button>
                        <button type="submit" name="punch_lunch_out" class="px-4 py-2 font-semibold bg-gray-600/20 text-white w-48 rounded-sm" disabled>Lunch Out</button>
                        <a href="./apply-for-leave.php" class="px-4 py-2 font-semibold bg-orange-600 text-white w-48 rounded-sm">Apply for Leave</a>
                        <?php } elseif ($row['emp_status'] == 'IN') { ?>
                        <button type="submit" name="punch_time_out" class="px-4 py-2 font-semibold bg-red-600 text-white w-48 rounded-sm">Time Out</button>
                        <button type="submit" name="punch_lunch_out" class="px-4 py-2 font-semibold bg-gray-600 text-white w-48 rounded-sm">Lunch Out</button>
                        <a href="./apply-for-leave.php" class="px-4 py-2 font-semibold bg-orange-600 text-white w-48 rounded-sm">Apply for Leave</a>
                        <?php } else { ?>
                        <button type="submit" name="punch_time_in" class="px-4 py-2 font-semibold bg-green-600 text-white w-48 rounded-sm">Time In</button>
                        <button type="submit" name="punch_lunch_out" class="px-4 py-2 font-semibold bg-gray-600/20 text-white w-48 rounded-sm" disabled>Lunch Out</button>
                        <a href="./apply-for-leave.php" class="px-4 py-2 font-semibold bg-orange-600 text-white w-48 rounded-sm">Apply for Leave</a>
                        <?php 
                        
                            }

                        } 
                        
                        ?>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>

</html>