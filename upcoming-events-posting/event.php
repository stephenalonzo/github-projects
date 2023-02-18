<?php

  error_reporting (E_ALL ^ E_NOTICE);
  error_reporting(E_ERROR | E_PARSE);
  date_default_timezone_set('Pacific/Saipan');

  require_once('./admin/calendar-form.php');

  if (!isset($_GET['id']) && !isset($_GET['title']))
  {

    header("Location: index.php");

  } else {

    function viewEvent()
    {

      $params['id'] = $_GET['id'];
      $params['title'] = $_GET['title'];

      $pdo = new PDO("mysql:host=localhost;dbname=github_projects", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

      $params['dba']['s'] = "SELECT * FROM events WHERE id = :id AND eventTitle = :eventTitle";
      $stmt = $pdo->prepare($params['dba']['s']);
      $stmt->bindParam(':id', $params['id']);
      $stmt->bindParam(':eventTitle', $params['title']);
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
            } ?> - Office of Planning and Development
    </title>
    <link rel="shortcut icon" href="./logo-1.ico" type="image/x-icon">
    <link rel="stylesheet" href="./admin/css/styles.css">
    <link rel="stylesheet" href="./admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="./admin/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="./admin/font-awesome/css/brands.min.css">
    <link rel="stylesheet" href="./admin/font-awesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="./admin/font-awesome/css/regular.min.css">
    <link rel="stylesheet" href="./admin/font-awesome/css/solid.min.css">
    <link rel="stylesheet" href="./assets/css/opd.css">
    <script src="./admin/js/nicEdit-latest.js"></script>
    <script src="./admin/js/nicEdit-component.js"></script>
    <script src="./admin/js/jquery.min.js"></script>
    <script src="./assets/js/stc.min.js"></script>
    <script src="./assets/js/atc.min.js"></script>
    <link rel="icon" href="./assets/img/logo-1.png" />
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
                <p class="text-muted">
                  <?php

                  if($results['allDay'] == 1)
                  {

                    echo date('F d, Y', strtotime($results['startDate']))." All Day";

                  } else {

                    echo date('F d, Y @ h:iA', strtotime($results['startDate']));

                  }

                  ?>
                </p>
                <p><?php echo $results['eventDesc'] ?></p>
              </div>
              <div class="mb-3 event-btn d-flex align-items-center">
                <div id="<?php echo $results['id']; ?>" class="me-3"></div>
                <script>
                    $(function () {
                      $("#<?php echo $results['id'] ?>").load("./view-event.php?id=<?php echo $results['id']; ?>");
                    });
                </script>
                <script language="JavaScript" type="text/javascript">
                var user = "planning";
                var host = "opd.gov.mp";
                var link = user + "@" + host;
                var text = "RSVP";
                document.write(
                            "<a class='btn btn-primary' target='_blank' hre" +
                            "f=mai" +
                            "lto:" +
                            user +
                            "@" +
                            host +
                            "><i class='far fa-paper-plane pe-2'></i>" +
                            text +
                            "</a>"
                            );
                // </script>
              </div>
              <?php

                    if(empty($results['eventTags']) && !empty($results['eventCategory']))
                    {

              ?>

              <div class="minor-details">
                <div class="alert alert-dark" role="alert">
                  <span class="d-flex flex-column">
                    <p class="mb-0"><strong>Event Categories:</strong></p>
                    <p><?php echo $results['eventCategory']; ?></p>
                  </span>
                </div>
              </div>

              <?php } elseif(empty($results['eventTags']) && empty($results['eventCategory'])) { ?>


              <?php } else { ?>

                <div class="minor-details">
                <div class="alert alert-dark" role="alert">
                  <span class="d-flex flex-column">
                    <p class="mb-0"><strong>Event Categories:</strong></p>
                    <p><?php echo $results['eventCategory']; ?></p>
                    <p class="mb-0"><strong>Event Tags:</strong></p>
                    <p><?php echo $results['eventTags']; ?></p>
                  </span>
                </div>
              </div>

              <?php } ?>
              <?php } ?>

            </div>


        <?php } ?>
        </div>
      </div>
    </div>

    <script src="./js/bootstrap.bundle.min.js"></script>
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
