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
    <link rel="stylesheet" href="../../assets/css/opd.css" />
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
                <div class="text-center col-lg-4 mb-4 mb-md-0 footer-top">
                    <a href="https://governor.gov.mp/"><img src="../../includes/gov.png" alt="..." height="100px" /></a>
                    <a href="../../index.html"><img src="../../includes/opd_color.png" height="125px" alt="..." /></a>

                </div>

                <div class="text-center col-lg-4 mb-4 mb-md-0 footer-top">
                    <div class="footer-style">
                        <h1>Our website has been viewed</h1>
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
                        <h2 class="fs-1">times</h2>
                    </div>
                </div>
                <div class="text-center col-lg-4 mb-4 mb-md-0 social-media">
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
    <script src="../../assets/js/counter.js"></script>
    -->

</body>

</html>
