<?php

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  if(isset($_POST['submit'])) {
  
    
  require_once 'assets/php/Exception.php';
  require_once 'assets/php/PHPMailer.php';
  require_once 'assets/php/SMTP.php';
  
  $mail = new PHPMailer(true);

  try {
    // Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   //Enable verbose debug output
    $mail->SMTPDebug = 0;
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'oitdevteam21@gmail.com';                     //SMTP username
    $mail->Password   = '01T@devteam2021';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
  
    $name = $_POST['name_404'];
    $userEmail = $_POST['email_404'];
    $message = $_POST['request_404'];
  
    //Recipients
    $mail->setFrom($userEmail, $name);     //Add a recipient
    $mail->addAddress('oitdevelopers@gmail.com');               //Name is optional
    //$mail->addAddress('planning@opd.gov.mp');               //Name is optional
    $mail->addReplyTo($userEmail, $name);
  
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Office of Planning and Development - 404 Error: Request for Missing Content!';
    $mail->Body    = $message;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
  
    $mail->send();
    $result = "Thank you, ". $name .", for contacting us. We'll get back to you soon!";
  } catch (Exception $e) {
     $result = "Something went wrong. Please try again.";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>404 Error | Office of Planning and Development </title>

    <!-- Font Awesome Stylsheets -->
    <link href="./assets/vendor/font-awesome/css/brands.min.css" rel="stylesheet" />
    <link href="./assets/vendor/font-awesome/css/solid.min.css" rel="stylesheet" />
    <link href="./assets/vendor/font-awesome/css/all.min.css" rel="stylesheet" />

    <!-- Vendor Stylesheets -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/css/animate.css" />
    <link rel="icon" href="./assets/img/logo-1.png" />

    <!-- Main Stylesheets -->
    <link rel="stylesheet" href="./assets/css/theme.css" type="text/css" media="all" />
    <link rel="stylesheet" href="./assets/css/opd.css" />

    <script src="./assets/js/jquery-3.6.0.js"></script>
    <script src="./assets/js/atc.min.js"></script>
</head>

<body>
    <!-- Sticky Navbar -->
    <header class="sticky-top">
        <div class="nav"></div>

        <script>
            $(function() {
                $(".nav").load("./nav.html");
            });

        </script>
    </header>

    <main id="page-container-eo">
        <div id="content-wrap-eo">
            <section id="page-404">
                <div class="container">
                    <div class="page-404-body mt-3">
                        <h3>404 - Something went wrong!</h3>
                        <p>The page you were looking for does not exist! Click <a href="./index.html">here</a> to return
                            to the home page.</p>
                        <p>Or, you can submit the form below requesting for the content, document, URL, etc.
                            that you were looking
                            for.</p>
                        <form action="" method="POST" class="mt-5" id="form-404">
                            <div class="mb-3">
                                <label for="name_404" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name_404" name="name_404" placeholder="Your Full Name">
                            </div>
                            <div class="mb-3">
                                <label for="email_404" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email_404" name="email_404" placeholder="email@example.com">
                            </div>
                            <div class="mb-3">
                                <label for="request_404" class="form-label mb-0">Information Requested</label>
                                <p class="mt-0">The content, document or URL of the page you are looking for.</p>
                                <textarea class="form-control" id="request_404" name="request_404" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" form="form-404">Submit</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <!-- Footer -->

    <footer class="mt-auto">
        <div class="footer"></div>
        <script>
            $(function() {
                $(".footer").load("./footer.html");
            });

        </script>
    </footer>

    <!-- Main Scripts -->
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/bootnavbar.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#bootnavbar").bootnavbar();
        });

    </script>
</body>

</html>
