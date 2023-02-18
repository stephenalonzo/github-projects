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
    <title>Create a Calendar Event - OPD CMS</title>
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
</head>

<body>
    <div class="container d-block m-auto justify-content-center align-items-center">
        <?php if ($_SESSION['user'] === 'opd-admin') { ?>
        <?php echo $display; ?>
        <form action="" enctype="multipart/form-data" name="form" method="POST" id="calendarPost" class="mt-3">

            <div class="form-floating mb-3">
                <input type="text" name="title" class="form-control" id="textarea" placeholder="Title of Event"
                    maxlength="60" required>
                <label for="floatingInput">Title of Event</label>
                <small><i>
                        <div class="mt-1" id="textarea_feedback"></div>
                    </i></small>
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
                            <input type="datetime-local" name="start_date" id="defaultStart" class="form-control"
                                placeholder="" required>
                            <label for="floatingInput">Event (Start)</label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-floating mb-3">
                            <input type="datetime-local" name="end_date" id="defaultEnd" class="form-control"
                                placeholder="" required>
                            <label for="floatingInput">Event (End)</label>
                        </div>
                    </div>
                </div>
            </div>

            <div id="allDayDate" style="display: none;">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-floating mb-3">
                            <input type="date" name="start_date" id="allDayStart" class="form-control" placeholder=""
                                disabled required>
                            <label for="floatingInput">Event (Start)</label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-floating mb-3">
                            <input type="date" name="end_date" class="form-control" id="allDayEnd" placeholder=""
                                disabled required>
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
                <input type="color" class="form-control form-control-color me-2" id="inputColor" name="color" value=""
                    title="Set a color for the event" required>
                <label for="" class="form-label m-0">Give the event a color</label>
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
                    <input class="form-check-input" type="checkbox" value="Public Meeting" name="category[]"
                        id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Public Meeting
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Public Notice" name="category[]"
                        id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Public Notice
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="SE/DRR Taskforce" name="category[]"
                        id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        SE/DRR Taskforce
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Webinar" name="category[]"
                        id="defaultCheck1">
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
                            <input type="text" class="form-control" id="" name="tags"
                                placeholder="Separate tags with commas: ex. opd, pdac, complete streets...">
                        </td>
                    </tbody>
                </table>
            </div>

            <input type="submit" name="submit" id="eventSubmit" value="Submit" class="btn btn-primary" />

        </form>
        <?php } ?>
    </div>

    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/nicEdit-latest.js"></script>
    <script src="./js/nicEdit-component.js"></script>
</body>

</html>
