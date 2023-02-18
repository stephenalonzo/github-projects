<?php

require_once('./header.php');
require_once('./auth.php');
require_once('./calendar-form.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>News & Announcements - OPD CMS</title>
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
  <script src="./js/jquery.min.js"></script>
  <script src="./js/nicEdit-latest.js"></script>
  <script src="./js/nicEdit-component.js"></script>
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
  <script>
    if (typeof window.history.pushState == 'function') {
      window.history.pushState({}, "Hide", "announcements.php");
    }
  </script>
</head>

<body>
  <div class="container d-block m-auto justify-content-center align-items-center">

    <?php if ($_SESSION['user'] === 'opd-admin') { ?>

    <span class="d-flex flex-row justify-content-between mb-3">
      <form action="" method="POST" class="d-flex">
        <input type="text" name="searchData" class="form-control"
          style="border-top-right-radius: 0px; border-bottom-right-radius: 0px;" id="" placeholder="Search News"
          required>
        <button type="submit" name="search" class="btn btn-primary"
          style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;">Search</button>
      </form>
      <form action="" method="POST" class="d-flex">
        <select class="form-select" name="filterYear" aria-label="Default select example">
          <option selected>Select Year</option>
          <option value="2022">2022</option>
          <option value="2021">2021</option>
        </select>
        <button type="submit" name="filter" class="btn btn-primary"
          style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;">Filter</button>
      </form>
    </span>

    <?php

      $search = $_POST['searchData'];
      $filter = $_POST['filterYear'];

      // run logic if the user has not clicked on the search button and if search field is empty
      if (!isset($_POST['search']) && empty($search) && !isset($_POST['filter']) && empty($filter)) {

        $params['limit'] = 10;

        // check if the page url returned a parameter 'page'
        // if false, set the page to default of 1
        if (isset($_GET['page'])) {

          $params['page'] = $_GET['page'];
          
        } else {

          $params['page'] = 1;
        }

        // create page limit for browsing announcements
        $params['start'] = ($params['page'] - 1) * $params['limit'];

        // check if the page is at page 1
        // if false, initiate previous page
        if ($params['page'] == 1) {

          $params['prev'] = ($params['page']);
        } else {

          $params['prev'] = ($params['page'] - 1);
        }

        // initiate next page every time next is clicked
        $params['next'] = ($params['page'] + 1);

        $start = $params['start'];
        $limit = $params['limit'];

        $params['dba']['s'] = "SELECT * FROM announcements ORDER BY id DESC LIMIT $start, $limit";
        $stmt = $pdo->prepare($params['dba']['s']);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $params['dba']['t'] = "SELECT count(id) as id FROM announcements";
        $stmt = $pdo->prepare($params['dba']['t']);
        $stmt->execute();
        $params['rowCount'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $params['total'] = $params['rowCount'][0]['id'];
        $params['pages'] = ceil($params['total'] / $params['limit']);

      ?>

    <?php

        foreach ($results as $row) {

        ?>

    <div class="card mb-3 announcements-card">
      <div class="row g-0">
        <div class="col-lg-4 announcements-img-placeholder py-3 d-flex justify-content-center">
          <img src="./upload/<?php echo $row['imageFname']; ?>" class="img-fluid rounded-start announcements-img"
            alt="...">
        </div>
        <div class="col-lg-8 announcements-body">
          <div class="card-body">
            <h5 class="card-title"><?php echo $row['newsTitle']; ?></h5>
            <p class="card-text">
              <?php $sentence = preg_replace('/([^?!.]*.).*/', '\\1', $row['newsDesc']); echo $sentence; ?></p>
            <p class="card-text"><small class="text-muted"><?php echo $row['newsDate']; ?></small></p>
          </div>
          <div class="card-btn">
            <a href="./news.php?announcement=<?php echo $row['id']; ?>&<?php echo $row['newsTitle'] ?>"
              class="btn btn-primary">Read More</a>
          </div>
        </div>
      </div>
    </div>

    <?php } ?>

    <?php } elseif (isset($_POST['search']) && !empty($search)) {

        $params['dba']['s'] = "SELECT * FROM announcements WHERE newsTitle LIKE '%$search%'";
        $stmt = $pdo->prepare($params['dba']['s']);
        $stmt->execute();
        $params['rowCount'] = $pdo->query($params['dba']['s'])->rowCount();
        $rows = array();

        if ($params['rowCount'] == 0) {

          // do nothing

        } else {

          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $rows[] = $row;

            // check if data search exists in db
            // if true, do nothing
            if ($params['rowCount'] == 0) {

              // do nothing

            } else {

              $annT = $row['newsTitle'];
              $annD = $row['newsDesc'];
              $sentence = preg_replace('/(.*?[?!.](?=\s|$)).*/', '\\1', $annD);

              echo '<div class="card mb-3 announcements-card">
                        <div class="row g-0">
                          <div class="col-lg-4 announcements-img-placeholder py-3 d-flex justify-content-center">
                            <img src="./upload/' . $row['imageFname'] . '" class="img-fluid rounded-start announcements-img" alt="...">
                          </div>
                          <div class="col-lg-8 announcements-body">
                            <div class="card-body">
                              <h5 class="card-title">' . $annT . '</h5>
                              <p class="card-text">' . $sentence . '</p>
                              <p class="card-text"><small class="text-muted">' . $row['newsDate'] . '</small></p>
                            </div>
                            <div class="card-btn">
                              <a href="./news.php?announcement=' . $row['id'] . '&' . $annT . '" class="btn btn-primary">Read More</a>
                            </div>
                          </div>
                        </div>
                      </div>';
            }
          }
        }
      } elseif(isset($_POST['filter']) && !empty($filter)) { 

        $params['dba']['s'] = "SELECT * FROM announcements WHERE newsDate LIKE '%$filter%'";
        $stmt = $pdo->prepare($params['dba']['s']);
        $stmt->execute();
        $params['rowCount'] = $pdo->query($params['dba']['s'])->rowCount();
        $rows = array();

        if ($params['rowCount'] == 0) {

          // do nothing

        } else {

          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $rows[] = $row;

            // check if data search exists in db
            // if true, do nothing
            if ($params['rowCount'] == 0) {

              // do nothing

            } else {

              $annT = $row['newsTitle'];
              $annD = $row['newsDesc'];
              $sentence = preg_replace('/(.*?[?!.](?=\s|$)).*/', '\\1', $annD);

              echo '<div class="card mb-3 announcements-card">
                        <div class="row g-0">
                          <div class="col-lg-4 announcements-img-placeholder py-3 d-flex justify-content-center">
                            <img src="./upload/' . $row['imageFname'] . '" class="img-fluid rounded-start announcements-img" alt="...">
                          </div>
                          <div class="col-lg-8 announcements-body">
                            <div class="card-body">
                              <h5 class="card-title">' . $annT . '</h5>
                              <p class="card-text">' . $sentence . '</p>
                              <p class="card-text"><small class="text-muted">' . $row['newsDate'] . '</small></p>
                            </div>
                            <div class="card-btn">
                              <a href="./news.php?announcement=' . $row['id'] . '&' . $annT . '" class="btn btn-primary">Read More</a>
                            </div>
                          </div>
                        </div>
                      </div>';
            }
          }
        }

 } ?>

    <div class="d-flex justify-content-center align-items-center">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item"><a class="page-link"
              href="./announcements.php?page=<?php echo $params['prev']; ?>">Previous</a>
          </li>
          <?php for ($i = 1; $i <= $params['pages']; $i++) : ?>
          <li class="page-item <?php if ($i == $params['page']) {
                                      echo 'active';
                                    } ?>">
            <a class="page-link" href="./announcements.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
          </li>
          <?php endfor; ?>
          <li class="page-item"><a class="page-link"
              href="./announcements.php?page=<?php echo $params['next']; ?>">Next</a>
          </li>
        </ul>
      </nav>
    </div>

    <?php } ?>

  </div>

  <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>