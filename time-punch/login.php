<?php 

require_once ('app/AppHeader.php');
require_once ('app/AppController.php');

if (isset($_SESSION['emp_number'])) {
    
    header("Location: index.php");

} else {

    
}

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
    <div class="flex justify-center items-center">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 px-4 py-6 rounded-md bg-gray-200/30 w-96 flex flex-col items-center justify-center space-y-4">
            <h1 class="text-xl font-semibold text-black/90">Welcome back!</h1>
            <form action="" method="post" class="space-y-4 w-full">
                <input type="text" name="emp_number" id="emp_number" class="p-2 rounded-sm w-full text-sm focus:border-none focus:outline-none focus:shadow-none" placeholder="Enter your employee number">
                <button type="submit" name="emp_login" class="px-4 py-2 bg-blue-500 text-white w-full text-sm rounded-sm">Login</button>
            </form>
        </div>
    </div>
</body>

</html>