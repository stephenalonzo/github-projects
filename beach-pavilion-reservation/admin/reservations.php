<?php

require_once('./header.php');
require_once('./authentication.php');
require_once('../controller.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex">
  <title>Facility Reservations Calendar</title>

  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

  <link rel="stylesheet" href="../dist/fullcalendar.css">

  <link rel="stylesheet" href="../font-awesome/css/all.min.css">
  <link rel="stylesheet" href="../dist/inter.css">
  <link rel="stylesheet" href="../dist/output.css">
  <script src="../js/jquery-3.6.0.min.js"></script>
  <script src="../dist/jquery.min-cal.js"></script>
  <script src="../dist/jquery-ui.min.js"></script>
  <script src="../dist/moment.min.js"></script>
  <script src="../dist/fullcalendar.min.js"></script>
  <script src="../dist/app.js"></script>
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

<body>
  <main class="page-container">
    <div class="page-wrapper">
      <section class="calendar px-4 py-6">
        <div class="container mx-auto xl:max-w-screen-xl">
          <div class="grid grid-flow-row gap-4 xl:grid-cols-5">
            <div class="filter space-y-4 xl:sticky xl:top-4">
              <div class="pavilion">
                <form class="border border-gray-200 lg:border-t-0">
                  <fieldset>
                    <legend class="block w-full px-4 py-2 text-xs font-medium bg-gray-50">
                      Status
                    </legend>
                    <div class="px-4 py-2 space-y-2">
                      <div class="top-row grid grid-cols-2 items-center lg:grid-cols-1 lg:grid-flow-row lg:gap-2">
                        <div class="flex items-center space-x-3">
                          <input id="reserved" class="event_filter_box" name="event_filter_select" type="checkbox" value="RESERVED" data-type="status">
                          <label class="text-sm sm:text-base" for="reserved">Reserved</label>
                        </div>
                        <div class="flex items-center space-x-3">
                          <input id="pending" class="event_filter_box" name="event_filter_select" type="checkbox" value="PENDING" data-type="status">
                          <label class="text-sm sm:text-base" for="pending">Pending</label>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                </form>
              </div>
              <div class="location">
                <form class="border border-gray-200 h-96 overflow-scroll lg:border-t-0">
                  <fieldset>
                    <legend class="block w-full px-4 py-2 text-xs font-medium bg-gray-50">
                      Location
                    </legend>
                    <div class="px-4 py-2 space-y-2" id="">
                      <div class="top-row grid grid-cols-1 items-center mdOnly:grid-cols-2 lg:grid-cols-1 lg:grid-flow-row lg:gap-2">

                        <?php

                        $results = getLocations($params);

                        foreach ($results as $row) {

                        ?>

                          <div class="flex items-center space-x-3">
                            <input id="loc-<?php echo $row['id']; ?>" class="event_filter_box" name="event_filter_select" type="checkbox" value="<?php echo $row['locName']; ?>" data-type="pavilion">
                            <label class="text-sm sm:text-base" for="loc-<?php echo $row['id']; ?>">
                              <?php echo $row['locName']; ?>
                            </label>
                          </div>

                        <?php } ?>

                      </div>
                    </div>
                  </fieldset>
                </form>
              </div>
              <hr>
              <form action="" method="POST" class="space-y-4">
                <h2 class="font-bold">Manual Reservation</h2>
                <div class="input-group flex flex-col">
                  <label for="pavSelect" class="font-medium">Location</label>
                  <div class="wrapper relative">
                  <select name="pavilion" id="pavSelect" class="border border-gray-200 rounded-md overflow-scroll p-2 w-full" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();' required>
                    <option value="" selected disabled>Choose Location</option>
                    <option value="1">Afetna Beach Park</option>
                    <option value="2">San Isidro Beach Park Pavilion #1</option>
                    <option value="3">San Isidro Beach Park Pavilion #2</option>
                    <option value="4">San Isidro Beach Park Pavilion #3</option>
                    <option value="5">San Isidro Beach Park Pavilion #4</option>
                    <option value="6">San Isidro Beach Park Pavilion #5</option>
                    <option value="7">Susupe Regional Beach Park</option>
                    <option value="8">Civic Center Beach Park</option>
                    <option value="9">Kilili Beach Park Pavilion #1</option>
                    <option value="10">Kilili Beach Park Pavilion #2</option>
                    <option value="11">Kilili Beach Park Pavilion #3</option>
                    <option value="12">Garapan Shoreline Beach</option>
                    <option value="13">Lower Base Beach</option>
                    <option value="14">Tanapag Beach Park</option>
                    <option value="15">Paupau Beach Park</option>
                    <option value="16">Marine Beach Park</option>
                    <option value="17">Laulau Dive Site</option>
                    <option value="18">Ladder Beach</option>
                    <option value="19">Obyan Beach</option>
                    <option value="20">Makaka Beach</option>
                    <option value="21">San Antonio Youth Center</option>
                    <option value="22">Garapan Central Park</option>
                    <option value="23">Capitol Hill Open Ground</option>
                    <option value="24">Kagman Homestead Park</option>
                    <option value="25">Dandan Homestead Park</option>
                    <option value="26">Koblerville Softball Field</option>
                    <option value="27">Koblerville Basketball Court and Open Grounds</option>
                    <option value="28">San Antonio Basketball Court</option>
                    <option value="29">Chalan Kanoa District #1 Basketball Court</option>
                    <option value="30">Chalan Kanoa District #3 Basketball Court</option>
                    <option value="31">Susupe District #5 Basketball Court</option>
                    <option value="32">Joaquin S. Tudela Memorial Park</option>
                    <option value="33">Gualo Rai Basketball Court</option>
                    <option value="34">China Town Basketball Court</option>
                    <option value="35">Navy Hill Open Field</option>
                    <option value="36">Tanapag Basketball Court</option>
                    <option value="37">Capitol Hill Basketball and Tennis Court</option>
                    <option value="38">Kagman Basketball Court</option>
                    <option value="39">Dandan Basketball Court</option>
                    <option value="40">San Roque Basketball Court</option>
                    <option value="41">As Matuis Basketball Court</option>
                    <option value="42">Minachom Atdao</option>
                    <option value="43">Korean Peace Memorial</option>
                    <option value="44">Okinawa Peace Memorial</option>
                    <option value="45">Last Command Post</option>
                    <option value="46">Japanese Peace Memorial</option>
                    <option value="47">Banzai Cliff Lookout</option>
                    <option value="48">Grotto Dive Site</option>
                    <option value="49">Bird Island Lookout</option>
                    <option value="50">Kalabera Cave</option>
                    <option value="51">Suicide Cliff Lookout</option>
                    <option value="52">Japanese Jail</option>
                    <option value="53">Susupe Peace Memorial</option>
                    <option value="54">San Jose Memorial</option>
                    <option value="55">Marpi Road Shoulder</option>
                  </select>
                  </div>
                </div>
                <div class="input-group flex flex-row items-center space-x-3">
                  <input type="checkbox" name="multiDay" value="1" id="multiDay">
                  <label for="checkThis" class="text-sm">Multi-day Reservation</label>
                </div>
                <div class="input-group flex flex-col space-y-3" id="dateSetOne">
                  <p class="font-medium">Date of Reservation</p>
                  <div class="flex flex-col">
                    <input type="date" name="resStart" id="resStartAD" class="border border-gray-200 rounded-md p-2" required>
                  </div>
                </div>
                <div class="input-group flex flex-col space-y-3" id="dateSetTwo" style="display: none;">
                  <p class="font-medium">Date of Reservation</p>
                  <div class="flex flex-col">
                    <label for="resStart" class="text-sm text-gray-400">From</label>
                    <input type="date" name="resStart" id="resStart" class="border border-gray-200 rounded-md p-2">
                  </div>
                  <div class="flex flex-col">
                    <label for="resEnd" class="text-sm text-gray-400">To</label>
                    <input type="date" name="resEnd" id="resEndCal" class="border border-gray-200 rounded-md p-2">
                  </div>
                </div>
                <!--Footer-->
                <div class="flex justify-start pt-2">
                  <button type="submit" name="manualReservation" class="px-4 py-2 rounded-md font-medium text-white bg-blue-600 border-2 border-blue-600 hover:bg-white hover:text-blue-600 duration-200">Submit</button>
                </div>
              </form>
              <?php echo $params['alertMsg']; ?>
            </div>
            <div id="calendar" class="h-screen xl:col-span-4"></div>
          </div>
        </div>
      </section>
      <div class="relative">
        <button type="button" class="bg-dlnrpurple-1 py-4 px-6 fixed bottom-8 right-6 drop-shadow-md z-50 scrollToTopBtn" id="scrollToTop">
          <i class="fas fa-arrow-to-top text-white text-xl"></i>
        </button>
      </div>
    </div>
    <div class="footer-load sticky-footer"></div>
  </main>

  <script src="../js/main.js"></script>
</body>

</html>