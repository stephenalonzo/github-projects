<?php

error_reporting (E_ALL ^ E_NOTICE);
error_reporting(E_ERROR | E_PARSE);
date_default_timezone_set('Pacific/Saipan');

require_once('./admin/calendar-form.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendar | Office of Planning and Development</title>
  <link rel="shortcut icon" href="./logo-1.ico" type="image/x-icon">
  <link rel="stylesheet" href="./admin/css/fullcalendar.css">
  <link rel="stylesheet" href="./admin/css/bootstrap.min-cal.css">
  <link rel="stylesheet" href="./admin/css/bootstrap.min.css">
  <link rel="stylesheet" href="./admin/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="./admin/font-awesome/css/brands.min.css">
  <link rel="stylesheet" href="./admin/font-awesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="./admin/font-awesome/css/regular.min.css">
  <link rel="stylesheet" href="./admin/font-awesome/css/solid.min.css">
  <link rel="stylesheet" href="./assets/css/opd.css">
  <script src="./admin/js/jquery.min-cal.js"></script>
  <script src="./admin/js/app-functions.js"></script>
  <script src="./admin/js/jquery-ui.min.js"></script>
  <script src="./admin/js/moment.min.js"></script>
  <script src="./admin/js/fullcalendar.min.js"></script>
  <script src="./admin/js/tooltip.js"></script>
  <script src="./admin/js/app.js"></script>
  <link rel="icon" href="./assets/img/logo-1.png" />
  <!-- prevent from resubmitting form to avoid resubmitting -->
  <script type="text/javascript">
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
  <script>
    window.history.forward();

    function noBack() {
      window.history.forward();
    }
  </script>
</head>

<body>
  <div class="container">
    <div id="calendarDisplay" class="mt-3">
      <span class="d-flex justify-content-between align-items-center">
        <!-- <input style="width: 25%;" class="form-control my-3 me-2" type="text" id="keyword" placeholder="Search keyword"> -->
        <select class="form-select my-3" id="filterEvent" aria-label="Default select example">
          <option value="">All Categories</option>
          <option value="Agency Training">Agency Training</option>
          <option value="BE Taskforce">BE Taskforce</option>
          <option value="Community Event">Community Event</option>
          <option value="NR Taskforce">NR Taskforce</option>
          <option value="PDAC">PDAC</option>
          <option value="Public Meeting">Public Meeting</option>
          <option value="Public Notice">Public Notice</option>
          <option value="SE-DRR Taskforce">SE-DRR Taskforce</option>
          <option value="Webinar">Webinar</option>
        </select>
      </span>
      <div id="calendar"></div>
    </div>
  </div>

  <script src="./assets/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/popper.min.js"></script>
  <!-- <script src="./assets/js/jquery.min.js"></script> -->
  <script src="./assets/js/bootnavbar.js"></script>

  <script type="text/javascript">
    $(function () {
      $("#bootnavbar").bootnavbar();
    });
  </script>
</body>

</html>