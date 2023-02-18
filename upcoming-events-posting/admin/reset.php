<?php

require_once('./header-reset.php');
require_once('./calendar-form.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Password Reset - OPD CMS</title>
  <link rel="shortcut icon" href="./logo-1.ico" type="image/x-icon">
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./font-awesome/css/all.min.css">
  <link rel="stylesheet" href="./font-awesome/css/brands.min.css">
  <link rel="stylesheet" href="./font-awesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="./font-awesome/css/regular.min.css">
  <link rel="stylesheet" href="./font-awesome/css/solid.min.css">
  <script src="./js/jquery.min.js"></script>
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

<body onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">
  <div class="container w-25 d-block mx-auto justify-content-center align-items-center">
    <form action="" method="POST" class="mt-3">
      <div class="mb-3">
        <label for="" class="form-label">Enter Current Password</label>
        <input type="password" name="passOld" class="form-control" id="">
      </div>
      <div class="mb-3">
        <label for="" class="form-label">Enter New Password</label>
        <input type="password" name="passNew" class="form-control" id="">
      </div>
      <div class="mb-3">
        <label for="" class="form-label">Confirm New Password</label>
        <input type="password" name="passConfirm" class="form-control" id="">
      </div>
      <button type="submit" name="confirm" class="btn btn-success">Confirm</button>
    </form>
  </div>
  <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>