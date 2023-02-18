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
    <script src="./js/jquery.min.js"></script>
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
        if (typeof window.history.pushState == 'function') {
            window.history.pushState({}, "Hide", "manage-events.php");
        }
    </script>
</head>

<body>
    <div class="container d-block m-auto justify-content-center align-items-center">
        <div class="content">
            <div class="wrapper">
                <?php echo $display; ?>
                <table class="table mx-auto">
                    <tr>
			                  <th>ID</th>
                        <th>Title</th>
                        <th>Event Start</th>
                        <th>Event End</th>
                        <th>All Day</th>
                        <th>Actions</th>
                    </tr>

                    <?php $results = getEvents($params);

                    foreach ($results as $row)
                    {

                    ?>

                        <tr>
		                      <td>
				                    <?php echo $row['id']; ?>
		                      </td>
                          <td>
                            <?php echo $row['eventTitle']; ?>
                          </td>
                          <td>
                            <?php

                            if (empty($row['allDay']))
                            {

                              echo date('m/d/Y h:i A', strtotime($row['startDate']));

                            } else {

                              echo date('m/d/Y', strtotime($row['startDate']));

                            }

                            ?>
                          </td>
                          <td>
                            <?php

                            if (empty($row['allDay']))
                            {

                              echo date('m/d/Y h:i A', strtotime($row['endDate']));

                            } else {

                                echo date('m/d/Y', strtotime($row['endDate']));

                            }

                            ?>
                          </td>
                          <td>
                            <?php

                            if ($row['allDay'] == '0' || $row['allDay'] == NULL )
                            {

                              echo 'NO';

                            } else {

                              echo 'YES';

                            }

                            ?>
                          </td>
                          <td>
                            <span class="d-flex">
                              <a href="./edit.php?event=<?php echo $row['id'] ?>&title=<?php echo $row['eventTitle'] ?>" class="btn btn-warning me-2">Edit</a>
                              <a onclick="return confirm('Are you sure you want to delete this event?')" ; href="./delete.php?event=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
                            </span>
                          </td>
                        </tr>

                    <?php } ?>

                </table>
            </div>
            <?php require_once './footer.php'; ?>
        </div>
    </div>

    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/nicEdit-latest.js"></script>
    <script src="./js/nicEdit-component.js"></script>
</body>

</html>
