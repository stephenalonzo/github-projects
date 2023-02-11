<?php

require_once('./header.php');
require_once('./authentication.php');
require_once('./controller.php');

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
                <div class="alert alert-secondary d-flex flex-column justify-content-between" role="alert" style="height: 128px;">
                <?php 

                $results = singleEmployeeData($params);

                foreach ($results as $row) {
                ?>
                    <span>
                        <input type="text" name="emp_name" value="<?php echo $row['emp_name']; ?>" class="bg-transparent border border-0 fw-bold fs-5 m-0 p-0 disabled readonly form-control-plaintext" readonly>
                        <p class="m-0">
                            <small><?php echo $row['emp_position']; ?></small>
                        </p>
                    </span>
                    <p class="m-0">Status: <span class="fw-bold"><?php echo $row['emp_status']; ?></span></p>
                <?php } ?>
                </div>
                <input type="text" name="emp_num" value="<?php echo $_SESSION['emp_num']; ?>" class="d-none">
                    <?php 

                    $results = singleEmployeeData($params);

                    foreach ($results as $row) {
                    
                    if (isset($_POST['timeIn'])) {

                    ?>
                    <button type="submit" name="timeOut" class="btn btn-danger">Time Out</button>
                    <button type="submit" name="lunchOut" class="btn btn-primary">Lunch Out</button>
                    <?php } elseif (isset($_POST['lunchOut'])) { ?> 
                    <button type="submit" name="timeOut" class="btn btn-danger">Time Out</button>
                    <button type="submit" name="lunchIn" class="btn btn-secondary">Lunch In</button>
                    <?php } elseif (isset($_POST['lunchIn'])) { ?> 
                    <button type="submit" name="timeOut" class="btn btn-danger">Time Out</button>
                    <button type="submit" name="lunchOut" class="btn btn-primary disabled">Lunch Out</button>
                    <?php } else { ?>
                    <button type="submit" name="timeIn" class="btn btn-success">Time In</button>
                    <button type="submit" name="lunchOut" class="btn btn-primary disabled">Lunch Out</button>
                    <?php } } ?>
                </form>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>
    <script src="./js/main.js"></script>
</body>

</html>