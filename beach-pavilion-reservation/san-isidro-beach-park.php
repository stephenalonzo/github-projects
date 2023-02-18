<?php require_once('./controller.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>San Isidro Beach Park - Division of Parks and Recreation | Department of Land and Natural Resources</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/img/favicon/favicon-16x16.png">

    <link rel="stylesheet" href="./dist/fullcalendar.css">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="./font-awesome/css/all.min.css">
    <link rel="stylesheet" href="./dist/inter.css">
    <link rel="stylesheet" href="./dist/output.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./dist/jquery.min-cal.js"></script>
    <script src="./dist/jquery-ui.min.js"></script>
    <script src="./dist/moment.min.js"></script>
    <script src="./dist/fullcalendar.min.js"></script>
    <!-- <script src="./dist/tooltip.js"></script> -->
    <!-- <script src="./dist/app.js"></script> -->

    <!--Required .js file to load nav &amp; footer-->
    <script src="./js/scrollToTop.js"></script>
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
    <script>
        $(window).resize(function() {
            if (window.innerWidth < 576) {
                $('#calendar').fullCalendar('changeView', 'listMonth');
                $('#calendar').fullCalendar('dayClick', true);
                $('#calendar').fullCalendar('selectable', true);
            } else {
                $('#calendar').fullCalendar('changeView', 'month');
                $('#calendar').fullCalendar('dayClick', false);
                $('#calendar').fullCalendar('selectable', true);
            }
        });

        $(document).ready(function() {
            var bgColor = "";
            $('input[class=event_filter_box]').change(function() {
                $('#calendar').fullCalendar('rerenderEvents');
            });
            $('#calendar').fullCalendar({
                displayEventTime: false,
                eventClick: function(event) {
                    if (event.url) {
                        window.open(event.url);
                        return false;
                    }
                },
                selectable: true,
                select: function(start, end) {
                    starttime = $.fullCalendar.formatDate(start, 'MMMM DD, YYYY');
                    endtime   = $.fullCalendar.formatDate(end, 'MMMM DD, YYYY');
                    var mywhen = starttime;
                    var myto = endtime;
                    $('#createEventModal #apptStartTime').val(start);
                    $('#createEventModal #apptEndTime').val(end);
                    $('#createEventModal #when').text(mywhen);
                    $('#createEventModal #to').text(myto);
                    $('#createEventModal').show();
                },
                eventRender: function eventRender(event, element, view) {
                    var display = true;
                    var status = [];
                    var pavilion = [];
                    // Find all checkbox that are event filters that are enabled
                    // and save the values.
                    $("input[name='event_filter_select']:checked").each(function() {
                        // I specified data-type attribute in above HTML to differentiate
                        // between locations and kinds of events.

                        // Saving each type separately
                        if ($(this).data('type') == 'status') {
                            status.push($(this).val());
                        } else if ($(this).data('type') == 'pavilion') {
                            pavilion.push($(this).val());
                        }

                    });

                    // If there are locations to check
                    if (pavilion.length) {
                        display = display && pavilion.indexOf(event.title) >= 0;
                    }

                    // If there are specific types of events
                    if (status.length) {
                        display = display && status.indexOf(event.status) >= 0;
                    }

                    return display;
                },
                events: 'load.php'
            });

        });
    </script>
</head>

<body>
    <h1 class="text-white text-xl md:text-3xl xl:text-5xl bg-black/70 fixed">
    </h1>
    <script>
        function showBrowserWidth() {
            const width =
                window.innerWidth ||
                document.documentElement.clientWidth ||
                document.body.clientWidth
            document.querySelector('h1').innerHTML = `Width: ${width}`;
        }
        window.onload = showBrowserWidth;
        window.onresize = showBrowserWidth;
    </script>
    <div class="hero">
        <header>
            <div class="nav-load"></div>
        </header>

        <div class="container flex flex-col pt-5 pb-10 px-6 mx-auto space-y-0 text-white">
            <div class="flex flex-col items-center justify-center text-center w-full md:mx-auto max-w-xxl py-10">
                <h1 class="font-semibold text-5xl">San Isidro Beach Park</h1>
                <!-- <p class="mt-3 font-light text-xl">Marketing and Promoting the Islands Specialty Crop to the people of the CNMI</p> -->
            </div>
        </div>

        <!-- Program Banner -->
        <div class="banner-ag-sc"> </div>
    </div>

    <main class="relative mx-auto">

        <!-- Grant/Program Overview -->
        <section class="w-full mx-auto mobile:px-2">
            <div class="px-4 py-4 max-w-screen-xxl sm:px-6 lg:px-4 mx-auto">
                <h2 class="text-2xl text-slate-800 font-bold ml-4 py-1 sm:text-3xl">Overview</h2>
                <hr class=" border-b-4 w-1/6 border-dlnrgreen-main ml-4">


                <!-- pavilion Overview -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-y-8 lg:gap-x-20 lg:items-start pb-4">

                    <!-- image -->
                    <div class="max-w-xxl mx-auto text-center lg:text-left lg:mx-0 px-10">
                        <div class="mt-4">
                            <img src="./assets/img/san-insidro-beach-park.jpg" alt="" loading="lazy">
                        </div>

                    </div>

                    <!-- Features & Pricing -->
                    <section>
                        <p class="py-4">
                            <span class="font-semibold text-lg">San Isidro Beach Park </span> is a 40 x 20 Concrete Pavilion located in <a href="https://www.google.com/maps/place/Minachom+Atdao/@15.1632256,145.7052401,17z/data=!3m1!4b1!4m5!3m4!1s0x66d8b179c5c62691:0x5fd7b4026a799355!8m2!3d15.1632204!4d145.7074288" target="_blank" rel="noopener noreferrer" class="underline font-medium ">Chalan Kanoa</a>. The use of this pavilion allows for the setup of up to two (2) 20x40 Tents with tables by the beach. It also features a 20x40 area on the southern side of the pavilion for additional tents &amp; tables or a bouncy house.
                        </p>
                        <div class="grid grid-cols-1 lg:grid-cols-2 pl-4">
                            <div>
                                <h3 class="text-xl font-semibold underline underline-offset-4 pb-2">Features</h3>
                                <div class="space-y-2">
                                    <div class="flex items-baseline space-x-5">
                                        <i class="fas fa-umbrella-beach"></i>
                                        <h3 class="flex">Beach Front Pavilion</h3>
                                    </div>
                                    <div class="flex items-baseline space-x-5">
                                        <i class="fas fa-car"></i>
                                        <h3 class="flex">Ample Parking (up to 30 cars)</h3>
                                    </div>
                                    <div class="flex items-baseline space-x-5">
                                        <i class="fas fa-wheelchair"></i>
                                        <h3 class="flex">2 Accessible Parking Spots with wheelchair ramp</h3>
                                    </div>
                                    <div class="flex items-baseline space-x-5">
                                        <i class="fas fa-shish-kebab"></i>
                                        <h3 class="flex">BBQ Grill</h3>
                                    </div>
                                    <div class="flex items-baseline space-x-5">
                                        <i class="fas fa-lightbulb-dollar"></i>
                                        <h3 class="flex">CUC Power Available</h3>
                                    </div>
                                    <div class="flex items-baseline space-x-5">
                                        <i class="fas fa-shish-kebab"></i>
                                        <h3 class="flex">BBQ Grill</h3>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold underline underline-offset-4 pb-2">Pricing</h3>
                                <div class="items-baseline space-y-2">
                                    <div class="flex items-baseline space-x-5">
                                        <i class="fas fa-usd-circle"></i>
                                        <div>
                                            <h3>Daily Fee: $50.00 <span class="block italic"> Monday through Thursday</span></h3>
                                        </div>
                                    </div>
                                    <div class="flex items-baseline space-x-5">
                                        <i class="fas fa-usd-circle"></i>
                                        <div>
                                            <h3>Daily Fee: $75.00 <span class="block italic"> Friday through Sunday</span></h3>
                                        </div>
                                    </div>
                                    <div class="flex items-baseline space-x-5">
                                        <i class="fas fa-usd-circle"></i>
                                        <div>
                                            <h3>Deposit: $75.00</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <hr class=" border-b-2 border-slate-400/25 px-3 mx-auto my-3">

                <div class="py-2 mx-auto xl:max-w-screen-lg">
                    <?php echo $params['alertMsg']; ?>
                </div>

                <!-- Calendar -->
                <section class="container mx-auto xl:max-w-screen-lg">
                    <div class="py-6 space-y-4 grid grid-flow-row xl:grid-cols-3 xl:gap-4">
                        <div class="location hidden">
                            <form class="border border-gray-200 lg:border-t-0">
                                <fieldset>
                                    <legend class="block w-full px-4 py-2 text-xs font-medium bg-gray-50">
                                        Location
                                    </legend>
                                    <div class="px-4 py-2 space-y-2" id="">
                                        <div class="top-row grid grid-cols-1 items-center mdOnly:grid-cols-2 lg:grid-cols-1 lg:grid-flow-row lg:gap-2">
                                            <div class="flex items-center space-x-3">
                                                <input id="sipOne" class="event_filter_box hidden" name="event_filter_select" type="checkbox" value="San Isidro Beach Park Pavilion #1" data-type="pavilion" checked>
                                                <label class="text-sm sm:text-base" for="sipOne">San Isidro Park Pavilion #1</label>
                                            </div>
                                            <div class="flex items-center space-x-3">
                                                <input id="sipTwo" class="event_filter_box hidden" name="event_filter_select" type="checkbox" value="San Isidro Beach Park Pavilion #2" data-type="pavilion" checked>
                                                <label class="text-sm sm:text-base" for="sipTwo">San Isidro Park Pavilion #2</label>
                                            </div>
                                            <div class="flex items-center space-x-3">
                                                <input id="sipThree" class="event_filter_box hidden" name="event_filter_select" type="checkbox" value="San Isidro Beach Park Pavilion #3" data-type="pavilion" checked>
                                                <label class="text-sm sm:text-base" for="sipThree">San Isidro Park Pavilion #3</label>
                                            </div>
                                            <div class="flex items-center space-x-3">
                                                <input id="sipFour" class="event_filter_box hidden" name="event_filter_select" type="checkbox" value="San Isidro Beach Park Pavilion #4" data-type="pavilion" checked>
                                                <label class="text-sm sm:text-base" for="sipFour">San Isidro Park Pavilion #4</label>
                                            </div>
                                            <div class="flex items-center space-x-3">
                                                <input id="sipFive" class="event_filter_box hidden" name="event_filter_select" type="checkbox" value="San Isidro Beach Park Pavilion #5" data-type="pavilion" checked>
                                                <label class="text-sm sm:text-base" for="sipFive">San Isidro Park Pavilion #5</label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                            <?php if (isset($_POST['calendarStart']) && isset($_POST['calendarEnd'])) { ?>
                            <form action="" method="POST" class="space-y-3 mt-3 col-span-12">
                                <h2 class="font-bold text-2xl">Reservation Details</h2>
                                <div class="flex flex-col items-center space-y-3 sm:flex-row sm:space-y-0 sm:space-x-3">
                                    <input type="text" name="name" id="name" class="border border-gray-200 rounded-md p-2 w-full" placeholder="Full Name" required>
                                    <input type="email" name="email" id="email" class="border border-gray-200 rounded-md p-2 w-full" placeholder="Email" required>
                                    <select name="calendarFacility" id="pavSelect" class="border border-gray-200 rounded-md overflow-scroll p-2 w-full" required>
                                        <option value="" selected disabled>Choose Location</option>
                                        <?php 
                                            
                                        $locCode    = 'SIBP';
                                        $results    = getLocationCodes($params, $locCode);

                                        foreach ($results as $row) {

                                            $params = getPavDetails($params, $row['locName'], date('Y-m-d', strtotime($_POST['calendarStart'])), date('Y-m-d', strtotime($_POST['calendarEnd'])));
                                            
                                        ?> 

                                            <option value="<?php echo $row['locID']; ?>" <?php if ($params['rowCount'] > 0) { echo 'disabled'; } ?>><?php echo $row['locName']; ?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="flex flex-col items-center space-y-3 sm:flex-row sm:space-y-0 sm:space-x-3">
                                    <span class="control-label" for="when">
                                        <p>Reservation on: <span class="font-bold"><?php echo date('F d, Y', strtotime($_POST['calendarStart'])); ?></span>&nbsp;-&nbsp;<span class="font-bold"><?php echo date('F d, Y', strtotime($_POST['calendarEnd'])) ?></span></p>
                                    </span>
                                    <div class="flex flex-row items-center space-y-3 sm:flex-row sm:space-y-0 sm:space-x-3">
                                        <input type="text" name="resEnd" class="hidden" value="<?php echo date('Y-m-d', strtotime($_POST['calendarEnd'])) ?>">
                                        <input type="text" name="resStart" class="hidden" value="<?php echo date('Y-m-d', strtotime($_POST['calendarStart'])); ?>">
                                    </div>
                                </div>
                                <button type="submit" name="calendarReserve" class="px-4 py-2 rounded-md text-white font-medium bg-dfw-blue-main border-2 border-dfw-blue-main hover:bg-white hover:border-dfw-blue-main hover:border-2 hover:text-dfw-blue-main duration-200">Submit</button>
                            </form>
                            <?php } else { ?>
                            <div id="calendar" class="col-span-12 space-y-4">
                            <form action="" method="POST" id="createEventModal" class="hidden mt-3">
                                <div class="space-y-2">
                                    <div class="reservation-details flex flex-row items-center space-x-2">
                                        <label class="control-label" for="when">Reservation on:</label>
                                        <div id="when" class="font-bold"></div>
                                        <p>-</p>
                                        <div id="to" class="font-bold"></div>
                                            <input type="hidden" name="calendarStart" id="apptStartTime" />
                                            <input type="hidden" name="calendarEnd" id="apptEndTime" />
                                            <input type="text" name="locCode" value="SIBP" class="hidden" />
                                        </div>
                                    <button type="submit" class="px-4 py-2 rounded-md text-white font-medium bg-dlnrgreen-main border-2 border-dlnrgreen-main hover:bg-white hover:border-dlnrgreen-main hover:border-2 hover:text-dlnrgreen-main duration-200">Continue</button>
                                </div>
                            </form>
                            <?php } ?>
                        </div>
                    </div>
                </section>
            </div>
        </section>

    </main>

    <div class="footer-load"></div>

    <script src="./js/main.js"></script>

</body>


</html>