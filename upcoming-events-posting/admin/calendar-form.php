<?php

  error_reporting (E_ALL ^ E_NOTICE);
  error_reporting (E_ERROR | E_PARSE);
  date_default_timezone_set('Pacific/Saipan');

  function dbAccess($params)
  {

    try
    {

      $pdo = new PDO("mysql:host=localhost;dbname=github_projects", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

      // run foreach to prepare iterations of SQL queries with a variable of $params['dba']
      // and executes a $stmt->bindParam variable array
      foreach ($params['dba'] as $key => $value) { $stmt = $pdo->prepare($params['dba'][$key]); }
      $stmt->execute($params['bindParam']);

      // returning $stmt to be used when needing to fetch/fetchAll in SELECT queries
      return $stmt;

    } catch (PDOException $e) {

      echo "Connection failed: " . $e->getMessage();

    }

      return $params;

  }

  function filterParams($params)
  {

    $filters = array(
      "&" => "and"
    );

    // better efficiency by pre-calculating arrays
    // assign keys (array_keys()) and values (array_values()) to variables
    $amp = array_keys($filters);
    $and = array_values($filters);

    foreach ($params as $key => $value)
    {

      if ($key == 'user')
      {

        // $dirty to convert HTML tags to a string
        // $sanitize to remove HTML tags from string
        // $clean to remove whitespace
        $dirty[$key]    = html_entity_decode($value);
        $sanitize[$key] = strip_tags($dirty[$key]);
        $clean[$key]    = trim($sanitize[$key]);

      } elseif ($key == 'title') {

        // replace ampersand with "and" to avoid URL reading ampersand as second GET parameter
        $clean[$key]    = str_replace($amp, $and, $value);

      }

    }

    return $clean;

  }

  function logIn($params)
  {

    if (isset($_POST['login']))
    {

      $params['user'] = $_POST['user'];
      $clean          = filterParams($params);

      $params['password'] = trim($_POST['pass']); // remove whitespace from password

      $params['dba']['s'] = "SELECT * FROM events_users WHERE user = :user";
      $params['bindParam'] = array(
        ':user' => $clean['user']
      );
      $stmt = dbAccess($params);

      $results = $stmt->fetch(PDO::FETCH_ASSOC);

      // this will check if user exists in the db, if user has a reset password status of 1 or 2
      // and will verify if password is hashed/entered password is hashed
      // 1 = password reset | 2 = no password reset
      if($results['resetSts'] == 2 && $results['user'] == $clean['user'] && password_verify($params['password'], $results['pass']))
      {

        $_SESSION['user'] = $clean['user'];
        $_SESSION['pass'] = $params['password'];
        $_SESSION['id']   = $results['id'];

        header("Location: index.php");

      } elseif($results['resetSts'] == 1 && $results['user'] == $clean['user'] && !password_verify($params['password'], $results['pass'])) {

        $_SESSION['user'] = $clean['user'];
        $_SESSION['pass'] = $params['password'];
        $_SESSION['id']   = $results['id'];

        header("Location: reset.php");

      }

    } else {

      // do nothing

    }

  }

  logIn($params);

  function createEvent($params)
  {

    if (isset($_POST['submit']))
    {

      $params['title']        = $_POST['title'];
      $clean                  = filterParams($params);

      $params['description']  = $_POST['description'];
      $params['start_date']   = $_POST['start_date'];
      $params['end_date']     = $_POST['end_date'];
      $params['all_day']      = $_POST['all_day'];
      $params['color']        = $_POST['color'];
      $params['tags']         = preg_replace("/(?<!\d)(\,|\.)(?!\d)/", "", $_POST['tags']); // remove commas from the array

      $params['category']     = array();
      $params['category']     = $_POST['category'];
      $category               = implode(", ", $params['category']); // add commas into the array to enforce $category to be read as string

      // column type is a tinyint(1) = boolean
      // 1 = true | 0 = false
      if (empty($params['all_day'])) { $params['all_day'] = '0'; }

      $params['dba']['i'] =
      "INSERT INTO events
      (eventTitle,
      eventDesc,
      startDate,
      endDate,
      allDay,
      eventColor,
      eventTags,
      eventCategory)
      VALUES
      (:title,
      :description,
      :start_date,
      :end_date,
      :all_day,
      :color,
      :tags,
      '$category')";

      // bind params in SQL query
      $params['bindParam'] = array(
        ':title'        => $clean['title'],
        ':description'  => $params['description'],
        ':start_date'   => $params['start_date'],
        ':end_date'     => $params['end_date'],
        ':all_day'      => $params['all_day'],
        ':color'        => $params['color'],
        ':tags'         => $params['tags']
      );

      dbAccess($params);

      // check if the SQL query has been executed
      if ($params['dba']['i'])
      {

        //echo message if results are true
        $display = '<div id="result" class="container mx-auto d-flex justify-content-between align-items-center alert alert-success mt-2" role="alert">
                      <p class="m-0">Event created successfully!</p>
                      <strong>
                        <a href="../calendar.php" target="_blank">View Calendar</a>
                      </strong>
                    </div';

        echo $display;

      } else {

        // do nothing

      }

    }

  }

  createEvent($params);

  function editEvent($params)
  {

    if (isset($_POST['edit']))
    {

      if (!isset($_GET['event']))
      {

        // this will check if the event parameter exists
        // if false, do nothing

      } else {

        $params['title']       = $_POST['title'];
        $clean                 = filterParams($params);

        $params['description'] = $_POST['description'];
        $params['start_date']  = $_POST['start_date'];
        $params['end_date']    = $_POST['end_date'];
        $params['all_day']     = $_POST['all_day'];
        $params['color']       = $_POST['color'];
        $params['tags']        = $_POST['tags'];
        $params['tags']        = preg_replace("/(?<!\d)(\,|\.)(?!\d)/", "", $params['tags']);

        $params['category']    = array();
        $params['category']    = $_POST['category'];
        $category              = implode(", ", $params['category']);
        $params['id']          = $_GET['event'];

        $params['dba']['u'] = "UPDATE events SET eventTitle = :title, eventDesc = :description, startDate = :start_date, endDate = :end_date, allDay = :all_day, eventColor = :color, eventTags = :tags, eventCategory = '$category' WHERE id = :id";

        $params['bindParam'] = array(
          ':title'        => $clean['title'],
          ':description'  => $params['description'],
          ':start_date'   => $params['start_date'],
          ':end_date'     => $params['end_date'],
          ':all_day'      => $params['all_day'],
          ':color'        => $params['color'],
          ':tags'         => $params['tags'],
          ':id'           => $params['id']
        );

        dbAccess($params);

        if ($params['dba']['u'])
        {

          //echo message if results are true
          $display =
          '<div id="result" class="alert alert-success mt-2 d-flex justify-content-between w-75 container" role="alert">
            Changes made successfully!
			      <strong><a href="../event.php?id='.$params['id'].'&title='.$params['title'].'" target="_blank">View Event</a></strong>
          </div>';

          echo $display;

        } else {

          header("Location: manage-events.php?edit=false");

        }

      }

    }

  }

  editEvent($params);

  // display events in manage
  function getEvents($params)
  {

    $params['dba']['s'] = "SELECT * FROM events ORDER by startDate";
    $stmt = dbAccess($params);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;

  }

  // display events in index
  function getEvent($params)
  {

    $params['dba']['s'] = "SELECT * FROM events WHERE startDate >= CURDATE() ORDER by startDate LIMIT 4";
    $stmt = dbAccess($params);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;

  }

  function logOut()
  {

    if (isset($_POST['logout'])) {

      session_start();
      session_destroy();

      header("Location: login.php");

    }

  }

  logOut();

    // function getUsers($params)
    // {

    //     $params['sql'] = "SELECT * FROM events_users";
    //     $stmt = dbAccess($params);

    //     $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //     return $results;

    // }

// function resetPass($pdo, $params)
// {

//     try {

//         if (isset($_POST['confirm'])) {

//             $params['password'] = trim($_POST['pass']);
//             $params['pO']       = trim($_POST['passOld']);
//             $params['pN']       = trim($_POST['passNew']);
//             $params['pC']       = trim($_POST['passConfirm']);

//             $params['dba']['s'] = "SELECT * FROM events_users";
//             $stmt               = $pdo->prepare($params['dba']['s']);
//             $stmt->execute();
//             $results = $stmt->fetch(PDO::FETCH_ASSOC);

//             $params['pMnm'] = 6;

//             if (strlen($params['pC']) < $params['pMnm']) {

//                 header("Location: reset.php?pwReset=false");

//             } else {

//                 if ($results['pass'] === $params['pO'] && $params['pN'] === $params['pC']) {

//                     $params['pH']   = trim(password_hash($params['pC'], PASSWORD_BCRYPT));
//                     $_SESSION['id'] = $results['id'];

//                     $params['dba']['u'] = "UPDATE events_users SET pass = :pass WHERE id = :id";
//                     $stmt               = $pdo->prepare($params['dba']['u']);
//                     $stmt->bindParam(':pass', $params['pH']);
//                     $stmt->bindParam(':id', $_SESSION['id']);
//                     $stmt->execute();

//                     if ($params['dba']['u']) {

//                         $params['dba']['u'] = "UPDATE events_users SET resetSts = '2' WHERE id = :id";
//                         $stmt               = $pdo->prepare($params['dba']['u']);
//                         $stmt->bindParam(':id', $_SESSION['id']);
//                         $stmt->execute();

//                         if ($params['dba']['u']) {
//                             $key = 'e1613246c0a361340b1f64f4ab3bf0bd06de8704f29e6acb4c';
//                             header("Location: index.php?pwReset=$key");
//                         } else {

//                             header("Location: index.php?pwReset=false");
//                         }
//                     }
//                 }
//             }
//         }

//         return $params;

//     } catch (PDOException $e) {

//         echo "Connection failed: " . $e->getMessage();
//     }
// }

// resetPass($pdo, $params);

if (isset($_GET['submit']) && ($_GET['submit']) == 'false') {

    //echo message if results are false
    $display = '<div id="result" class="alert alert-danger mt-2" role="alert">
                    Failed to create event! Please try again.
                </div';
}

//if user edits and it has an edit key, announce true
$key = '4c4a8b8022a6e127f4b8ee98e8ef4c41350dd785fb568c2ce6';
if (isset($_GET['edit']) && ($_GET['edit']) == $key) {

    //echo message if results are true
    $display = '<div id="result" class="alert alert-success mt-2" role="alert">
                    Changes made successfully!
                </div>';
}

if (isset($_GET['edit']) && ($_GET['edit']) == 'false') {

    //echo message if results are false
    $display = '<div id="result" class="alert alert-danger mt-2" role="alert">
            Failed to save changes! Please try again.
        </div>';

    $params['calendar'] =
        '<form action="" method="POST" id="calendarPost" class="mt-3">
    <div class="form-floating mb-3">
      <input type="text" name="title" class="form-control" id="textarea" placeholder="Title of Event" maxlength="50">
      <label for="floatingInput">Title of Event</label>
      <small><i><div class="mt-1" id="textarea_feedback"></div></i></small>
    </div>
    <div class="mb-3">
      <div class="alert alert-info" role="alert">
        Select <strong><i>the box</i></strong> below if the event is an all-day event:
      </div>
    </div>
    <div class="form-check form-check-inline mb-3">
      <input class="form-check-input" type="checkbox" id="allDayT" name="all_day" value="1">
      <label class="form-check-label" for="inlineCheckbox1">All Day</label>
    </div>
    <div id="defaultDate">
      <div class="row">
        <div class="col-lg-6">
          <div class="form-floating mb-3">
            <input type="datetime-local" name="start_date" id="defaultStart" class="form-control" placeholder="">
            <label for="floatingInput">Event (Start)</label>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-floating mb-3">
            <input type="datetime-local" name="end_date" id="defaultEnd" class="form-control" placeholder="">
            <label for="floatingInput">Event (End)</label>
          </div>
        </div>
      </div>
    </div>
    <div id="allDayDate" style="display: none;">
      <div class="row">
        <div class="col-lg-6">
          <div class="form-floating mb-3">
            <input type="date" name="start_date" id="allDayStart" class="form-control" placeholder="" disabled required>
            <label for="floatingInput">Event (Start)</label>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-floating mb-3">
            <input type="date" name="end_date" class="form-control" id="allDayEnd" placeholder="" disabled required>
            <label for="floatingInput">Event (End)</label>
          </div>
        </div>
      </div>
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea class="form-control" id="area1" name="description"></textarea>
    </div>
    <div class="d-flex align-items-center mb-3">
      <input type="color" class="form-control form-control-color me-2" id="inputColor" name="color" value="" title="Set a color for the event" required>
      <label for="" class="form-label m-0">Set a color for the event</label>
    </div>
    <div class="mb-3">
      <div class="alert alert-info" role="alert">
        Select <strong><i>the category</i></strong> that applies:
      </div>
    </div>
    <div class="mb-3 d-flex justify-content-between">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="Agency Training" name="category[]" id="">
            <label class="form-check-label" for="defaultCheck1">
                Agency Training
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="BE Taskforce" name="category[]" id="">
            <label class="form-check-label" for="defaultCheck1">
                BE Taskforce
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="Community Event" name="category[]" id="">
            <label class="form-check-label" for="defaultCheck1">
                Community Event
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="NR Taskforce" name="category[]" id="">
            <label class="form-check-label" for="defaultCheck1">
                NR Taskforce
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="PDAC" name="category[]" id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">
                PDAC
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="Public Meeting" name="category[]" id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">
                Public Meeting
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="Public Notice" name="category[]" id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">
                Public Notice
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="SE/DRR Taskforce" name="category[]" id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">
                SE/DRR Taskforce
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="Webinar" name="category[]" id="defaultCheck1">
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

<input type="text" class="form-control" id="" name="tags" placeholder="Separate tags with commas: ex. opd, pdac, complete streets...">
            </td>
        </tbody>
    </table>
    </div>
    <button type="submit" name="submit" id="eventSubmit" class="btn btn-primary">Submit</button>
  </form>';
}

//if user password has reset and it has a reset key, announce true
$key = 'e1613246c0a361340b1f64f4ab3bf0bd06de8704f29e6acb4c';
if (isset($_GET['pwReset']) && ($_GET['pwReset']) == $key) {

    //echo message if results are true
    $display = '<div id="result" class="alert alert-success mt-2" role="alert">
                    Password changed successfully! You may now login.
                </div>';
}

if (isset($_GET['pwReset']) && ($_GET['pwReset']) == 'false') {

    //echo message if results are false
    $display = '<div id="result" class="alert alert-danger mt-2" role="alert">
                Failed to change password! Please try again.
            </div>';
}

// generate keys
// $a = random_bytes(25);
// $asd = bin2hex($a);
// echo $asd;

// $date1 = "2022-03-13";
// $date2 = "2022-03-26";

// $diff = abs(strtotime($date2) - strtotime($date1));

// $years = floor($diff / (365*60*60*24));
// $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
// $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

// printf("%d years, %d months, %d days\n", $years, $months, $days);

// function asd($pdo, $params)
// {

//     $sql = "SELECT * FROM payperiod";
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute();
//     $results = $stmt->fetch(PDO::FETCH_ASSOC);

//     $date = ("2022-03-26");

//     if($results['ppEnd'] == $date)
//     {

//         $sql = "UPDATE payperiod SET ppStart = DATE_ADD(ppEnd, INTERVAL 1 DAY), ppEnd = DATE_ADD(ppEnd, INTERVAL 14 DAY) WHERE id = 1";
//         $stmt = $pdo->prepare($sql);
//         $stmt->execute();

//         if($sql)
//         {

//             echo 'cool';

//         }

//     }

// }

// asd($pdo, $params);
