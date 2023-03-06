<?php

  error_reporting (E_ALL ^ E_NOTICE);
  error_reporting(E_ERROR | E_PARSE);
  date_default_timezone_set('Pacific/Saipan');

  function dbAccess($params)
  {

    try
    {

		  $pdo = new PDO("mysql:host=localhost;dbname=u483856192_githubprojects", 'u483856192_salonzo', 'X2EQy9Dil', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

      // prepare iterations of SQL queries
      foreach ($params['dba'] as $key => $value) { $stmt = $pdo->prepare($params['dba'][$key]); }

      $stmt->execute($params['bindParam']);

      return $stmt;

    } catch (PDOException $e) {

      echo "Connection failed: " . $e->getMessage();

    }

    return $params;

  }

  function checkSession()
  {

    // check if the user session has been set
    if(isset($_SESSION['user'])) { header("Location: index.php"); }

  }

  function filterParams($params)
  {

    foreach ($params as $key => $value)
    {

      if ($key == 'user' || $key == 'locations')
      {

        // $dirty to convert HTML tags to a string
        // $sanitize to remove HTML tags from string
        // $clean to remove whitespace
        $dirty[$key]    = html_entity_decode($value);
        $sanitize[$key] = strip_tags($dirty[$key]);
        $clean[$key]    = trim($sanitize[$key]);

      }

    }

    return $clean;

  }

  function loginSuccessful($params)
  {

    if(isset($_POST['login']))
    {

      $params['user'] = $_POST['user'];
      $clean          = filterParams($params);

      $params['pass'] = $_POST['pass'];
      $params['pT']   = trim($params['pass']); // remove any whitespace from the password entered

      $params['dba']['s'] = "SELECT * FROM users WHERE user = :user";
      $params['bindParam'] = array(
        ':user' => $clean['user']
      );

      $stmt = dbAccess($params);

      $results = $stmt->fetch(PDO::FETCH_ASSOC);

      // validate username and password
      if($results['user'] == $clean['user'] && password_verify($params['pT'], $results['password']))
      {

        $_SESSION['user'] = $clean['user'];
        $_SESSION['pass'] = $params['pT'];
        $_SESSION['id']   = $results['id'];

      } else {

        header("Location: login.php");

      }

    }

  }

  loginSuccessful($params);

  // beach-advisories-results.php
  function getReport($params)
  {

    $params['dba']['s'] = "SELECT * FROM advisory ORDER by advisoryDate DESC";
    $stmt = dbAccess($params);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;

  }

  // manage.php
  function getReports($params)
  {

    $params['dba']['s'] = "SELECT * FROM advisory";
    $stmt = dbAccess($params);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;

  }

  function insertReport($params)
  {

    if(isset($_POST['submit']))
    {

      $params['title']        = $_POST['title'];
      $params['date']         = $_POST['date'];
      $params['status']       = $_POST['status'];
      $params['description']  = $_POST['description'];
      $locations              = array();
      $locations              = $_POST['loc'];
      $params['filter']       = array_filter($locations); // filter $locations array to a string
      $params['locations']    = implode(", ", $params['filter']);

      $clean                  = filterParams($params);

      switch ($params['status'])
      {

        case "RF":
          $params['status'] = "Red Flag";
          break;

        case "GF":
          $params['status'] = "Green Flag";
          break;

      }

      switch ($params['title'])
      {

        case "1":
          $params['title'] = "Saipan West Beaches Marine Water Quality Report";
          break;

        case "2":
          $params['title'] = "Saipan East Beaches Marine Water Quality Report";
          break;

        case "3":
          $params['title'] = "Tinian Marine Water Quality Report";
          break;

        case "4":
          $params['title'] = "Rota Marine Water Quality Report";
          break;

        case "5":
          $params['title'] = "Managaha Marine Water Quality Report";
          break;

      }

      switch (date('n', strtotime($params['date'])))
      {

        case 1:
          $params['monthID'] = "1";
          break;

        case 2:
          $params['monthID'] = "2";
          break;

        case 3:
          $params['monthID'] = "3";
          break;

        case 4:
          $params['monthID'] = "4";
          break;

        case 5:
          $params['monthID'] = "5";
          break;

        case 6:
          $params['monthID'] = "6";
          break;

        case 7:
          $params['monthID'] = "7";
          break;

        case 8:
          $params['monthID'] = "8";
          break;

        case 9:
          $params['monthID'] = "9";
          break;

        case 10:
          $params['monthID'] = "10";
          break;

        case 11:
          $params['monthID'] = "11";
          break;

        case 12:
          $params['monthID'] = "12";
          break;

      }

      $params['dba']['i'] =
        "INSERT INTO advisory
        (advisoryTitle,
        advisoryDate,
        advisoryDesc,
        advisorySts,
        advisoryLocations,
        monthID)
        VALUES
        (:title,
        :date,
        :desc,
        :status,
        :locations,
        :monthID)";

      $params['bindParam'] = array(
        ':title'        => $params['title'],
        ':date'         => $params['date'],
        ':desc'         => $params['description'],
        ':status'       => $params['status'],
        ':locations'    => $clean['locations'],
        ':monthID'      => $params['monthID']
      );

      dbAccess($params);

      if($params['dba']['i'])
      {

        $result =
        '<div class="container">
          <div class="alert alert-success w-75 mx-auto" role="alert">
            <span class="d-flex justify-content-between">
            <p class="m-0">
              Beach Advisory posted successfully!
            </p>
            <p class="m-0">
              <strong>
                <a href="https://becq.gov.mp/beach-advisory-results.html" target="_blank" class="text-decoration-none">Preview</a>
              </strong>
            </p>
            </span>
          </div>
        </div>';

        echo $result;

      } else {

        $result =
        '<div class="container">
          <div class="alert alert-danger w-75 mx-auto" role="alert">
            Beach Advisory failed to post! Please try again.
          </div>
        </div>';

        echo $result;

      }

    } else {

      // do nothing

    }

  }

  insertReport($params);

  function editReport($params)
  {

    if(isset($_POST['edit']))
    {

      $params['advisory']     = $_GET['advisory'];
      $params['title']        = $_POST['title'];
      $params['date']         = $_POST['date'];
      $params['status']       = $_POST['status'];
      $params['description']  = $_POST['description'];
      $locations              = array();
      $locations              = $_POST['loc'];
      $params['filter']       = array_filter($locations);
      $params['locations']    = implode(", ", $params['filter']);

      $clean                  = filterParams($params);

      switch ($params['status'])
      {

        case "RF":
          $params['status'] = "Red Flag";
          break;

        case "GF":
          $params['status'] = "Green Flag";
          break;

      }

      switch ($params['title'])
      {

        case "1":
          $params['title'] = "Saipan West Beaches Marine Water Quality Report";
          break;

        case "2":
          $params['title'] = "Saipan East Beaches Marine Water Quality Report";
          break;

        case "3":
          $params['title'] = "Tinian Marine Water Quality Report";
          break;

        case "4":
          $params['title'] = "Rota Marine Water Quality Report";
          break;

        case "5":
          $params['title'] = "Managaha Marine Water Quality Report";
          break;

      }

      switch (date('n', strtotime($params['date'])))
      {

        case 1:
          $params['monthID'] = "1";
          break;

        case 2:
          $params['monthID'] = "2";
          break;

        case 3:
          $params['monthID'] = "3";
          break;

        case 4:
          $params['monthID'] = "4";
          break;

        case 5:
          $params['monthID'] = "5";
          break;

        case 6:
          $params['monthID'] = "6";
          break;

        case 7:
          $params['monthID'] = "7";
          break;

        case 8:
          $params['monthID'] = "8";
          break;

        case 9:
          $params['monthID'] = "9";
          break;

        case 10:
          $params['monthID'] = "10";
          break;

        case 11:
          $params['monthID'] = "11";
          break;

        case 12:
          $params['monthID'] = "12";
          break;

      }

      $params['dba']['u'] =
      "UPDATE advisory SET
      advisoryTitle = :title,
      advisoryDate = :date,
      advisoryDesc = :desc,
      advisorySts = :status,
      advisoryLocations = :locations,
      monthID = :monthID
      WHERE id = :id";

      $params['bindParam'] = array(
        ':title'        => $params['title'],
        ':date'         => $params['date'],
        ':desc'         => $params['description'],
        ':status'       => $params['status'],
        ':locations'    => $clean['locations'],
        ':monthID'      => $params['monthID'],
        ':id'           => $params['advisory']
      );

      dbAccess($params);

      if($params['dba']['u'])
      {

        $result =
        '<div class="container">
          <div class="alert alert-success w-75 mx-auto" role="alert">
            <span class="d-flex justify-content-between">
              <p class="m-0">
                Beach Advisory updated successfully!
              </p>
              <p class="m-0">
                <strong>
                  <a href="https://becq.gov.mp/beach-advisory-results.html" target="_blank" class="text-decoration-none">Preview</a>
                </strong>
              </p>
            </span>
          </div>
        </div>';

        echo $result;

      } else {

        $result =
        '<div class="container">
          <div class="alert alert-danger w-75 mx-auto" role="alert">
            Beach Advisory failed to update! Please try again.
          </div>
        </div>';

        echo $result;

      }

    }

  }

  editReport($params);

  function deleteReport($params)
  {

    if(isset($_POST['delete']))
    {

      $params['id'] = $_POST['id'];
      $params['dba']['d'] = "DELETE FROM advisory WHERE id = :id"; // delete report base off of report id
      $params['bindParam'] = array(
        ':id' => $params['id']
      );

      dbAccess($params);

      if($params['dba']['d'])
      {

        $result =
        '<div class="container">
          <div class="alert alert-success w-75 mx-auto" role="alert">
            Beach Advisory deleted successfully!
          </div>
        </div>';

        echo $result;

      } else {

        $result =
        '<div class="container">
          <div class="alert alert-danger w-75 mx-auto" role="alert">
            Could not delete event! Please try again.
          </div>
        </div>';

        echo $result;

      }

    }

  }

  deleteReport($params);

  function deleteAll($params)
  {

    if(isset($_POST['deleteAll']))
    {

      $params['dba']['s']   = "SELECT * FROM advisory";
      $limit                = array(); // gather an array of numbers of reports to delete
      $limit                = $_POST['id'];

      dbAccess($params);

      if($params['dba']['s'])
      {

        // these will delete all reports from db
        $params['dba']['d'] = "DELETE FROM advisory ORDER by id ASC LIMIT ".$limit."";
        dbAccess($params);

        if($params['dba']['d'])
        {

          $result =
          '<div class="container">
            <div class="alert alert-success w-75 mx-auto" role="alert">
              Deleted All Beach Advisories successfully!
            </div>
          </div>';

          echo $result;

        }

      }

    }

  }

  deleteAll($params);

  function deleteSelected($params)
  {

    if(isset($_POST['deleteSelected']))
    {

      $params['advisoryID'] = $_POST['advisoryID'];

      // run foreach to delete the selected reports
      foreach ($params['advisoryID'] as $row)
      {

        $params['dba']['d'] = "DELETE FROM advisory WHERE id = :id";
        $params['bindParam'] = array(
          ':id' => $row
        );

        dbAccess($params);

      }

      if($params['dba']['d'])
      {

        $result =
        '<div class="container">
          <div class="alert alert-success w-75 mx-auto" role="alert">
            Deleted Beach Advisories successfully!
          </div>
        </div>';

        echo $result;

      }

    }

  }

  deleteSelected($params);

?>
