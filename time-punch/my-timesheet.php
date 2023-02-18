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
    <title>My Time Sheet | Time Punch</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./dist/output.css">
</head>

<body>
    <section class="px-4 py-6">
        <div class="container mx-auto w-3/4 space-y-6">
        <div class="flex flex-row items-center justify-between">
                <div class="flex flex-col items-start space-y-4">
                    <div class="flex flex-col items-start">
                        <p class="font-semibold text-xl"><?php echo $_SESSION['emp_name']; ?></p>
                        <p class="text-sm"><?php echo $_SESSION['emp_position']; ?></p>
                    </div>
                    <p class="text-sm">
                        <span class="font-semibold">Pay Period:</span>
                        <?php 
                        
                        $params = getPayPeriod($params);

                        foreach ($params['pay_period'] as $row)
                        {

                            echo date('m/d', strtotime($row['pp_start_date']))." - ".date('m/d/Y', strtotime($row['pp_end_date']));

                        }
                        
                        ?>
                    </p>
                </div>
                <div class="flex flex-col items-start space-y-2">
                    <p class="text-sm w-full flex justify-end items-center">
                        <span class="font-semibold">Manager:</span>
                        &nbsp;
                        <?php echo $_SESSION['emp_manager']; ?>
                    </p>
                    <p>
                        <span class="font-semibold text-sm">Approval Status:</span>
                        <span class="px-2 py-1 bg-green-200 text-green-500 rounded-sm uppercase text-xs">Approved</span>
                        <span class="px-2 py-1 bg-red-200 text-red-400 rounded-sm uppercase text-xs">Pending</span>
                    </p>
                </div>
            </div>
            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full divide-y-2 divide-gray-200 text-sm">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap px-4 py-2 text-left font-medium text-gray-900">
                                Date
                            </th>
                            <th class="whitespace-nowrap px-4 py-2 text-left font-medium text-gray-900">
                                Time In
                            </th>
                            <th class="whitespace-nowrap px-4 py-2 text-left font-medium text-gray-900">
                                Lunch Out
                            </th>
                            <th class="whitespace-nowrap px-4 py-2 text-left font-medium text-gray-900">
                                Lunch In
                            </th>
                            <th class="whitespace-nowrap px-4 py-2 text-left font-medium text-gray-900">
                                Time Out
                            </th>
                            <th class="whitespace-nowrap px-4 py-2 text-left font-medium text-gray-900">
                                Remarks
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        <?php 
                        
                        $results = getTotalPunches($params);

                        foreach ($results as $row)
                        {
                        
                        ?>
                        <tr>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                <?php echo date('m/d/Y', strtotime($row['punch_date'])); ?>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                <?php echo date('H:i A', strtotime($row['punch_time_in'])); ?>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                <?php 
                                
                                if (!empty($row['punch_lunch_out']))
                                {

                                    echo date('H:i A', strtotime($row['punch_lunch_out']));

                                }

                                ?>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                <?php 
                                
                                if (!empty($row['punch_lunch_in']))
                                {

                                    echo date('H:i A', strtotime($row['punch_lunch_in']));

                                }
                                
                                ?>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                <?php echo date('H:i A', strtotime($row['punch_time_out'])); ?>
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                <?php 
                                
                                switch ($row['punch_type'])
                                {

                                    case 'AL':
                                        echo 'Admin Leave';
                                    break;

                                    case 'SL':
                                        echo 'Sick Leave';
                                    break;

                                    case 'VL':
                                        echo 'Vacation Leave';
                                    break;

                                }
                                
                                ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </section>
</body>

</html>