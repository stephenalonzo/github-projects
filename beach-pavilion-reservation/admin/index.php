<?php 

require_once ('./header.php');
require_once ('./authentication.php');
require_once ('../controller.php'); 

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex">
  <title>Facility Reservations</title>

  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

  <link rel="stylesheet" href="../font-awesome/css/all.min.css">
  <link rel="stylesheet" href="../dist/inter.css">
  <link rel="stylesheet" href="../dist/output.css">

  <style>
    .modal {
      transition: opacity 0.25s ease;
    }

    body.modal-active {
      overflow-x: hidden;
      overflow-y: visible !important;
    }
  </style>

  <script src="../js/jquery-3.6.0.min.js"></script>
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
        <div class="container mx-auto space-y-3 xl:max-w-screen-lg">
          <div class="flex flex-row items-center justify-between">
          <form action="" method="POST">
            <div class="search flex flex-row items-center space-x-2">
              <div class="input-wrapper text-black">
                <input type="text" name="search" class="border py-2 px-3 w-full rounded-md focus:outline-none focus:shadow-none" placeholder="Search">
                <label for="" class="fas fa-search input-icon"></label>
              </div>
            </div>
          </form>
          <form action="" method="POST" class="flex flex-row items-center">
            <div class="relative filter space-x-3 flex flex-row items-center">
              <div class="filter-group space-y-4">
                <button id="filter" type="button" class="px-4 py-[0.45rem] text-gray-400 bg-gray-200 rounded-md border-2 border-gray-200 hover:bg-white hover:text-gray-400 duration-200">
                  <i class="far fa-stream"></i>
                  <span>Filters</span>
                </button>
                <div class="hidden absolute w-full filter-options py-2 flex-col bg-white border border-gray-200 shadow-md rounded-md" id="filterOptions">
                  <button type="submit" name="reserved" class="p-3 text-sm">Reserved</button>
                  <button type="submit" name="pending" class="p-3 text-sm">Pending</button>
                  <button type="submit" name="canceled" class="p-3 text-sm">Canceled</button>
                </div>
              </div>
              <div class="reset-filter">
                <button type="submit" class="p-[0.725rem] text-gray-400 bg-gray-200 rounded-md border-2 border-gray-200 hover:bg-white hover:text-gray-400 duration-200">
                <i class="fas fa-redo"></i>
                </button>
              </div>
            </div>
          </form>
          </div>
          <div class="overflow-hidden overflow-x-auto border border-gray-100 rounded-sm">
            <form action="" method="post" class="m-0 p-0">
              <table class="min-w-full text-sm divide-y divide-gray-200">
                <thead>
                  <tr class="bg-gray-50">
                    <th
                        class="px-4 py-2 font-bold text-left text-gray-900">
                      Facility Name
                    </th>
                    <th
                        class="px-4 py-2 font-bold text-left text-gray-900">
                      Date of Reservation
                    </th>
                    <th
                        class="px-4 py-2 font-bold text-left text-gray-900">
                      Confirmation ID
                    </th>
                    <th
                        class="px-4 py-2 font-bold text-left text-gray-900">
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">

                <?php 

                foreach ($_REQUEST as $key => $value) {

                  switch ($key) {

                    case 'reserved':
                      $filter = 'RESERVED';
                      break;

                    case 'pending':
                      $filter = 'PENDING';
                      break;

                    case 'canceled':
                      $filter = 'CANCELED';
                      break;

                    default:
                      $filter = '';

                  }

                }

                $results = filterReservations($params, $filter);

                if (isset($_POST['reserved']) || isset($_POST['pending']) || isset($_POST['canceled'])) {

                foreach ($results as $row) {

                ?>

                  <tr>
                    <td class="px-4 py-2 text-gray-700 flex flex-row items-center space-x-2">
                      <p>
                        <?php echo $row['pavName']; ?>
                      </p>
                      <input type="text" name="confirmation" value="<?php echo $row['resID']; ?>" class="hidden" readonly>
                      <?php if ($row['pavStatus'] == 'RESERVED') { ?>
                      <strong class="bg-green-600/25 text-green-600 px-3 py-1.5 rounded text-xs font-medium uppercase">
                        Reserved
                      </strong>
                      <?php } elseif ($row['pavStatus'] == 'PENDING') { ?>
                      <strong class="bg-[#f4a261]/25 text-orange-600 px-3 py-1.5 rounded text-xs font-medium uppercase">
                        Pending
                      </strong>
                      <?php } else { ?>
                      <strong class="bg-red-600/25 text-red-600 px-3 py-1.5 rounded text-xs font-medium uppercase">
                        Canceled
                      </strong>
                      <?php } ?>
                    </td>
                    <td class="px-4 py-2 text-gray-700">
                      <?php echo date('m/d/Y', strtotime($row['resStart'])); ?>
                    </td>
                    <td class="px-4 py-2 text-gray-700">
                      <p>
                        <?php echo $row['confirmID']; ?>
                      </p>
                    </td>
                    <td class="px-4 py-2 text-gray-700 flex items-center justify-center space-x-4">
                      <?php if ($row['pavStatus'] == 'RESERVED') { ?>
                      <a onclick="return confirm('By clicking OK, you agree that the customer has canceled their reservation.')" href="./cancel.php?id=<?php echo $row['resID'];?>" name="confirm" class=" px-4 py-2 rounded-md bg-red-600 text-white border-2 border-red-600 text-xs uppercase font-medium hover:bg-white hover:text-red-600 duration-200">
                        <i class="fas fa-times text-xs"></i>
                      </a>
                      <button type="button" onclick="printReceipt('<?php echo $row['confirmID']; ?>')" class="px-4 py-2 rounded-md bg-gray-200 text-gray-400 border-2 border-gray-200 text-xs uppercase font-medium hover:bg-gray-400 hover:border-gray-400 hover:text-white duration-200">
                        <i class="fas fa-print text-xs"></i>
                      </button>
                      <?php } elseif ($row['pavStatus'] == 'CANCELED') { ?>

                      <?php } else { ?>
                      <a href="./confirm.php?id=<?php echo $row['resID'];?>" name="confirm" class="px-4 py-2 rounded-md bg-green-600 text-white border-2 border-green-600 text-xs uppercase font-medium hover:bg-white hover:text-green-600 duration-200">
                        <i class="fas fa-check text-xs"></i>
                      </a>
                      <a onclick="return confirm('By clicking OK, you agree that the customer has canceled their reservation.')" href="./cancel.php?id=<?php echo $row['resID'];?>" name="confirm" class=" px-4 py-2 rounded-md bg-red-600 text-white border-2 border-red-600 text-xs uppercase font-medium hover:bg-white hover:text-red-600 duration-200">
                        <i class="fas fa-times text-xs"></i>
                      </a>
                      <?php } ?>
                    </td>
                  </tr>

                  <?php } ?>
                  <?php } elseif (isset($_POST['search'])) { 

                  $results = searchReservations($params);
                  
                  foreach ($results as $row) {
                  
                  ?>

                    <tr>
                    <td class="px-4 py-2 text-gray-700 flex flex-row items-center space-x-2">
                      <p>
                        <?php echo $row['pavName']; ?>
                      </p>
                      <input type="text" name="confirmation" value="<?php echo $row['resID']; ?>" class="hidden" readonly>
                      <?php if ($row['pavStatus'] == 'RESERVED') { ?>
                      <strong class="bg-green-600/25 text-green-600 px-3 py-1.5 rounded text-xs font-medium uppercase">
                        Reserved
                      </strong>
                      <?php } elseif ($row['pavStatus'] == 'PENDING') { ?>
                      <strong class="bg-[#f4a261]/25 text-orange-600 px-3 py-1.5 rounded text-xs font-medium uppercase">
                        Pending
                      </strong>
                      <?php } else { ?>
                      <strong class="bg-red-600/25 text-red-600 px-3 py-1.5 rounded text-xs font-medium uppercase">
                        Canceled
                      </strong>
                      <?php } ?>
                    </td>
                    <td class="px-4 py-2 text-gray-700">
                      <?php echo date('m/d/Y', strtotime($row['resStart'])); ?>
                    </td>
                    <td class="px-4 py-2 text-gray-700">
                      <p>
                        <?php echo $row['confirmID']; ?>
                      </p>
                    </td>
                    <td class="px-4 py-2 text-gray-700 flex items-center justify-center space-x-4">
                      <?php if ($row['pavStatus'] == 'RESERVED') { ?>
                      <a onclick="return confirm('By clicking OK, you agree that the customer has canceled their reservation.')" href="./cancel.php?id=<?php echo $row['resID'];?>" name="confirm" class=" px-4 py-2 rounded-md bg-red-600 text-white border-2 border-red-600 text-xs uppercase font-medium hover:bg-white hover:text-red-600 duration-200">
                        <i class="fas fa-times text-xs"></i>
                      </a>
                      <button type="button" onclick="printReceipt('<?php echo $row['confirmID']; ?>')" class="px-4 py-2 rounded-md bg-gray-200 text-gray-400 border-2 border-gray-200 text-xs uppercase font-medium hover:bg-gray-400 hover:border-gray-400 hover:text-white duration-200">
                        <i class="fas fa-print text-xs"></i>
                      </button>
                      <?php } elseif ($row['pavStatus'] == 'CANCELED') { ?>

                      <?php } else { ?>
                      <a href="./confirm.php?id=<?php echo $row['resID'];?>" name="confirm" class="px-4 py-2 rounded-md bg-green-600 text-white border-2 border-green-600 text-xs uppercase font-medium hover:bg-white hover:text-green-600 duration-200">
                        <i class="fas fa-check text-xs"></i>
                      </a>
                      <a onclick="return confirm('By clicking OK, you agree that the customer has canceled their reservation.')" href="./cancel.php?id=<?php echo $row['resID'];?>" name="confirm" class=" px-4 py-2 rounded-md bg-red-600 text-white border-2 border-red-600 text-xs uppercase font-medium hover:bg-white hover:text-red-600 duration-200">
                        <i class="fas fa-times text-xs"></i>
                      </a>
                      <?php } ?>
                    </td>
                  </tr>

                  <?php } ?>
                  <?php } else { 

                  $results = dataView($params);
                  
                  foreach ($results as $row) {
                  
                  ?>

                    <tr>
                    <td class="px-4 py-2 text-gray-700 flex flex-row items-center space-x-2">
                      <p>
                        <?php echo $row['pavName']; ?>
                      </p>
                      <input type="text" name="confirmation" value="<?php echo $row['resID']; ?>" class="hidden" readonly>
                      <?php if ($row['pavStatus'] == 'RESERVED') { ?>
                      <strong class="bg-green-600/25 text-green-600 px-3 py-1.5 rounded text-xs font-medium uppercase">
                        Reserved
                      </strong>
                      <?php } elseif ($row['pavStatus'] == 'PENDING') { ?>
                      <strong class="bg-[#f4a261]/25 text-orange-600 px-3 py-1.5 rounded text-xs font-medium uppercase">
                        Pending
                      </strong>
                      <?php } else { ?>
                      <strong class="bg-red-600/25 text-red-600 px-3 py-1.5 rounded text-xs font-medium uppercase">
                        Canceled
                      </strong>
                      <?php } ?>
                    </td>
                    <td class="px-4 py-2 text-gray-700">
                      <?php echo date('m/d/Y', strtotime($row['resStart'])); ?>
                    </td>
                    <td class="px-4 py-2 text-gray-700">
                      <p>
                        <?php echo $row['confirmID']; ?>
                      </p>
                    </td>
                    <td class="px-4 py-2 text-gray-700 flex items-center justify-center space-x-4">
                      <?php if ($row['pavStatus'] == 'RESERVED') { ?>
                      <a onclick="return confirm('By clicking OK, you agree that the customer has canceled their reservation.')" href="./cancel.php?id=<?php echo $row['resID'];?>" name="confirm" class=" px-4 py-2 rounded-md bg-red-600 text-white border-2 border-red-600 text-xs uppercase font-medium hover:bg-white hover:text-red-600 duration-200">
                        <i class="fas fa-times text-xs"></i>
                      </a>
                      <button type="button" onclick="printReceipt('<?php echo $row['confirmID']; ?>')" class="px-4 py-2 rounded-md bg-gray-200 text-gray-400 border-2 border-gray-200 text-xs uppercase font-medium hover:bg-gray-400 hover:border-gray-400 hover:text-white duration-200">
                        <i class="fas fa-print text-xs"></i>
                      </button>
                      <?php } elseif ($row['pavStatus'] == 'CANCELED') { ?>

                      <?php } else { ?>
                      <a href="./confirm.php?id=<?php echo $row['resID'];?>" name="confirm" class="px-4 py-2 rounded-md bg-green-600 text-white border-2 border-green-600 text-xs uppercase font-medium hover:bg-white hover:text-green-600 duration-200">
                        <i class="fas fa-check text-xs"></i>
                      </a>
                      <a onclick="return confirm('By clicking OK, you agree that the customer has canceled their reservation.')" href="./cancel.php?id=<?php echo $row['resID'];?>" name="confirm" class=" px-4 py-2 rounded-md bg-red-600 text-white border-2 border-red-600 text-xs uppercase font-medium hover:bg-white hover:text-red-600 duration-200">
                        <i class="fas fa-times text-xs"></i>
                      </a>
                      <?php } ?>
                    </td>
                  </tr>
                  <?php } ?>
                  <?php } ?>
                </tbody>
              </table>
            </form>
          </div>
        </div>
      </section>
      <div class="relative">
        <button type="button"
                class="bg-dlnrpurple-1 py-4 px-6 fixed bottom-8 right-6 drop-shadow-md z-50 scrollToTopBtn"
                id="scrollToTop">
          <i class="fas fa-arrow-to-top text-white text-xl"></i>
        </button>
      </div>
    </div>
    <div class="footer-load sticky-footer"></div>
  </main>

  <?php 
      
      $results = dataView($params);

      foreach ($results as $row) {
      
      ?>

      <!DOCTYPE html>
      <html lang="en">

      <head>
        <title>Reservation Confirmation - Division of Parks &amp; Recreation | Department of Lands and Natural Resources</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
      </head>

      <body style="font-family: Inter, sans-serif !important;">
        <main style="background: #f4f3ee !important;">
          <section class="email hidden" id="<?php echo $row['confirmID'] ?>">
            <div style="padding: 24px 16px;">
              <div style="margin: 0px auto; display: flex; justify-content: center; align-items: center;">
                <img src="https://dev.dlnr.cnmi.gov/assets/img/dlnr.png" alt="" style="max-width: 150px;">
              </div>
            </div>
            <hr style="opacity: 0.5; width: 65%;">
            <div style="padding: 0px 16px 24px 16px;">
              <div style="color: #000 !important; width: 70%; margin: 0 auto;">
                <h1 style="font-size: 1.25rem; margin: 1.5rem auto;">Hafa Adai,</h1>
                <!-- <p style="text-align: justify; margin: 1.5rem auto;">
                            This reservation will be on hold until you secure your reservation. To secure your reservation, you must first make payment and provide the Division of Parks & Recreation a copy of this email receipt within [x] days. Otherwise, you must submit a reservation again.
                        </p>
                        <p style="text-align: justify; margin: 1.5rem auto;">
                            Please keep note, that <b>the validity of the QR code below expires the same day, potentially, that you do not make payment and provide DLNR a copy of this email receipt</b>.
                        </p> -->
                <p>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, possimus. Voluptatum eos illum animi, sapiente vel asperiores neque voluptas error soluta eveniet perspiciatis quasi velit, iusto enim totam sed consequatur.
                </p>
                <p>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, possimus. Voluptatum eos illum animi, sapiente vel asperiores neque voluptas error soluta eveniet perspiciatis quasi velit, iusto enim totam sed consequatur.
                </p>
                <hr style="opacity: 0.5;">
                <h1 style="font-size: 1.1rem; font-weight: bold; margin-bottom: 0px !important;">Reservation Details</h1>
                <p>Location: <span style="font-weight: 500">
                    <?php echo $row['pavName']; ?>
                  </span></p>
                <p>Confirmation ID: <span style="font-weight: 500">
                    <?php echo $row['confirmID']; ?>
                  </span></p>
              </div>
            </div>
          </section>
        </main>
      </body>

      </html>

      <?php } ?>

  <script>

    function printReceipt(params) {
      var headHTML = '<html><head><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet"></head><body style="font-family: Inter, sans-serif !important;">';
      var footerHTML = "</body></html>";
      var printThis = document.all.item(params).innerHTML;
      var returnHere = document.body.innerHTML;
      document.body.innerHTML = headHTML + printThis + footerHTML;
      window.print();
      document.body.innerHTML = returnHere;
      return false;
    }

  </script>

  <script src="./script.js"></script>

</body>

</html>