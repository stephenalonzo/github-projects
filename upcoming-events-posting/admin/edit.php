<?php

require_once ('./header.php');
require_once ('./auth.php');
require_once ('./calendar-form.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Event - OPD CMS</title>
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
  <script src="./js/edit-function.js"></script>
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
</head>

<body onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">
  <div class="container d-block mt-3 justify-content-center align-items-center">

    <?php

    if (!isset($_GET['event']) && !isset($_GET['title']))
    {

      // display none

    } elseif (isset($_GET['event']) && isset($_GET['title'])) {
      
      function event($params)
      {
        
        $params['id'] = $_GET['event'];
        $params['dba']['s'] = "SELECT * FROM events WHERE id = :id";

        $params['bindParam'] = array(
          ':id' => $params['id']
        );

        $stmt = dbAccess($params);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;

      }
      
    ?>

      <?php

      $results = event($params);

      foreach ($results as $row) {
      ?>

        <form action="" enctype="multipart/form-data" name="form" method="POST">
          <div class="form-floating mb-3">
            <input type="text" name="title" class="form-control" id="textarea" placeholder="Title of Event" maxlength="60" value="<?php echo $row['eventTitle'] ?>">
            <label for="floatingInput">Title of Event</label>
            <small><i>
                <div class="mt-1" id="textarea_feedback"></div>
              </i></small>
          </div>
          <div class="mb-3">
            <div class="alert alert-info" role="alert">
              Select <strong><i>the box</i></strong> below if the event is an all-day event.
            </div>
          </div>
          <div class="form-check form-check-inline mb-3">
            <input class="form-check-input" type="checkbox" id="allDayT" name="all_day" value="1" <?php if (($row['allDay'] == '1') == 1) { echo 'checked'; } ?>>
            <label class="form-check-label" for="inlineCheckbox1">All Day</label>
          </div>
          <div id="defaultDate">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-floating mb-3">
                  <input type="datetime-local" name="start_date" id="defaultStart" class="form-control" placeholder="" value="<?php echo date('Y-m-d\TH:i:s', strtotime($row['startDate'])); ?>">
                  <label for="floatingInput">Event (Start)</label>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-floating mb-3">
                  <input type="datetime-local" name="end_date" id="defaultEnd" class="form-control" placeholder="" value="<?php echo date('Y-m-d\TH:i:s', strtotime($row['endDate'])); ?>">
                  <label for="floatingInput">Event (End)</label>
                </div>
              </div>
            </div>
          </div>
          <div id="allDayDate" style="display: none;">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-floating mb-3">
                  <input type="date" name="start_date" id="allDayStart" class="form-control" placeholder="" value="<?php echo date('Y-m-d', strtotime($row['startDate'])); ?>" disabled>
                  <label for="floatingInput">Event (Start)</label>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-floating mb-3">
                  <input type="date" name="end_date" class="form-control" id="allDayEnd" placeholder="" value="<?php echo date('Y-m-d', strtotime($row['endDate'])); ?>" disabled>
                  <label for="floatingInput">Event (End)</label>
                </div>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="area1" name="description" rows="3"><?php echo $row['eventDesc']; ?></textarea>
            <p><small><i id="textarea_feedback"></i></small></p>
          </div>
          <div class="d-flex align-items-center mb-3">
            <input type="color" class="form-control form-control-color me-2" id="inputColor" name="color" value="<?php echo $row['eventColor'] ?>" title="Set a color for the event" required>
            <label for="" class="form-label m-0">Set a color for the event</label>
          </div>
          <div class="mb-3">
            <div class="alert alert-info" role="alert">
              Select <strong><i>the category</i></strong> that applies:
            </div>
          </div>
          <div class="mb-3 d-flex justify-content-between">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Agency Training" name="category[]" id="" 
              <?php
              $search = 'Agency Training';
              if (preg_match("/{$search}/i", $row['eventCategory'])) {
              echo 'checked';
              } ?>>
              <label class="form-check-label" for="defaultCheck1">
                Agency Training
              </label>
            </div>
            <div class="form-check">

              <input class="form-check-input" type="checkbox" value="BE Taskforce" name="category[]" id="" 
              <?php 
              $search = 'BE Taskforce';
              if (preg_match("/{$search}/i", $row['eventCategory'])) {
                  echo 'checked';
                } ?>>

              <label class="form-check-label" for="defaultCheck1">
                BE Taskforce
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Community Event" name="category[]" id=""
              <?php 
              $search = 'Community Event';
              if (preg_match("/{$search}/i", $row['eventCategory'])) {
                  echo 'checked';
              } ?>>
              <label class="form-check-label" for="defaultCheck1">
                Community Event
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="NR Taskforce" name="category[]" id=""
              <?php 
              $search = 'NR Taskforce';
              if (preg_match("/{$search}/i", $row['eventCategory'])) {
                  echo 'checked';
              } ?>>
              <label class="form-check-label" for="defaultCheck1">
                NR Taskforce
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="PDAC" name="category[]" id="defaultCheck1"
              <?php 
              $search = 'PDAC';
              if (preg_match("/{$search}/i", $row['eventCategory'])) {
                  echo 'checked';
              } ?>>
              <label class="form-check-label" for="defaultCheck1">
                PDAC
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Public Meeting" name="category[]" id="defaultCheck1"
              <?php 
              $search = 'Public Meeting';
              if (preg_match("/{$search}/i", $row['eventCategory'])) {
                  echo 'checked';
              } ?>>
              <label class="form-check-label" for="defaultCheck1">
                Public Meeting
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Public Notice" name="category[]" id="defaultCheck1"
              <?php 
              $search = 'Public Notice';
              if (preg_match("/{$search}/i", $row['eventCategory'])) {
                echo 'checked';
              } ?>>
              <label class="form-check-label" for="defaultCheck1">
                Public Notice
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="SE/DRR Taskforce" name="category[]" id="defaultCheck1"
              <?php 
              $search = 'SE';
              if (preg_match("/{$search}/i", $row['eventCategory'])) {
                echo 'checked';
              } ?>>
              <label class="form-check-label" for="defaultCheck1">
                SE/DRR Taskforce
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Webinar" name="category[]" id="defaultCheck1"
              <?php 
              $search = 'Webinar';
              if (preg_match("/{$search}/i", $row['eventCategory'])){
                  echo 'checked';
                } ?>>
              <label class="form-check-label" for="defaultCheck1">
                Webinar
              </label>
            </div>
          </div>
          <div class="mb-3">
            <table class="table table-borderless">
              <tbody>
                <td style="width: 50px;" class="align-middle ps-0">
                  <label class="form-check-label" for="flexCheckDefault">
                    Tags
                  </label>
                </td>
                <td>
                  <input type="text" class="form-control" id="" name="tags" placeholder="Separate tags with commas: ex. opd, pdac, complete streets..." value="<?php echo $row['eventTags'] ?>">
                </td>
              </tbody>
            </table>
          </div>
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="" id="createBlogPost">
            <label class="form-check-label" for="">
              Create a blog post
            </label>
          </div>

          <span id="blogForm" style="display: none;">
            <div class="form-floating mb-3">
              <input type="text" name="newsTitle" class="form-control" id="rfpTitle" placeholder="">
              <label for="floatingInput">Blog Post Title</label>
            </div>
            <div class="mb-3">
              <div class="col-lg-12 custom-file-button d-flex">
                <label class="input-group-text" for="image">Choose Blog Image</label>
                <input class="form-control" type="file" name="img" id="image" />
              </div>
            </div>
          </span>
        <?php
      } ?>

        <input type="submit" name="edit" class="btn btn-success" value="Save Changes">
        </form>

      <?php
    } ?>

      <?php

      if (!isset($_GET['rfp'])) {

        // display none
      } elseif (isset($_GET['rfp'])) {
        function rfp()
        {
          $pdo = new PDO("mysql:host=localhost;dbname=opd", 'opdW', 'B62XPdHClHukD7Q0', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
          

          $params['id'] = $_GET['rfp'];
          $params['dba']['s'] = "SELECT * FROM rfp WHERE id = :id";
          $stmt = $pdo->prepare($params['dba']['s']);
          $stmt->bindParam(':id', $params['id']);
          $stmt->execute();

          $results = array();

          foreach ($stmt as $row) {
            $results[] = $row;
          }

          return $results;
        }

        rfp();

        function checkThis()
        {
          $pdo = new PDO("mysql:host=localhost;dbname=opd", 'opdW', 'B62XPdHClHukD7Q0', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
          

          $params['title'] = $_GET['title'];
          $params['dba']['s'] = "SELECT * FROM announcements WHERE newsTitle = :title";
          $st = $pdo->prepare($params['dba']['s']);
          $st->bindParam(':title', $params['title']);
          $st->execute();
          $rows = $st->fetchAll();
          return $rows;
        } ?>

        <?php

        $data = rfp();

        foreach ($data as $results) {
        ?>

          <form action="" enctype="multipart/form-data" name="form" method="POST" id="rfpPost" class="mt-3">
            <div class="form-floating mb-3">
              <!-- add maxlength, add character limit notification -->
              <input type="text" name="title" class="form-control" id="rfpTitle" value="<?php echo $results['rfpTitle'] ?>">
              <label for="floatingInput">Title of RFP/ITB</label>
              <!-- <small><i><div class="mt-1" id="textarea_feedback"></div></i></small> -->
            </div>
            <span class="d-flex align-items-start mb-3">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="type" id="rfpType" value="RFP" <?php if ($results['rfpType'] == 'RFP') {
                                                                                                    echo 'checked';
                                                                                                  } ?>>
                <label class="form-check-label" for="inlineRadio1">RFP</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="type" id="itbType" value="ITB" <?php if ($results['rfpType'] == 'ITB') {
                                                                                                    echo 'checked';
                                                                                                  } ?>>
                <label class="form-check-label" for="inlineRadio2">ITB</label>
              </div>
            </span>
            <div class="form-floating mb-3">
              <input type="text" name="rfpNum" class="form-control" id="rfpNum" value="<?php echo $results['rfpNum']; ?>">
              <label for="floatingInput">RFP/ITB No.</label>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-floating mb-3">
                  <input type="datetime-local" name="dateQuestions" id="dateQuestions" class="form-control" placeholder="" value="<?php echo date('Y-m-d\TH:i:s', strtotime($results['dateQuestions'])); ?>">
                  <label for="floatingInput">Due Date for Questions Submissions</label>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-floating mb-3">
                  <input type="datetime-local" name="dateRFP" id="dateRFP" class="form-control" placeholder="" value="<?php echo date('Y-m-d\TH:i:s', strtotime($results['dateRFP'])); ?>">
                  <label for="floatingInput">Due Date for RFP/ITB</label>
                </div>
              </div>
            </div>
            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" value="" id="createBlogPost">
              <label class="form-check-label" for="">
                Create a blog post
              </label>
            </div>


            <span id="blogForm" style="display: none;">
              <div class="form-floating mb-3" id="blogTitle">
                <input type="text" name="newsTitle" class="form-control" id="rfpTitle" placeholder="">
                <label for="floatingInput">Blog Post Title</label>
              </div>

              <div class="mb-3" id="blogDesc">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="area1" name="description"></textarea>
              </div>

              <div class="mb-3" id="blogImg">
                <div class="col-lg-12 custom-file-button d-flex">
                  <label class="input-group-text" for="image">Choose Blog Image</label>
                  <input class="form-control" type="file" name="img" id="image" />
                </div>
              </div>
            </span>

          <?php
        } ?>

          <input type="submit" name="editRFP" id="submit" value="Save Changes" class="btn btn-success">
          </form>

        <?php
      } ?>

        <?php

        if (!isset($_GET['job'])) {

          // display none
        } elseif (isset($_GET['job'])) {
          function job()
          {
            $pdo = new PDO("mysql:host=localhost;dbname=opd", 'opdW', 'B62XPdHClHukD7Q0', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            

            $params['id'] = $_GET['job'];
            $params['dba']['s'] = "SELECT * FROM employment WHERE id = :id";
            $stmt = $pdo->prepare($params['dba']['s']);
            $stmt->bindParam(':id', $params['id']);
            $stmt->execute();

            $results = array();

            foreach ($stmt as $row) {
              $results[] = $row;
            }

            return $results;
          }

          job();

          function checkThis()
          {
            $pdo = new PDO("mysql:host=localhost;dbname=opd", 'opdW', 'B62XPdHClHukD7Q0', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            

            $params['title'] = $_GET['title'];
            $params['dba']['s'] = "SELECT * FROM announcements WHERE newsTitle = :title";
            $st = $pdo->prepare($params['dba']['s']);
            $st->bindParam(':title', $params['title']);
            $st->execute();
            $rows = $st->fetchAll();
            return $rows;
          } ?>

          <?php

          $data = job();

          foreach ($data as $results) {
          ?>

            <form action="" enctype="multipart/form-data" name="form" method="POST">
              <div class="row mb-3">
                <div class="col-lg-6">
                  <div class="form-floating mb-3">
                    <input type="text" name="department" class="form-control" id="department" placeholder="Department/Organization" value="<?php echo $results['department'] ?>">
                    <label for="department">Department/Organization</label>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-floating mb-3">
                    <input type="text" name="position" class="form-control" id="position" placeholder="Title of Position" value="<?php echo $results['position'] ?>">
                    <label for="position">Title of Position</label>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-lg-6">
                  <div class="form-floating mb-3">
                    <input type="date" name="opening" class="form-control" id="opening" placeholder="" value="<?php echo date('Y-m-d', strtotime($results['openingDate'])); ?>">
                    <label for="opening">Opening Date</label>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-floating mb-3">
                    <input type="date" name="closing" class="form-control" id="closing" placeholder="" value="<?php echo date('Y-m-d', strtotime($results['closingDate'])); ?>">
                    <label for="closing">Closing Date</label>
                  </div>
                </div>
              </div>

              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="createBlogPost">
                <label class="form-check-label" for="">
                  Create a blog post
                </label>
              </div>


              <span id="blogForm" style="display: none;">
                <div class="form-floating mb-3" id="blogTitle">
                  <input type="text" name="newsTitle" class="form-control" id="rfpTitle" placeholder="">
                  <label for="floatingInput">Blog Post Title</label>
                </div>

                <div class="mb-3" id="blogDesc">
                  <label for="description" class="form-label">Description</label>
                  <textarea class="form-control" id="area1" name="description"></textarea>
                </div>

                <div class="mb-3" id="blogImg">
                  <div class="col-lg-12 custom-file-button d-flex">
                    <label class="input-group-text" for="image">Choose Blog Image</label>
                    <input class="form-control" type="file" name="img" id="image" />
                  </div>
                </div>
              </span>

            <?php
          } ?>

            <input type="submit" name="editJob" id="post" value="Save Changes" class="btn btn-success">
            </form>

          <?php
        } ?>

          <?php

          if (!isset($_GET['question'])) {

            // display none
          } elseif (isset($_GET['question'])) {
            function uploadQR()
            {
              $pdo = new PDO("mysql:host=localhost;dbname=opd", 'opdW', 'B62XPdHClHukD7Q0', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
              $params['id'] = $_GET['question'];
              $params['dba']['s'] = "SELECT * FROM rfp WHERE id = :id";
              $stmt = $pdo->prepare($params['dba']['s']);
              $stmt->bindParam(':id', $params['id']);
              $stmt->execute();

              $results = array();

              foreach ($stmt as $row) {
                $result[] = $row;
              }

              return $results;
            }

            uploadQR(); ?>

            <form action="" enctype="multipart/form-data" name="form" method="POST" id="rfpPost" class="mt-3">
              <div class="mb-3">
                <label for="" class="form-label">Upload Question Response</label>
                <input class="form-control" type="file" name="file" id="file" />
              </div>
              <input type="submit" name="question" id="submit" value="Upload" class="btn btn-primary">
            </form>

          <?php
          } ?>

          <?php

          if (!isset($_GET['blog'])) {

            // do nothing

          } else {
            $params['id'] = $_GET['blog'];
            $params['sql'] = "SELECT * FROM announcements WHERE id = :id";
            $stmt = $pdo->prepare($params['sql']);
            $stmt->bindParam(':id', $params['id']);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $row) {
          ?>

              <form action="" enctype="multipart/form-data" name="form" method="POST">

                <div class="form-floating mb-3">
                  <input type="text" name="title" class="form-control" id="blog-title" placeholder="Blog Title" value="<?php echo $row['newsTitle']; ?>">
                  <label for="blog-title">Blog Title</label>
                </div>

                <div class="mb-3">
                  <label for="description" class="form-label">Description</label>
                  <textarea class="form-control" id="area1" name="description"><?php echo $row['newsDesc']; ?></textarea>
                </div>

                <div class="mb-3">
                  <div class="row">
                    <div class="col-lg-6">
                      <label for="" class="form-label">Blog Category</label>
                      <select class="form-select" aria-label="" name="blogCategory" id="blogCategory">
                        <?php

                        if (($row['blogCategory']) == 'Announcements') {

                          echo '
                        <option value="Announcements" selected>Announcements</option>
                        <option value="News Resource">News Resource</option>
                        <option value="Press Release">Press Release</option>
                        <option value="Public Notice">Public Notice</option>
                        <option value="RFP">RFP</option>                        
                        ';
                        } elseif (($row['blogCategory']) == 'News Resource') {

                          echo '
                          <option value="Announcements">Announcements</option>
                          <option value="News Resource" selected>News Resource</option>
                          <option value="Press Release">Press Release</option>
                          <option value="Public Notice">Public Notice</option>
                          <option value="RFP">RFP</option>                        
                          ';
                        } elseif (($row['blogCategory']) == 'Press Release') {

                          echo '
                          <option value="Announcements">Announcements</option>
                          <option value="News Resource">News Resource</option>
                          <option value="Press Release" selected>Press Release</option>
                          <option value="Public Notice">Public Notice</option>
                          <option value="RFP">RFP</option>                        
                          ';
                        } elseif (($row['blogCategory']) == 'Public Notice') {

                          echo '
                          <option value="Announcements">Announcements</option>
                          <option value="News Resource">News Resource</option>
                          <option value="Press Release">Press Release</option>
                          <option value="Public Notice" selected>Public Notice</option>
                          <option value="RFP">RFP</option>                        
                          ';
                        } elseif (($row['blogCategory']) == 'RFP') {

                          echo '
                          <option value="Announcements">Announcements</option>
                          <option value="News Resource">News Resource</option>
                          <option value="Press Release">Press Release</option>
                          <option value="Public Notice">Public Notice</option>
                          <option value="RFP" selected>RFP</option>                        
                          ';
                        } elseif (empty($row['blogCategory'])) {

                          echo '
                          <option value="" disabled selected>Choose...</option>
                          <option value="Announcements">Announcements</option>
                          <option value="News Resource">News Resource</option>
                          <option value="Press Release">Press Release</option>
                          <option value="Public Notice">Public Notice</option>
                          <option value="RFP">RFP</option>                        
                          ';
                        }

                        ?>
                      </select>
                    </div>
                    <div class="col-lg-6">
                      <label for="" class="form-label">Upload Blog Image</label>
                      <input class="form-control" type="file" name="img" id="blogPost" />
                    </div>
                  </div>
                </div>

                <input type="submit" name="editBlog" id="blog" value="Save Changes" class="btn btn-success">

              </form>

          <?php
            }
          } ?>

  </div>

  <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>