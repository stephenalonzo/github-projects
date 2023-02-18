<?php require_once ('./controller.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Facility Reservations - Division of Parks and Recreation | Department of Lands and Natural Resources</title>

  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

  <link rel="stylesheet" href="./font-awesome/css/all.min.css">
  <link rel="stylesheet" href="./dist/inter.css">
  <link rel="stylesheet" href="./dist/output.css">
  <script src="./js/scrollToTop.js"></script>
  <script src="./js/jquery-3.6.0.min.js"></script>
  <script src="./js/qrcode.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="./js/qrcode.js" defer></script>
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
  <h1 class="text-white text-xl md:text-3xl xl:text-5xl bg-black/70 fixed right-0">
  </h1>
  <script>
    function showBrowserWidth() {
      const width =
        window.innerWidth ||
        document.documentElement.clientWidth ||
        document.body.clientWidth
      document.querySelector('h1').innerHTML = `Width: ${width}`
    }
    window.onload = showBrowserWidth
    window.onresize = showBrowserWidth
  </script>

  <main class="page-container">
    <div class="page-wrapper">
      <!-- hero -->
      <section class="hero">
        <header>
          <div class="nav-load"></div>
        </header>
        <div class="container flex flex-col pt-10 pb-20 px-6 mx-auto space-y-0 text-white">
          <div class="flex flex-col items-center justify-center text-center w-full md:mx-auto lg:mx-auto lg:w-3/4 xl:w-2/3 xxl:w-1/2">
            <div class="hero-txt">
              <p class="mt-3 font-light uppercase">Division of Parks and Recreation</p>
              <h1 class="font-bold text-3xl uppercase lg:text-4xl">Facility Reservations</h1>
            </div>
          </div>
        </div>
      </section>
      <!-- form -->
      
      <section class="reservation-form px-4 py-6">
        <div class="container mx-auto gap-4 space-y-2 md:max-w-screen-sm">
          <?php if (!$params['result']) { ?>
            <form method="POST" class="space-y-4">
            <div class="grid grid-flow-row gap-4">
              <div class="input-group flex flex-col">
                <label for="name" class="font-medium">Full Name</label>

                <?php if (isset($_POST['name']) && isset($_POST['reserveFacility']) && $params['rowCount'] >= 0 || isset($_POST['name']) && isset($_POST['reserveFacility']) && $params['rowCount'] <= 0) { ?>

                  <input type="text" name="name" id="name" class="border-2 border-green-500 rounded-md p-2" required value="<?php echo $params['name']; ?>">

                <?php } else { ?>

                  <input type="text" name="name" id="name" class="border border-gray-200 rounded-md p-2" required>

                <?php } ?>

              </div>
              <div class="input-group flex flex-col">
                <label for="email" class="font-medium">Email Address</label>

                <?php if (isset($_POST['email']) && isset($_POST['reserveFacility']) && $params['rowCount'] >= 0 || isset($_POST['email']) && isset($_POST['reserveFacility']) && $params['rowCount'] <= 0) { ?>

                  <input type="email" name="email" id="email" class="border-2 border-green-500 rounded-md p-2" required value="<?php echo $params['email']; ?>">

                <?php } else { ?>

                  <input type="email" name="email" id="email" class="border border-gray-200 rounded-md p-2" required>

                <?php } ?>

              </div>
              <div class="input-group flex flex-col">
                <label for="pavSelect" class="font-medium">Location</label>
                <div class="wrapper">
                  <?php if (isset($_POST['pavilion']) && isset($_POST['reserveFacility']) && $params['rowCount'] >= 0 || isset($_POST['pavilion']) && isset($_POST['reserveFacility']) && $params['rowCount'] <= 0) { ?>
                  <select name="pavilion" id="pavSelect" class="border border-gray-200 rounded-md overflow-scroll p-2 w-full" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();' required>
                    <option value="" selected disabled>Choose Location</option>
                    <option value="1" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 1) { echo 'selected'; } ?>>Afetna Beach Park</option>
                    <option value="2" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 2) { echo 'selected'; } ?>>San Isidro Beach Park Pavilion #1</option>
                    <option value="3" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 3) { echo 'selected'; } ?>>San Isidro Beach Park Pavilion #2</option>
                    <option value="4" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 4) { echo 'selected'; } ?>>San Isidro Beach Park Pavilion #3</option>
                    <option value="5" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 5) { echo 'selected'; } ?>>San Isidro Beach Park Pavilion #4</option>
                    <option value="6" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 6) { echo 'selected'; } ?>>San Isidro Beach Park Pavilion #5</option>
                    <option value="7" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 7) { echo 'selected'; } ?>>Susupe Regional Beach Park</option>
                    <option value="8" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 8) { echo 'selected'; } ?>>Civic Center Beach Park</option>
                    <option value="9" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 9) { echo 'selected'; } ?>>Kilili Beach Park Pavilion #1</option>
                    <option value="10" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 10) { echo 'selected'; } ?>>Kilili Beach Park Pavilion #2</option>
                    <option value="11" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 11) { echo 'selected'; } ?>>Kilili Beach Park Pavilion #3</option>
                    <option value="12" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 12) { echo 'selected'; } ?>>Garapan Shoreline Beach</option>
                    <option value="13" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 13) { echo 'selected'; } ?>>Lower Base Beach</option>
                    <option value="14" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 14) { echo 'selected'; } ?>>Tanapag Beach Park</option>
                    <option value="15" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 15) { echo 'selected'; } ?>>Paupau Beach Park</option>
                    <option value="16" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 16) { echo 'selected'; } ?>>Marine Beach Park</option>
                    <option value="17" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 17) { echo 'selected'; } ?>>Laulau Dive Site</option>
                    <option value="18" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 18) { echo 'selected'; } ?>>Ladder Beach</option>
                    <option value="19" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 19) { echo 'selected'; } ?>>Obyan Beach</option>
                    <option value="20" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 20) { echo 'selected'; } ?>>Makaka Beach</option>
                    <option value="21" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 21) { echo 'selected'; } ?>>San Antonio Youth Center</option>
                    <option value="22" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 22) { echo 'selected'; } ?>>Garapan Central Park</option>
                    <option value="23" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 23) { echo 'selected'; } ?>>Capitol Hill Open Ground</option>
                    <option value="24" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 24) { echo 'selected'; } ?>>Kagman Homestead Park</option>
                    <option value="25" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 25) { echo 'selected'; } ?>>Dandan Homestead Park</option>
                    <option value="26" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 26) { echo 'selected'; } ?>>Koblerville Softball Field</option>
                    <option value="27" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 27) { echo 'selected'; } ?>>Koblerville Basketball Court and Open Grounds</option>
                    <option value="28" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 28) { echo 'selected'; } ?>>San Antonio Basketball Court</option>
                    <option value="29" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 29) { echo 'selected'; } ?>>Chalan Kanoa District #1 Basketball Court</option>
                    <option value="30" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 30) { echo 'selected'; } ?>>Chalan Kanoa District #3 Basketball Court</option>
                    <option value="31" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 31) { echo 'selected'; } ?>>Susupe District #5 Basketball Court</option>
                    <option value="32" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 32) { echo 'selected'; } ?>>Joaquin S. Tudela Memorial Park</option>
                    <option value="33" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 33) { echo 'selected'; } ?>>Gualo Rai Basketball Court</option>
                    <option value="34" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 34) { echo 'selected'; } ?>>China Town Basketball Court</option>
                    <option value="35" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 35) { echo 'selected'; } ?>>Navy Hill Open Field</option>
                    <option value="36" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 36) { echo 'selected'; } ?>>Tanapag Basketball Court</option>
                    <option value="37" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 37) { echo 'selected'; } ?>>Capitol Hill Basketball and Tennis Court</option>
                    <option value="38" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 38) { echo 'selected'; } ?>>Kagman Basketball Court</option>
                    <option value="39" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 39) { echo 'selected'; } ?>>Dandan Basketball Court</option>
                    <option value="40" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 40) { echo 'selected'; } ?>>San Roque Basketball Court</option>
                    <option value="41" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 41) { echo 'selected'; } ?>>As Matuis Basketball Court</option>
                    <option value="42" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 42) { echo 'selected'; } ?>>Minachom Atdao</option>
                    <option value="43" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 43) { echo 'selected'; } ?>>Korean Peace Memorial</option>
                    <option value="44" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 44) { echo 'selected'; } ?>>Okinawa Peace Memorial</option>
                    <option value="45" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 45) { echo 'selected'; } ?>>Last Command Post</option>
                    <option value="46" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 46) { echo 'selected'; } ?>>Japanese Peace Memorial</option>
                    <option value="47" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 47) { echo 'selected'; } ?>>Banzai Cliff Lookout</option>
                    <option value="48" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 48) { echo 'selected'; } ?>>Grotto Dive Site</option>
                    <option value="49" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 49) { echo 'selected'; } ?>>Bird Island Lookout</option>
                    <option value="50" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 50) { echo 'selected'; } ?>>Kalabera Cave</option>
                    <option value="51" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 51) { echo 'selected'; } ?>>Suicide Cliff Lookout</option>
                    <option value="52" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 52) { echo 'selected'; } ?>>Japanese Jail</option>
                    <option value="53" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 53) { echo 'selected'; } ?>>Susupe Peace Memorial</option>
                    <option value="54" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 54) { echo 'selected'; } ?>>San Jose Memorial</option>
                    <option value="55" <?php if (isset($_POST['pavilion']) && $_POST['pavilion'] == 55) { echo 'selected'; } ?>>Marpi Road Shoulder</option>
                  </select>
                  <?php } else { ?>
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
                  <?php } ?>
                </div>
              </div>
              <div class="input-group flex flex-col">
                <label for="resStart" class="font-medium">Date of Reservation</label>
                <div class="flex flex-row items-center space-x-3">
                  <input type="date" name="resStart" id="resStart" class="border border-gray-200 rounded-md p-2 w-full <?php if (isset($_POST['resStart']) && isset($_POST['reserveFacility']) && $params['rowCount'] >= 0 || isset($_POST['resStart']) && isset($_POST['reserveFacility']) && $params['rowCount'] <= 0) { echo 'border-2 border-red-500'; } ?>">
                  <input type="date" name="resEnd" id="resEnd" class="border border-gray-200 rounded-md p-2 w-full <?php if (isset($_POST['resEnd']) && isset($_POST['reserveFacility']) && $params['rowCount'] >= 0 || isset($_POST['resEnd']) && isset($_POST['reserveFacility']) && $params['rowCount'] <= 0) { echo 'border-2 border-red-500'; } ?>">
                </div>
              </div>
              <div class="input-group">
                <div class="p-4 flex flex-col space-y-2 text-sm text-gray-700 bg-gray-100 rounded-lg" role="alert">
                  <div class="input-group-header flex flex-row items-center space-x-1">
                    <p class="text-base font-bold">Terms and Conditions</p>
                  </div>
                  <div class="item space-x-2 text-justify">
                    <input type="checkbox" name="agreement" id="agreement" value="1" required>
                    <label for="agreement">
                      By checking this box, <i>I understand</i> that this does not confirm my reservation and in order to secure my reservation, I must make payment and provide DLNR - Parks & Recreation a copy of my email receipt within [x] days. Otherwise, I must submit a reservation again.
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="flex flex-row items-center space-x-2">
              <button type="submit" name="reserveFacility" id="reserveFacility" disabled>Submit</button>
            </div>
            <hr>
            <p class="font-medium text-sm text-dfw-blue-main mt-3 w-72 hover:underline hover:underline-offset-8 duration-200"><a href="./facility-reservations-calendar.php" rel="noopener noreferrer">View Facility Reservation Calendar &rarr;</a></p>
            <?php echo $params['alertMsg']; ?>
          </form>
          <?php } else { ?>
          <form method="POST" class="space-y-4">
            <div class="grid grid-flow-row gap-4">
              <div class="input-group flex flex-col">
                <label for="name" class="font-medium">Full Name</label>
                <input type="text" name="name" id="name" class="border border-gray-200 rounded-md p-2" required>
              </div>
              <div class="input-group flex flex-col">
                <label for="email" class="font-medium">Email Address</label>
                <input type="email" name="email" id="email" class="border border-gray-200 rounded-md p-2" required>
              </div>
              <div class="input-group flex flex-col">
                <label for="pavSelect" class="font-medium">Location</label>
                <div class="wrapper">
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
              <div class="input-group flex flex-col" id="dateSetTwo">
                <label for="resStart" class="font-medium">Date of Reservation</label>
                <div class="flex flex-row items-center space-x-3">
                  <input type="date" name="resStart" id="resStart" class="border border-gray-200 rounded-md p-2 w-full">
                  <input type="date" name="resEnd" id="resEnd" class="border border-gray-200 rounded-md p-2 w-full">
                </div>
              </div>
              <div class="input-group">
                <div class="p-4 flex flex-col space-y-2 text-sm text-gray-700 bg-gray-100 rounded-lg" role="alert">
                  <div class="input-group-header flex flex-row items-center space-x-1">
                    <p class="text-base font-bold">Terms and Conditions</p>
                  </div>
                  <div class="item space-x-2 text-justify">
                    <input type="checkbox" name="agreement" id="agreement" value="1" required>
                    <label for="agreement">
                      By checking this box, <i>I understand</i> that this does not confirm my reservation and in order to secure my reservation, I must make payment and provide DLNR - Parks & Recreation a copy of my email receipt within [x] days. Otherwise, I must submit a reservation again.
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="flex flex-row items-center space-x-2">
              <button type="submit" name="reserveFacility" class="px-4 py-2 rounded-md text-white font-medium bg-dfw-blue-main border-2 border-dfw-blue-main hover:bg-white hover:border-dfw-blue-main hover:border-2 hover:text-dfw-blue-main duration-200">Submit</button>
            </div>
            <hr>
            <p class="font-medium text-sm text-dfw-blue-main mt-3 w-72 hover:underline hover:underline-offset-8 duration-200"><a href="./facility-reservations-calendar.php" rel="noopener noreferrer">View Facility Reservation Calendar &rarr;</a></p>
            <?php echo $params['alertMsg']; ?>
          </form>
          <?php } ?>
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

  <script src="./js/main.js"></script>
</body>

</html>