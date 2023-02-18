<?php

error_reporting (E_ALL ^ E_NOTICE);
error_reporting(E_ERROR | E_PARSE);
date_default_timezone_set('Pacific/Saipan');

include_once('./session.php');

?>

<?php if(!isset($_SESSION['id'])) { ?>


<?php } else { ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">

    <?php if(!$_SESSION['id']) { ?>

    <?php } else { ?>

    <a href="./index.php" class="navbar-brand">OPD Calendar/Events Tool</a>

    <?php } ?>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <?php if(!$_SESSION['id']) { ?>

      <!-- empty data -->

      <?php } elseif($_SESSION['user'] !== 'opd-admin') { ?>

      <!-- empty data -->

      <?php } elseif($_SESSION['user'] === 'opd-admin') { ?>

      <ul class="navbar-nav me-auto mb-2 mb-lg-0" id="calendarNav">
        <form action="" method="POST" class="mb-0" id="nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Events
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a href="./index.php" class="dropdown-item">Create</a></li>
              <li><a href="./manage-events.php" class="dropdown-item">Manage</a></li>
              <li><a href="./calendar.php" class="dropdown-item">View Full Calendar</a></li>
            </ul>
          </li>
          <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              RFPs/ITBs
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a href="./post-rfp.php" class="dropdown-item">Create</a></li>
              <li><a href="./manage-rfps.php" class="dropdown-item">Manage</a></li>
            </ul>
          </li> -->
          <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Job Announcements
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a href="./post-job.php" class="dropdown-item">Create</a></li>
              <li><a href="./manage-jobs.php" class="dropdown-item">Manage</a></li>
            </ul>
          </li> -->
        </form>
      </ul>

      <?php } ?>

      <?php if($_SESSION['user'] === 'oit-admin') { ?>

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a href="./index.php" class="nav-link">Users</a>
        </li>
      </ul>

      <?php } ?>

      <ul class="navbar-nav">
        <li class="nav-item">
          <form class="m-0" action="" method="POST">
            <button type="submit" name="logout" class="nav-link">Logout</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>
<br>
<?php } ?>
