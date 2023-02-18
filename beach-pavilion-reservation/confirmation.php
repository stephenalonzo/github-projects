<?php 

require_once ('./controller.php');

$params = reservationError($params);

if ($params['rowCount'] > 0) {

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reservation Confirmation - Division of Parks &amp; Recreation | Department of Lands and Natural Resources</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
</head>

<body style="font-family: Inter, sans-serif !important;">
    <main style="background: #f4f3ee !important;">
        <section class="email">
            <div style="padding: 24px 16px;">
                <div style="margin: 0px auto; display: flex; justify-content: center; align-items: center;">
                    <img src="https://dev.dlnr.cnmi.gov/assets/img/dlnr.png" alt="" style="max-width: 150px;">
                </div>
            </div>
            <hr style="opacity: 0.5; width: 50%;">
            <div style="padding: 0px 16px 24px 16px;">
                <div style="color: #000 !important; width: 50%; margin: 0 auto;">
                <?php
                
                $results = getConfirmationDetails($params);

                foreach ($results as $row) {
                
                ?>
                    <h1 style="font-size: 1.25rem; margin: 1.5rem auto;">Hafa Adai,</h1>
                    <p style="text-align: justify; margin: 1.5rem auto;">
                        Thank you for reserving with the <b>Department of Lands and Natural Resources</b> - <b>Division of Parks and Recreation</b>! Below are your reservation details. 
                    </p>
                    <p>Location: <?php echo $row['pavName']; ?></p>
                    <p>Confirmation ID: <?php echo $row['confirmID']; ?></p>
                <?php } ?>
                </div>
            </div>
        </section>
    </main>
</body>

</html>

<?php } else { ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reservation Confirmation - Division of Parks &amp; Recreation | Department of Lands and Natural Resources</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
</head>

<body style="font-family: Inter, sans-serif !important;">
    <main style="background: #f4f3ee !important;">
        <section class="email">
            <div style="padding: 24px 16px;">
                <div style="margin: 0px auto; display: flex; justify-content: center; align-items: center;">
                    <img src="https://dev.dlnr.cnmi.gov/assets/img/dlnr.png" alt="" style="max-width: 150px;">
                </div>
            </div>
            <hr style="opacity: 0.5; width: 50%;">
            <div style="padding: 0px 16px 24px 16px;">
                <div style="color: #000 !important; width: 50%; margin: 0 auto;">
                    <h1 style="font-size: 1.25rem; margin: 1.5rem auto;">Whoops!</h1>
                    <p>This reservation does not exist! If this is not right, please call us immediately at: <b>(670) 664-6000</b></p>
                </div>
            </div>
        </section>
    </main>
</body>

</html>

<?php } ?>