<?php require_once ('./controller.php'); ?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Aquatic Education - Division of Fish and Wildlife | Department of Lands and Natural Resources</title>

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

        <link rel="stylesheet" href="./font-awesome/css/all.min.css">
        <link rel="stylesheet" href="./dist/inter.css">
        <link rel="stylesheet" href="./dist/output.css">
        <!--Required .js file to load nav &amp; footer-->
        <script src="./js/scrollToTop.js"></script>
        <script src="./js/jquery-3.6.0.min.js"></script>
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

        <section class="page-banner">

            <!--            <div class="banner1-load"></div>-->
            <!--            <div class="banner2-load"></div>-->
            <!--            <div class="banner3-load"></div>-->

        </section>

        <main class="page-container">
            <div class="flex flex-col page-wrapper">
                <!-- hero -->
                <section class="hero">
                    <header>
                        <div class="nav-load"></div>
                    </header>
                    <div class="container flex flex-col pt-10 pb-20 px-6 mx-auto space-y-0 text-white">
                        <div
                            class="flex flex-col items-center justify-center text-center w-full md:mx-auto lg:mx-auto lg:w-3/4 xl:w-2/3 xxl:w-1/2">
                            <div class="hero-txt">
                                <p class="mt-3 font-light uppercase">Division of Fish and Wildlife</p>
                                <h1 class="font-bold text-3xl uppercase lg:text-4xl">Aquatic Education</h1>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="child-page-content px-4 py-6">
                    <div class="container mx-auto grid grid-rows space-y-8 lg:grid-cols-2 lg:gap-4 xl:space-y-0 xl:grid-cols-3 xxl:max-w-screen-xl">
                        <div class="left-page-content space-y-6 xl:col-span-2">
                            <h2 class="text-xl text-slate-800 font-bold mb-2 border-l-8 border-dfw-blue-main pl-2">
                                Aquatic Education
                            </h2>
                            <div class="item space-y-3 xl:col-span-2">
                                <p>
                                    The Aquatic Education section of the Division of Fish and Wildlife serves to educate the
                                    people of the CNMI through various outreach opportunities. Through school presentations,
                                    we are given the opportunity to reach out to the primary, secondary, and tertiary
                                    students in the CNMI. With these presentations, we will be able to increase and improve
                                    their understanding of ways to preserve aquatic life forms and their habitats for future
                                    generations. Providing educational outreach to the CNMI student community will
                                    contribute, at all levels, to future generations of CNMI citizens fundamental knowledge
                                    of aquatic resources, a transparent understanding of the activities of the DFW and how
                                    those activities mesh into the broader goal of sustainable use, and encouragement to
                                    pursue careers in fisheries science.
                                </p>
                                <p>
                                    Although educating students in the CNMI is a major component of our Aquatic Education
                                    program, our outreach extends beyond the classroom to include everyone within the
                                    community. We seek to provide outreach opportunities that will increase the community's
                                    knowledge and understanding of ways to better manage resource sustainability.
                                </p>
                                <h3 class="text-xl font-semibold">
                                    Presentation Topics
                                </h3>
                                <ul class="list-disc space-y-3 pl-8">
                                    <li>
                                        Fishing across cultures (describes various fishing methods between Chamorros,
                                        Carolinians, Filipinos, etc.)
                                    </li>
                                    <li>
                                        Responsible fishing techniques
                                    </li>
                                    <li>
                                        Various aquatic animals and their habitats
                                    </li>
                                    <li>
                                        Boating Access and Fisheries Research Program
                                    </li>
                                </ul>
                                <p>
                                    More presentation topics will be added throughout the year.
                                </p>
                            </div>
                        </div>
                        <div class="right-page-content space-y-3">
                            <h3 class="text-xl font-semibold">
                                Sign-up
                            </h3>
                            <p>
                                Presentations can usually be made on-site with 2 weeks advance notice. Please use this form
                                to request a presentation for your classroom or organization.
                            </p>
                            <form action="" method="POST"
                                class="grid grid-flow-row gap-4 md:grid-cols-2 md:gap-4 md:items-center lg:grid-flow-row lg:grid-cols-1">
                                <input type="text" name="email" id="" placeholder="Email address"
                                    class="border-2 rounded-md p-2 w-full focus:outline-none focus:shadow-none">
                                <input type="text" name="teacher" id="" placeholder="Teacher's Name"
                                    class="border-2 rounded-md p-2 w-full focus:outline-none focus:shadow-none mt-0">
                                <input type="text" name="school" id="" placeholder="School"
                                    class="border-2 rounded-md p-2 w-full focus:outline-none focus:shadow-none">
                                <input type="text" name="grade" id="" placeholder="Grade"
                                    class="border-2 rounded-md p-2 w-full focus:outline-none focus:shadow-none">
                                <input type="text" name="noStudents" id="" placeholder="Number of Students"
                                    class="border-2 rounded-md p-2 w-full focus:outline-none focus:shadow-none">
                                <div class="time-alloted">
                                    <input type="text" name="allotedTime" id="" placeholder="Time alloted for presentation"
                                    class="border-2 rounded-md p-2 w-full focus:outline-none focus:shadow-none" maxlength="12">
                                    <p class="text-sm">(<i>Format: 2hrs, 30mins</i>)</p>
                                </div>
                                <select name="topic" id="" class="border-2 rounded-md p-2 w-full focus:outline-none focus:shadow-none">
                                    <option value="" selected disabled>Choose a Topic</option>
                                    <option value="1">Fishing across cultures (describes various fishing methods between Chamorros, Carolinians, Filipinos, etc.)</option>
                                    <option value="2">Responsible fishing techniques</option>
                                    <option value="3">Various aquatic animals and their habitats</option>
                                    <option value="4">Boating Access and Fisheries Research Program</option>
                                </select>
                                <div class="time-of-presentation">
                                    <input type="datetime-local" name="presentationDate" id="" placeholder="Date and Time" class="border-2 rounded-md p-2 w-full focus:outline-none focus:shadow-none">
                                    <p class="text-sm">Time of Presentation</p>
                                </div>
                                <textarea name="comments" placeholder="Comments" class="border-2 rounded-md p-2 w-full h-32 resize-none focus:outline-none focus:shadow-none xl:w-auto"></textarea>
                                <button type="submit" name="presentationSignUp" class="p-4 bg-dfw-blue-main text-white font-medium rounded-md col-start-1 border-2 border-dfw-blue-main hover:bg-white hover:border-dfw-blue-main hover:border-2 hover:text-dfw-blue-main duration-200"">Send</button>
                            </form>
                            <?php echo $params['alertMsg']; ?>
                        </div>
                    </div>
                </section>
            </div>
            <div class="footer-load sticky-footer"></div>
        </main>


        <script src="./js/main.js"></script>
    </body>

</html>
