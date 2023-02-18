<?php
require_once('./db_connect.php'); // Database connection file
require_once('./functions.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/opd.css" />
</head>

<body>
    <button onclick="topFunction()" id="myBtn" title="Back to Top">
        <i class="fas fa-angle-double-up"></i>
    </button>

    <!-- footer -->
    <footer class="bg-light text-center text-lg-start">
        <!-- grid container -->
        <div class="container">
            <!--grid row-->
            <div class="row main-footer">
                <!--grid column-->
                <div class="text-center col-lg-3 mb-4 mb-md-0 footer-top">
                    <a href="https://governor.gov.mp/"><img src="./includes/gov.png" alt="..." height="100px" /></a>

                </div>

                <div class="text-center col-lg-3 mb-4 mb-md-0 footer-top">
                    <div class="footer-style">

                        <h1>Our web pages have been viewed:</h1>
                        <!-- -->

                        <ul id="visitor_counter">
                            <li>
                                <?php
                                
                                $results = dbAccess($params);

                                foreach ($results as $row)
                                {

                                    echo number_format($row['visitor_counter']);

                                }
                                
                                ?>
                            </li>
                        </ul>

                        <h1>times</h1>
                    </div>

                </div>

                <div class="text-center col-lg-3 mb-4 mb-md-0 social-media">
                    <h5 class="text-uppercase">Follow Us</h5>
                    <ul class="list-unstyled mb-0 footer-links socials">
                        <li class="footer-links">
                            <a href="https://www.facebook.com/cnmiopd670/" target="_blank">
                                <i class="fab fa-facebook-f fa-2x" style="color: #3b5998"></i></a>
                            <a href="https://www.instagram.com/cnmiopd/" target="_blank">
                                <i class="fab fa-instagram fa-2x" style="color: #ac2bac"></i></a>
                        </li>
                    </ul>
                </div>

                <div class="text-center col-lg-3 mb-md-0 footer-top py-0">
                    <a href="./index.html"><img src="./includes/opd_color.png" height="125px" alt="..." /></a>
                </div>

            </div>
        </div>
        <!--grid column-->
        <!-- copyright -->
        <div class="text-center p-3 copyright-bg d-flex align-items-center justify-content-center">
        <p id="cpy-yr" class="m-0"></p>
        <script>

            var date = new Date();
    
            var year = date.getFullYear();
    
            document.getElementById('cpy-yr').innerHTML = ('&copy; ' + year + ' Office of Planning and Development - CNMI Office of the Governor. All rights reserved.');
    
        </script>
        </div>
        <!-- copyright -->
    </footer>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-H3NYGH8LJ7"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-H3NYGH8LJ7');

    </script>

    <script>
        if (window.location.href.indexOf("/library") > -1) {
            //            alert("library");
            $('a[href^="./"]').each(function() {
                var oldUrl = $(this).attr("href"); // Get current url
                var newUrl = oldUrl.replace("./", "../../"); // Create new url
                $(this).attr("href", newUrl); // Set herf value
            });

            $('img[src^="./"]').each(function() {
                var oldSrc = $(this).attr("src"); // Get current url
                var newSrc = oldSrc.replace("./", "../../"); // Create new url
                $(this).attr("src", newSrc); // Set herf value
            });


        } else {

        };

    </script>

    <script>
        //Get the button
        var mybutton = document.getElementById("myBtn");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {
            scrollFunction();
        };

        function scrollFunction() {
            if (
                document.body.scrollTop < 20 ||
                document.documentElement.scrollTop < 20
            ) {
                mybutton.style.display = "none";
            } else {
                mybutton.style.display = "block";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }

    </script>

    <!--
    <script src="./assets/js/counter.js"></script>
    -->

</body>

</html>
