<?php

error_reporting (E_ALL ^ E_NOTICE);
error_reporting(E_ERROR | E_PARSE);
date_default_timezone_set('Pacific/Saipan');

function viewEvent()
{

    $pdo = new PDO("mysql:host=localhost;dbname=github_projects", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    
    $params['id'] = $_GET['id'];

    $params['dba']['s'] = "SELECT * FROM events WHERE id = :id";
    $stmt = $pdo->prepare($params['dba']['s']);
    $stmt->bindParam(':id', $params['id']);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;

}

?>

<!DOCTYPE html>
<html>

<head>
    <title>AddEvent</title>
    <meta name="Description" content="" />
    <meta name="Keywords" content="" />
    <meta name="Author" content="AddEvent" />

    <meta charset="utf-8" />

    <!-- AddEvent theme css -->
    <link rel="stylesheet" href="./assets/css/theme.css" />

    <!-- AddEvent -->
    <script type="text/javascript" src="./assets/js/atc.min.js" async defer></script>
    <script type="text/javascript">
        window.addeventasync = function () {
            addeventatc.settings({
                license: "USER-CLIENT-ID",
                css: false,
            });
        };
    </script>
</head>

<body>
    <!-- A little padding applied (just for purpose of this demo) -->
    <main>
        <!-- AddEvent button -->
        <div title="Add to Calendar" class="addeventatc">
            Add to Calendar
            <span class="addeventatc_icon" style="color: white"></span>
            <?php

            $results = viewEvent();
            
            foreach ($results as $row)
            
            {
            
            ?>
            <span class="start">
                <?php
                
                if($row['allDay'] == 1)
                {

                    echo date('m/d/Y', strtotime($row['startDate'])); 

                } else {

                    echo date('m/d/Y h:iA', strtotime($row['startDate'])); 

                }
                
                ?>
            </span>
            <span class="end">
                <?php
                
                if($row['allDay'] == 1)
                {

                    echo date('m/d/Y', strtotime($row['endDate'])); 

                } else {

                    echo date('m/d/Y h:iA', strtotime($row['endDate'])); 

                }
                
                ?>
            </span>
            <span class="timezone">Pacific/Saipan</span>
            <span class="title"><?php echo $row['eventTitle']; ?></span>
            <span class="description">
                <p>
                    <?php echo $row['eventDesc']; ?>
                </p>
            </span>
            <span class="all_day_event">
                <?php
                
                    if($row['allDay'] == 1)
                    {

                        echo 'true';

                    } else {

                        echo 'false';

                    }
                
                ?>
            </span>
            
            <?php } ?>
            <span class="location">Northern Marianas Islands</span>
            <span class="organizer">Office of Planning and Development</span>
            <span class="organizer_email">planning@opd.gov.mp</span>
        </div>
    </main>
</body>

</html>