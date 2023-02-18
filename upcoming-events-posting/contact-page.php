<?php

error_reporting (E_ALL ^ E_NOTICE);
error_reporting (E_ERROR | E_PARSE);
date_default_timezone_set('Pacific/Saipan');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;

use League\OAuth2\Client\Provider\Google;

function filterParams($params)
{

    $chr_map = array(
       '\xC2\x82' => "'", // U+0082⇒U+201A single low-9 quotation mark
       '\xC2\x84' => '"', // U+0084⇒U+201E double low-9 quotation mark
       '\xC2\x8B' => "'", // U+008B⇒U+2039 single left-pointing angle quotation mark
       '\xC2\x91' => "'", // U+0091⇒U+2018 left single quotation mark
       '\xC2\x92' => "'", // U+0092⇒U+2019 right single quotation mark
       '\xC2\x93' => '"', // U+0093⇒U+201C left double quotation mark
       '\xC2\x94' => '"', // U+0094⇒U+201D right double quotation mark
       '\xC2\x9B' => "'", // U+009B⇒U+203A single right-pointing angle quotation mark
       '\xC2\xAB'     => '"', // U+00AB left-pointing double angle quotation mark
       '\xC2\xBB'     => '"', // U+00BB right-pointing double angle quotation mark
       '\xE2\x80\x98' => "'", // U+2018 left single quotation mark
       '\xE2\x80\x99' => "'", // U+2019 right single quotation mark
       '\xE2\x80\x9A' => "'", // U+201A single low-9 quotation mark
       '\xE2\x80\x9B' => "'", // U+201B single high-reversed-9 quotation mark
       '\xE2\x80\x9C' => '"', // U+201C left double quotation mark
       '\xE2\x80\x9D' => '"', // U+201D right double quotation mark
       '\xE2\x80\x9E' => '"', // U+201E double low-9 quotation mark
       '\xE2\x80\x9F' => '"', // U+201F double high-reversed-9 quotation mark
       '\xE2\x80\xB9' => "'", // U+2039 single left-pointing angle quotation mark
       '\xE2\x80\xBA' => "'", // U+203A single right-pointing angle quotation mark
       "\xC2\x82" => "'", // U+0082⇒U+201A single low-9 quotation mark
       "\xC2\x84" => '"', // U+0084⇒U+201E double low-9 quotation mark
       "\xC2\x8B" => "'", // U+008B⇒U+2039 single left-pointing angle quotation mark
       "\xC2\x91" => "'", // U+0091⇒U+2018 left single quotation mark
       "\xC2\x92" => "'", // U+0092⇒U+2019 right single quotation mark
       "\xC2\x93" => '"', // U+0093⇒U+201C left double quotation mark
       "\xC2\x94" => '"', // U+0094⇒U+201D right double quotation mark
       "\xC2\x9B" => "'", // U+009B⇒U+203A single right-pointing angle quotation mark
       "\xC2\xAB"     => '"', // U+00AB left-pointing double angle quotation mark
       "\xC2\xBB"     => '"', // U+00BB right-pointing double angle quotation mark
       "\xE2\x80\x98" => "'", // U+2018 left single quotation mark
       "\xE2\x80\x99" => "'", // U+2019 right single quotation mark
       "\xE2\x80\x9A" => "'", // U+201A single low-9 quotation mark
       "\xE2\x80\x9B" => "'", // U+201B single high-reversed-9 quotation mark
       "\xE2\x80\x9C" => '"', // U+201C left double quotation mark
       "\xE2\x80\x9D" => '"', // U+201D right double quotation mark
       "\xE2\x80\x9E" => '"', // U+201E double low-9 quotation mark
       "\xE2\x80\x9F" => '"', // U+201F double high-reversed-9 quotation mark
       "\xE2\x80\xB9" => "'", // U+2039 single left-pointing angle quotation mark
       "\xE2\x80\xBA" => "'", // U+203A single right-pointing angle quotation mark
    );

    $chr = array_keys  ($chr_map); // but: for efficiency you should
    $rpl = array_values($chr_map); // pre-calculate these two arrays

    foreach ($params as $key => $value)
    {

        if ($key == 'name' || $key == 'message')
        {

            $dirty[$key]    = html_entity_decode($value);
            $sanitize[$key] = str_replace($chr, $rpl, strip_tags($dirty[$key]));
            $clean[$key]    = filter_var($sanitize[$key], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK);

        } elseif ($key == 'email') {

            $sanitize[$key] = filter_var($value, FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
            $clean[$key]    = $sanitize[$key];

        }

    }

    return $clean;

}

function contactPage($params)
{

    require './assets/php/vendor/autoload.php';

    $mail = new PHPMailer();

    try
    {

        if (isset($_POST['submit']))
        {

            // smtp settings
            $mail->SMTPDebug    = SMTP::DEBUG_SERVER; // DEBUG_OFF = off | DEBUG_CLIENT = client messages | DEBUG_SERVER = client and server messages
            $mail->SMTPDebug    = 0; // 0 = off | 1 = on
            $mail->isSMTP();
            $mail->Host         = 'smtp.gmail.com';
            $mail->Port         = 587; // 465 for SMTP w/ implicit TLS | 587 for SMTP+STARTTLS
            $mail->SMTPSecure   = PHPMailer::ENCRYPTION_STARTTLS; // SMTPS for 465 | STARTTLS for 587
            $mail->SMTPAuth     = true; // use SMTP authentication
            $mail->AuthType     = 'XOAUTH2'; // set auth type
            
            // gmail xoauth credentials
            $params['smtpEmail']    = 'oitdevelopers@gmail.com';
            $params['clientID']     = '78223654482-n0liu2i0hsokkpje2mabpcr8dnj5goq8.apps.googleusercontent.com';
            $params['clientSecret'] = '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';
            $params['refreshToken'] = '1//0dbzPeua8GJpMCgYIARAAGA0SNwF-L9IrWuTtXGaLcl8OPgbwyjYL-DsKiLReco1KRqeCjvigpIsFqIjGN9pyEq_1Y9DqZv2J4O8';
            
            //Create a new OAuth2 provider instance
            $provider = new Google(
                [
                    'clientId'      => $params['clientID'],
                    'clientSecret'  => $params['clientSecret'],
                ]
            );
            
            //Pass the OAuth provider instance to PHPMailer
            $mail->setOAuth(
                new OAuth(
                    [
                        'provider'      => $provider,
                        'clientId'      => $params['clientID'],
                        'clientSecret'  => $params['clientSecret'],
                        'refreshToken'  => $params['refreshToken'],
                        'userName'      => $params['smtpEmail'],
                    ]
                )
            );
            
            // use gmail xoauth credentials
            $mail->oauthUserEmail       = $params['smtpEmail'];
            $mail->oauthClientId        = $params['clientID'];
            $mail->oauthClientSecret    = $params['clientSecret'];
            $mail->oauthRefreshToken    = $params['refreshToken'];
    
            $params['email']    = $_POST['email'];
            $params['name']     = $_POST['name'];
            $params['message']  = $_POST['message'];

            $clean              = filterParams($params);
    
            //Set who the message is to be sent from
            //For gmail, this generally needs to be the same as the user you logged in as
            $mail->setFrom($clean['email'], $clean['name']);
            
            //Set who the message is to be sent to
            $mail->addAddress('planning@opd.gov.mp');
            
            //Set the subject line
            $mail->Subject  = "Office of Planning and Development - You have received a message from ".$clean['name'];
            
            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            $mail->Body     = $clean['message'];
            
            //Replace the plain text body with one created manually
            $mail->AltBody  = 'This is a plain-text message body';
    
            $params['result'] = '';
    
            $params['result'] = "<p style='color: #28a745; font-weight: 600;'>Thank you, ". $clean['name'] .", for contacting us. We'll get back to you soon!</p>";
    
            if (!empty($clean['email']) && !empty($clean['name']) && !empty($clean['message']))
            {

                $params['msgSent'] = $mail->send();

            } else {

                $params['result'] = "<p style='color: #790000; font-weight: 600;'>Whoops! We're unable to send your message at this time! Please try again.</p>";

            }

        }

    } catch (Exception $e) {

        $params['result'] = "<p style='color: #790000; font-weight: 600;'>We're sorry, ".$clean['name'].". We're unable to send your message at this time! Please try again.</p>".$mail->ErrorInfo;

    }

    return $params;
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="EMAIL: info@opd.gov.mp PHONE: +1 670-664-2287/+1 670-488-1221 MAILING ADDRESS: Caller Box 10007 | Saipan, MP 96950">
    <meta name="keywords" content="opd, contact, info, telephone, tel, email, address, phone, information">
    <title>Contact Us | Office of Planning and Development</title>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />

    <link rel="canonical" href="https://opd.gov.mp/contact-page.php">

    <!-- cdn and etc stylesheets -->
    <link rel="stylesheet" href="./assets/vendor/font-awesome/css/all.min.css" />
    <link rel="stylesheet" href="./assets/css/animate.css" />
    <link rel="stylesheet" href="./assets/css/bootnavbar.css" />
    <link rel="stylesheet" href="./assets/css/bootstrap-icons.css" />
    <link rel="icon" href="./assets/img/logo-1.png" />
    <!-- main stylesheet -->
    <link rel="stylesheet" href="./assets/css/opd.css" />
    <script src="./assets/js/jquery-3.6.0.js"></script>

    <style>
        footer #myBtn {
            display: none;
        }
    </style>
</head>

<body>
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
            <section class="contact-form">
                <div class="container">
                    <h1>Contact Us</h1>
                    <div class="row">
                        <div class="col-lg-6">
                            <form action="" method="post" class="row g-3">
                                <div class="col-sm-12 col-md-12">
                                    <label for="validationDefault01" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" value="" name="name"  />
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <label for="validationDefault02" class="form-label">Email</label>
                                    <input type="email" class="form-control" value="" name="email"  />
                                </div>
                                <div class="col-sm-12 col-md-12 contact-message">
                                    <label for="validationTextarea" class="form-label">Your Message</label>
                                    <textarea class="form-control" id="validationTextarea" placeholder=""  name="message"></textarea>
                                    <p style='color: #28a745; font-weight: 600;'>
                                    <?php $params = contactPage($params); echo $params['result']; ?>
                                    </p>
                                    <button type="submit" name="submit" class="btn">Send</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6">
                            <div class="contact-right">
                                <h3>Our Contact Information</h3>
                                <div class="contact-mf-header">
                                    <i class="fas fa-phone"></i>
                                    <h4>Telephone</h4>
                                </div>
                                <p>+1 670-488-1221</p>
                                <div class="contact-mf-header">
                                    <i class="fas fa-envelope"></i>
                                    <h4>Email</h4>
                                </div>
                                <p>
                                    <script language=JavaScript type="text/javascript">
                                        var user = "planning";
                                        var host = "opd.gov.mp";
                                        var link = user + "@" + host;
                                        document.write("<a hre" + "f=mai" + "lto:" + user + "@" + host + ">" + link + "</a>");
                                    </script>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5" id="opdLocations">
                        <div class="col-lg-6 d-flex flex-column justify-content-center align-items-center" id="locationOne">
                            <h5><strong>Main Address:</strong></h5>
                            <p>Juan A. Sablan Memorial Building, Pagan Loop | Capitol Hill, Saipan</p>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d25899.806691078833!2d145.745309828586!3d15.2115628909139!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x66d8b0cb8a1de6c9%3A0x8e9b1ed60510f1c7!2sPagan+Loop%2C+Capitol+Hill%2C+Saipan+96950%2C+CNMI!5e0!3m2!1sen!2sus!4v1558558265713!5m2!1sen!2sus" frameborder="0" width="100%" height="500px"></iframe>
                        </div>
                        <div class="col-lg-6 d-flex flex-column justify-content-center align-items-center" id="locationTwo">
                            <h5><strong>Oleai Office Address:</strong></h5>
                            <p class="lt-p2"> (CDA) Building, Room 308 | Oleai, Saipan</p>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1925.4154084270424!2d145.7095317340052!3d15.167633203452324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTXCsDEwJzAzLjUiTiAxNDXCsDQyJzM3LjciRQ!5e0!3m2!1sen!2s!4v1560213257165!5m2!1sen!2s" frameborder="0" width="100%" height="500px"></iframe>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!-- footer -->
    <footer class="mt-auto">
        <div class="footer" class="index-footer"></div>
        <script>
            $(function() {
                $(".footer").load("./footer.html");
            });
        </script>
    </footer>

    <!-- scripts -->
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
