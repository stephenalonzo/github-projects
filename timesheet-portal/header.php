<?php

session_start();

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Time Punch Portal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php 
        if (isset($_SESSION['emp_num'])) {
        ?>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./timesheet.php">My Timesheet</a>
                </li>
            </ul>
            <span class="d-flex align-items-center justify-content-between">
                <p class="mx-0 my-0 ms-0 me-3 p-0" style="color: #fff;">Welcome back, <?php echo strtok($_SESSION['emp_name'], " "); ?>!</p>
                <form action="" method="post" class="m-0">
                    <button class="btn btn-success" type="submit" name="empLogout">Logout</button>
                </form>
            </span>
        </div>
        <?php } ?>
    </div>
</nav>