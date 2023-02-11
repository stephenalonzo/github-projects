<?php

include_once ('./session.php');

if (!isset($_SESSION['emp_num'])) {

} else {

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="./">Time Punch Portal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php
        if (isset($_SESSION['emp_num'])) {
        ?>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 align-items-center text-center mb-lg-0">
                    <li class="nav-item me-2">
                        <a class="nav-link" aria-current="page" href="./my-timesheet.php">My Timesheet</a>
                    </li>
                    <li class="nav-item me-2">
                        <button type="button" class="bg-transparent border border-0 p-0 nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Apply for Leave
                        </button>
                    </li>
                    <?php 
                    
                    if (isset($_SESSION['emp_position']) && $_SESSION['emp_position'] == 'Manager') {
                    
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Manage
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./staff-timesheets.php">Staff Timesheets</a></li>
                            <li><a class="dropdown-item" href="#">Staff Leave Applications</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
                <span class="d-flex align-items-center justify-content-between">
                    <p class="mx-0 my-0 ms-0 me-3 p-0" style="color: #fff;">Welcome back, <?php echo strtok($_SESSION['emp_name'], " "); ?>!</p>
                    <a href="./logout.php" class="btn btn-secondary">Logout</a>
                </span>
            </div>
        <?php } ?>
    </div>
</nav>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Apply for Leave</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" class="m-0 p-0">
                <div class="modal-body">
                    <div class="d-flex flex-row justify-content-around align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="leave_type" id="annualLeave" value="AL">
                            <label class="form-check-label" for="annualLeave">
                                Annual Leave
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="leave_type" id="sickLeave" value="SL">
                            <label class="form-check-label" for="sickLeave">
                                Sick Leave
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="leave_type" id="vacationLeave" value="VL">
                            <label class="form-check-label" for="vacationLeave">
                                Vacation Leave
                            </label>
                        </div>
                    </div>
                    <div class="row mt-3 d-none" id="standardLeave">
                        <div class="col-md-6 d-flex flex-column justify-content-start align-items-start">
                            <label for="">From</label>
                            <input type="date" name="leave_time_in" id="leaveFromDateStandard" class="w-100">
                        </div>
                        <div class="col-md-6 d-flex flex-column justify-content-start align-items-start" id="leaveTo">
                            <label for="">To</label>
                            <input type="date" name="leave_time_out" id="leaveToDateStandard" class="w-100">
                        </div>
                    </div>
                    <div class="row mt-3 d-none" id="secondaryLeave">
                        <div class="col-md-6 d-flex flex-column justify-content-start align-items-start">
                            <label for="">From</label>
                            <input type="datetime-local" name="leave_time_in" id="leaveFromDateSecondary" class="w-100" disabled>
                        </div>
                        <div class="col-md-6 d-flex flex-column justify-content-start align-items-start" id="leaveTo">
                            <label for="">To</label>
                            <input type="datetime-local" name="leave_time_out" id="leaveToDateSecondary" class="w-100" disabled>
                        </div>
                        <div class="col-md-12 mt-3">
                            <textarea name="reason_for_leave" id="leaveReason" class="w-100 ps-2 pt-1" placeholder="Reason for leave..." style="height: 128px; resize: none;" disabled></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="submitLeave">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>