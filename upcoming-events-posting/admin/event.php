<?php

require_once('./header.php');
require_once('./auth.php');
require_once('./calendar-form.php');

if (!isset($_GET['id'])) {

  header("Location: index.php");
} else {

  function viewEvent()
  {

    $params['id'] = $_GET['id'];
    // $pdo = new PDO("mysql:host=localhost;dbname=opd", 'root', '');
    $pdo = new PDO("mysql:host=localhost;dbname=opd", 'opdW', 'B62XPdHClHukD7Q0', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    

    $params['dba']['s'] = "SELECT * FROM events WHERE id = :id";
    $stmt = $pdo->prepare($params['dba']['s']);
    $stmt->bindParam(':id', $params['id']);
    $stmt->execute();
    $results = array();
    foreach ($stmt as $row) {

      $results[] = $row;
    }

    return $results;
  }

  viewEvent();

?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $data = viewEvent();
            foreach ($data as $results) {
              echo $results['eventTitle'];
            } ?> - OPD CMS
    </title>
    <link rel="shortcut icon" href="./logo-1.ico" type="image/x-icon">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./font-awesome/css/all.min.css">
    <link rel="stylesheet" href="./font-awesome/css/brands.min.css">
    <link rel="stylesheet" href="./font-awesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="./font-awesome/css/regular.min.css">
    <link rel="stylesheet" href="./font-awesome/css/solid.min.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/nicEdit-latest.js"></script>
    <script src="./js/nicEdit-component.js"></script>
    <script>
      if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
      }
    </script>
  </head>

  <body>
    <div class="container d-block mx-auto justify-content-center align-items-center">
      <div class="content">
        <div class="wrapper">
          <?php

          $data = viewEvent();

          foreach ($data as $results) {

          ?>

            <div class="my-3 event-details">
              <div class="header-details">
                <h1><?php echo $results['eventTitle'] ?></h1>
                <p class="text-muted"><?php echo date('F d, Y', strtotime($results['startDate'])) ?></p>
                <p><?php echo $results['eventDesc'] ?></p>
              </div>
              <div class="mb-3 event-btn">

              </div>
              <div class="minor-details">
                <div class="alert alert-dark" role="alert">
                  <span class="d-flex flex-column">
                    <p class="mb-0"><strong>Event Categories:</strong></p>
                    <p><?php echo $results['eventCategory'] ?></p>
                  </span>
                </div>
              </div>
            </div>

          <?php } ?>

        <?php } ?>
        </div>
        <?php require_once('./footer.php'); ?>
      </div>
    </div>

    <script src="./js/bootstrap.bundle.min.js"></script>
  </body>

  </html>