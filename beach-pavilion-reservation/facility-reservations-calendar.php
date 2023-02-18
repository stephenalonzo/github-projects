<?php require_once ('./controller.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facility Reservations Calendar - Division of Parks and Recreation | Department of Lands and Natural Resources</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

    <!-- <link rel="stylesheet" href="./dist/bootstrap.min-cal.css"> -->
    <!-- <link rel="stylesheet" href="./dist/bootstrap.min.css"> -->
    <link rel="stylesheet" href="./dist/fullcalendar.css">

    <link rel="stylesheet" href="./font-awesome/css/all.min.css">
    <link rel="stylesheet" href="./dist/inter.css">
    <link rel="stylesheet" href="./dist/output.css">
    <!--Required .js file to load nav &amp; footer-->
    <!-- <script src="./js/scrollToTop.js"></script> -->
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./dist/jquery.min-cal.js"></script>
    <script src="./dist/jquery-ui.min.js"></script>
    <script src="./dist/moment.min.js"></script>
    <script src="./dist/fullcalendar.min.js"></script>
    <!-- <script src="./dist/tooltip.js"></script> -->
    <script src="./dist/sweetalert.min.js"></script>
    <script src="./dist/app.js"></script>
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
    <!-- announcements -->
    <section class="page-banner">
        <!-- <div class="banner1-load"></div> -->
        <!-- <div class="banner2-load"></div> -->
        <!-- <div class="banner3-load"></div> -->

    </section>

    <main class="page-container">
        <div class="page-wrapper">
            <!-- hero -->
            <section class="hero">
                <header>
                    <div class="nav-load"></div>
                </header>
                <div class="container flex flex-col pt-10 pb-20 px-6 mx-auto space-y-0 text-white">
                    <div
                         class="flex flex-col items-center justify-center text-center w-full md:mx-auto lg:mx-auto lg:w-3/4 xl:w-2/3 xxl:w-1/2">
                        <div class="hero-txt">
                            <p class="mt-3 font-light uppercase">Division of Parks and Recreation</p>
                            <h1 class="font-bold text-3xl uppercase lg:text-4xl">Facility Reservations Calendar</h1>
                        </div>
                    </div>
                </div>
            </section>
            <section class="calendar px-4 py-6">
                <div class="container mx-auto">
                    <div class="grid grid-flow-row gap-4 xl:grid-cols-6">
                        <div class="facilities space-y-2 h-auto xl:col-span-2">
                            <div class="facilities-header flex flex-row justify-between items-center">
                                <div class="search-facility">
                                    <form action="" method="POST" class="m-0">
                                        <div class="input-wrapper">
                                            <input type="text" name="facilitySearch" id="" class="w-56 border py-2 pl-3 pr-8 rounded-md focus:outline-none focus:shadow-none xs:w-72 sm:w-96 xl:w-64 xxl:w-72" placeholder="Find location">
                                            <label for="" class="fas fa-search input-icon"></label>
                                        </div>
                                    </form>
                                </div>
                                <div class="filter-facility z-50">
                                    <div class="btn relative space-y-3">
                                        <div class="buttons flex flex-row items-center space-x-1">
                                            <button id="filterCal" type="button" class="px-4 py-3 text-gray-400 bg-gray-200 rounded-md border-2 border-gray-200 hover:bg-white hover:text-gray-400 duration-200 sm:block focus:bg-gray-200">
                                                <i class="far fa-stream"></i>
                                            </button>
                                            <form action="" method="post" class="m-0">
                                                <button id="filterCal" type="submit" class="px-4 py-3 text-gray-400 bg-gray-200 rounded-md border-2 border-gray-200 hover:bg-white hover:text-gray-400 duration-200 sm:block focus:bg-gray-200">
                                                    <i class="far fa-redo"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <div id="optionsCal" class="absolute hidden w-48 left-0 -translate-x-1/3">
                                            <div class="filter bg-white rounded-md shadow-md">
                                                <div class="status">
                                                    <p class="text-sm font-bold px-3 py-2 text-gray-600 bg-gray-100">Type</p>
                                                    <form method="POST" class="">
                                                        <div class="px-4 py-2 space-y-2 text-sm" id="filterBtnGroup">
                                                            <div class="top-row grid grid-flow-row gap-y-3 items-center lg:grid-cols-1 lg:grid-flow-row lg:gap-2">
                                                                <div class="flex items-center space-x-3">
                                                                    <button type="submit" name="camp-sites">Camp Sites</button>
                                                                </div>
                                                                <div class="flex items-center space-x-3">
                                                                    <button type="submit" name="facilities">Facilities</button>
                                                                </div>
                                                                <div class="flex items-center space-x-3">
                                                                    <button type="submit" name="baseball-fields">Baseball Fields</button>
                                                                </div>
                                                                <div class="flex items-center space-x-3">
                                                                    <button type="submit" name="softball-fields">Softball Fields</button>
                                                                </div>
                                                                <div class="flex items-center space-x-3">
                                                                    <button type="submit" name="basketball-courts">Basketball Courts</button>
                                                                </div>
                                                                <div class="flex items-center space-x-3">
                                                                    <button type="submit" name="tourists-sites">Tourists Sites</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="locations border border-gray-200 rounded-md overflow-y-scroll h-52 xl:h-[640px]">
                            <?php
                                                                
                            foreach ($_REQUEST as $key => $value) {

                                switch ($key) {

                                    case 'camp-sites':
                                        $filter = 'camp sites';
                                        break;

                                    case 'facilities':
                                        $filter = 'facilities';
                                        break;

                                    case 'baseball-fields':
                                        $filter = 'baseball, softball fields';
                                        break;

                                    case 'softball-fields':
                                        $filter = 'baseball, softball fields';
                                        break;

                                    case 'basketball-courts':
                                        $filter = 'basketball courts';
                                        break;

                                    case 'tourists-sites':
                                        $filter = 'tourists sites';
                                        break;

                                }

                            }

                            $results = filterLocations($params, $filter);

                            if (isset($_POST['camp-sites']) || isset($_POST['facilities']) || isset($_POST['baseball-fields']) || isset($_POST['softball-fields']) || isset($_POST['basketball-courts']) || isset($_POST['tourists-sites'])) {

                            foreach ($results as $row) {

                                switch ($row['locCode']) {
            
                                    case 'SIBP':
                                        $params['link']  = './san-isidro-beach-park.php';
                                        break;
                        
                                    case 'KBP':
                                        $params['link']  = './kilili-beach.php';
                                        break;
                        
                                    case 'CKBC':
                                        $params['link']  = './chalan-kanoa-basketball-court.php';
                                        break;
                        
                                    default:
                                    $params['link'] = strtolower(str_replace("#", "", str_replace(" ", "-", preg_replace('/[0-9]+/', '', $row['locName'])))).".php";
                                    
                                }
                                                                
                            ?>

                                <a class="relative block px-2 py-6 hover:bg-gray-100 duration-200" href="<?php echo $params['link']; ?>">
                                    <div class="text-gray-500 sm:pr-8">
                                        <div class="locations-header flex flex-row items-center space-x-3">
                                            <h5 class="font-bold text-gray-900 text-sm">
                                                <?php echo $row['locName']; ?>
                                            </h5>
                                            <span class="flex flex-row items-center space-x-1">
                                                <p class="text-sm">(<i class="fas fa-calendar-star"></i>
                                                <?php $params = countTotalNumOfReservations($params, $row['locName']); echo $params['rowCount'] ?>)</p>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                                <hr class="opacity-75">

                            <?php } ?>
                            <?php } elseif (isset($_POST['facilitySearch'])) {
                                
                                $results = searchLocation($params);

                                foreach ($results as $row) {

                                    switch ($row['locCode']) {
            
                                        case 'SIBP':
                                            $params['link']  = './san-isidro-beach-park.php';
                                            break;
                            
                                        case 'KBP':
                                            $params['link']  = './kilili-beach.php';
                                            break;
                            
                                        case 'CKBC':
                                            $params['link']  = './chalan-kanoa-basketball-court.php';
                                            break;
                            
                                        default:
                                        $params['link'] = strtolower(str_replace("#", "", str_replace(" ", "-", preg_replace('/[0-9]+/', '', $row['locName'])))).".php";
                                        
                                    }
                                
                                ?>
                                <a class="relative block px-2 py-6 hover:bg-gray-100 duration-200" href="<?php echo $params['link']; ?>">
                                    <div class="text-gray-500 sm:pr-8">
                                        <div class="locations-header flex flex-row items-center space-x-3">
                                            <h5 class="font-bold text-gray-900 text-sm">
                                                <?php echo $row['locName']; ?>
                                            </h5>
                                            <span class="flex flex-row items-center space-x-1">
                                                <p class="text-sm">(<i class="fas fa-calendar-star"></i>
                                                <?php $params = countTotalNumOfReservations($params, $row['locName']); echo $params['rowCount'] ?>)</p>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                                <hr class="opacity-75">
                                <?php } ?>
                                <?php } else { 
                                
                                $results = getLocations($params);

                                foreach ($results as $row) {

                                    switch ($row['locCode']) {
            
                                        case 'SIBP':
                                            $params['link']  = './san-isidro-beach-park.php';
                                            break;
                            
                                        case 'KBP':
                                            $params['link']  = './kilili-beach.php';
                                            break;
                            
                                        case 'CKBC':
                                            $params['link']  = './chalan-kanoa-basketball-court.php';
                                            break;
                            
                                        default:
                                        $params['link'] = strtolower(str_replace("#", "", str_replace(" ", "-", preg_replace('/[0-9]+/', '', $row['locName'])))).".php";
                                        
                                    }
                                
                                ?>
                                <a class="relative block px-2 py-6 hover:bg-gray-100 duration-200" href="<?php echo $params['link']; ?>">
                                    <div class="text-gray-500 sm:pr-8">
                                        <div class="locations-header flex flex-row items-center space-x-3">
                                            <h5 class="font-bold text-gray-900 text-sm">
                                                <?php echo $row['locName']; ?>
                                            </h5>
                                            <span class="flex flex-row items-center space-x-1">
                                                <p class="text-sm">(<i class="fas fa-calendar-star"></i>
                                                <?php $params = countTotalNumOfReservations($params, $row['locName']); echo $params['rowCount'] ?>)</p>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                                <hr class="opacity-75">
                                <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div id="calendar" class="place-self-auto xl:col-span-4">
                            <div class="flex flex-row items-center space-x-5 mt-3">
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

    <script src="./js/main.js"></script>
    <script>
        var filterCal = document.getElementById('filterCal');
        var optionsCal = document.getElementById('optionsCal');

        filterCal.addEventListener('click', () => {
            optionsCal.classList.toggle('block');
            optionsCal.classList.toggle('hidden');
        });
    </script>
</body>

</html>