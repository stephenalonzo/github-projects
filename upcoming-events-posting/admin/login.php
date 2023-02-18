<?php

require_once('./header.php');
require_once('./session.php');
require_once('./calendar-form.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - OPD CMS</title>
  <link rel="shortcut icon" href="./logo-1.ico" type="image/x-icon">
  <link rel="shortcut icon" href="./logo-1.ico" type="image/x-icon">
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./font-awesome/css/all.min.css">
  <link rel="stylesheet" href="./font-awesome/css/brands.min.css">
  <link rel="stylesheet" href="./font-awesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="./font-awesome/css/regular.min.css">
  <link rel="stylesheet" href="./font-awesome/css/solid.min.css">
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
  <script src="./js/app-functions.js"></script>
</head>

<body onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">
  <div class="container login-form">
    <form action="" method="POST">
      <!-- user input -->
      <div class="mb-3">
        <label for="" class="form-label">Username</label>
        <input type="text" name="user" class="form-control" id="" placeholder="" value="<?php if (isset($_POST['submit'])) echo $_POST['user']; ?>">
      </div>
      <!-- password input -->
      <div class="mb-3">
        <label for="" class="form-label">Password</label>
        <input type="password" name="pass" class="form-control" id="" placeholder="">
      </div>
      <!-- submit button -->
      <button type="submit" name="login" class="btn btn-primary">Sign In</button>
    </form>
  </div>

  <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>