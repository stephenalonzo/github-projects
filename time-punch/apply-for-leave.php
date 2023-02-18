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
    <title>Apply for Leave | Time Punch</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./dist/output.css">
    <script src="./js/jquery-3.6.3.min.js"></script>
</head>

<body>
    <section class="px-4 py-6">
        <div class="container mx-auto flex flex-row items-center justify-center">
            <form action="" method="post" class="p-4 bg-gray-200/20 rounded-sm w-auto grid grid-flow-row gap-6">
                <div class="flex flex-col items-start space-y-2 w-full">
                    <label for="leave_type" class="text-xs font-semibold">Type of leave</label>
                    <select name="leave_type" id="leave_type" class="p-2 text-sm w-full">
                        <option value="" selected>Please select type of leave</option>
                        <option value="1">Annual Leave</option>
                        <option value="2">Sick Leave</option>
                        <option value="3">Vacation Leave</option>
                    </select>
                </div>
                <div class="flex flex-row items-center space-x-4" id="default_leave">
                    <div class="flex flex-col items-start space-y-2 w-full">
                        <label for="leave_start_default" class="text-xs font-semibold">Start of Leave</label>
                        <input type="date" name="leave_start" id="leave_start_default" class="p-2 text-sm w-full">
                    </div>
                    <div class="flex flex-col items-start space-y-2 w-full">
                        <label for="leave_end_default" class="text-xs font-semibold">End of Leave</label>
                        <input type="date" name="leave_end" id="leave_end_default" class="p-2 text-sm w-full">
                    </div>
                </div>
                <div class="hidden flex-row items-center space-x-4" id="secondary_leave">
                    <div class="flex flex-col items-start space-y-2 w-full">
                        <label for="leave_start_secondary" class="text-xs font-semibold">Start of Leave</label>
                        <input type="datetime-local" name="leave_start" id="leave_start_secondary" class="p-2 text-sm w-full" disabled>
                    </div>
                    <div class="flex flex-col items-start space-y-2 w-full">
                        <label for="leave_end_secondary" class="text-xs font-semibold">End of Leave</label>
                        <input type="datetime-local" name="leave_end" id="leave_end_secondary" class="p-2 text-sm w-full" disabled>
                    </div>
                </div>
                <button type="submit" name="apply_for_leave" class="px-4 py-2 bg-blue-600 text-white rounded-sm text-sm">Submit</button>
            </form>
        </div>
    </section>

    <script src="./js/main.js"></script>
</body>

</html>