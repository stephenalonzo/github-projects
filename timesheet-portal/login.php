<?php

require_once('header.php');
require_once('controller.php');

if (!isset($_SESSION['emp_num'])) {

    
} else {

    header("Location: index.php");

}

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
        <section class="p-3">
            <div class="container mx-auto w-25">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">
                            Employee Number
                        </label>
                        <input type="text" name="emp_num" class="form-control" id="exampleFormControlInput1" placeholder="Enter your employee number">
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="empLogin" class="btn btn-primary">Sign In</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>
</body>

</html>