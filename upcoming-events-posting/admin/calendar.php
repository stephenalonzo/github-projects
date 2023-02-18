<?php

require_once('./header.php');
require_once('./calendar-form.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OPD CMS</title>
  <link rel="shortcut icon" href="./logo-1.ico" type="image/x-icon">
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="./css/fullcalendar.css">
  <link rel="stylesheet" href="./css/bootstrap.min-cal.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./font-awesome/css/all.min.css">
  <link rel="stylesheet" href="./font-awesome/css/brands.min.css">
  <link rel="stylesheet" href="./font-awesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="./font-awesome/css/regular.min.css">
  <link rel="stylesheet" href="./font-awesome/css/solid.min.css">
  <script src="./js/jquery.min-cal.js"></script>
  <script src="./js/app-functions.js"></script>
  <script src="./js/jquery-ui.min.js"></script>
  <script src="./js/moment.min.js"></script>
  <script src="./js/fullcalendar.min.js"></script>
  <script src="./js/tooltip.js"></script>
  <script src="./js/app.js"></script>
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

    <div id="calendarDisplay">
      <span class="d-flex justify-content-between align-items-center">
        <input style="width: 25%;" class="form-control my-3 me-2" type="text" id="keyword" placeholder="Search keyword">
        <select style="width: 25%;" class="form-select" id="filterEvent" aria-label="Default select example">
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

  <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>