<?php 

require_once ('./header.php');
require_once ('./authentication.php');
require_once ('../controller.php');

$results = cashOut($params);

foreach ($results as $row) {

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex">
  <title>Confirm Reservation</title>

  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

  <link rel="stylesheet" href="../font-awesome/css/all.min.css">
  <link rel="stylesheet" href="../dist/inter.css">
  <link rel="stylesheet" href="../dist/output.css">

  <script src="../js/jquery-3.6.0.min.js"></script>

  <style>
    @media print {
      .data-view {
        display: none;
      }
    }
  </style>

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
      <section class="data-view px-4 py-6">
        <div class="container mx-auto space-y-4 xl:max-w-screen-lg">
            <h1 class="text-2xl font-bold">Confirmation</h1>
            <form action="" method="POST" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="input-group flex flex-col">
                        <label for="facility">Facility Name</label>
                        <input id="facility" type="text" name="facility" value="<?php echo $row['pavName']; ?>" class="border-2 border-gray-200 p-2 rounded-md pointer-events-none text-gray-500" readonly>
                    </div>
                    <div class="input-group flex flex-col">
                        <label for="confirmID">Confirmation ID</label>
                        <input id="confirmID" type="text" name="confirmID" value="<?php echo $row['confirmID']; ?>" class="border-2 border-gray-200 p-2 rounded-md pointer-events-none text-gray-500" readonly>
                    </div>
                    <div class="input-group flex flex-col">
                        <label for="resDate">Reservation Date</label>
                        <input id="resDate" type="date" name="resStart" value="<?php echo date('Y-m-d', strtotime($row['resStart'])); ?>" class="border-2 border-gray-200 p-2 rounded-md">
                    </div>
                    <div class="input-group flex flex-col space-y-3">
                        <label for="receiptNo">Receipt No.</label>
                        <input type="text" name="receiptNo" value="2022-<?php echo rand(1000, 99999); ?>" class="pointer-events-none font-bold" readonly>
                    </div>
                </div>
                <button type="submit" name="confirmReservation" class="px-4 py-2 rounded-md bg-green-600 text-white text-sm border-2 border-green-600 uppercase font-medium hover:bg-white hover:text-green-600 duration-200">Confirm</button>
            </form>
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

</body>

</html>

<?php } ?>