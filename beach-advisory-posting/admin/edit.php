<?php

require_once('./app-header.php');
require_once('./app-authorization.php');
require_once('./app-functions.php');

if (!isset($_GET['advisory']))
{

    // do nothing

} else {

    $params['advisory'] = $_GET['advisory'];
    $params['dba']['s'] = "SELECT * FROM advisory WHERE id = :id";
    
    $params['bindParam'] = array(
        ':id' => $params['advisory']
    );

    $stmt = dbAccess($params);
        
    $results = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beach Advisory Tool | Bureau of Environmental Coastal Quality</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/app.js"></script>
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <div class="content w-75 mx-auto">
                <form action="" method="POST" id="advisoryForm">
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <select class="form-select h-100" name="title" id="advTitle" aria-label="Default select example" required>
                                <!-- <option value="" selected disabled>Title of Report</option>
                                <option value="1">Saipan West Beaches Marine Water Quality Report</option>
                                <option value="2">Saipan East Beaches Marine Water Quality Report</option>
                                <option value="3">Tinian Marine Water Quality Report</option>
                                <option value="4">Rota Marine Water Quality Report</option>
                                <option value="5">Managaha Marine Water Quality Report</option> -->
                                <?php 
                                
                                switch ($results['advisoryTitle'])
                                {

                                    case "Saipan West Beaches Marine Water Quality Report":
                                        echo '<option value="" disabled>Title of Report</option>
                                        <option value="1" selected>Saipan West Beaches Marine Water Quality Report</option>
                                        <option value="2">Saipan East Beaches Marine Water Quality Report</option>
                                        <option value="3">Tinian Marine Water Quality Report</option>
                                        <option value="4">Rota Marine Water Quality Report</option>
                                        <option value="5">Managaha Marine Water Quality Report</option>';
                                        break;

                                    case "Saipan East Beaches Marine Water Quality Report":
                                        echo '<option value="" disabled>Title of Report</option>
                                        <option value="1">Saipan West Beaches Marine Water Quality Report</option>
                                        <option value="2" selected>Saipan East Beaches Marine Water Quality Report</option>
                                        <option value="3">Tinian Marine Water Quality Report</option>
                                        <option value="4">Rota Marine Water Quality Report</option>
                                        <option value="5">Managaha Marine Water Quality Report</option>';
                                        break;

                                    case "Tinian Marine Water Quality Report":
                                        echo '<option value="" disabled>Title of Report</option>
                                        <option value="1">Saipan West Beaches Marine Water Quality Report</option>
                                        <option value="2">Saipan East Beaches Marine Water Quality Report</option>
                                        <option value="3" selected>Tinian Marine Water Quality Report</option>
                                        <option value="4">Rota Marine Water Quality Report</option>
                                        <option value="5">Managaha Marine Water Quality Report</option>';
                                        break;

                                    case "Rota Marine Water Quality Report":
                                        echo '<option value="" disabled>Title of Report</option>
                                        <option value="1">Saipan West Beaches Marine Water Quality Report</option>
                                        <option value="2">Saipan East Beaches Marine Water Quality Report</option>
                                        <option value="3">Tinian Marine Water Quality Report</option>
                                        <option value="4" selected>Rota Marine Water Quality Report</option>
                                        <option value="5">Managaha Marine Water Quality Report</option>';
                                        break;

                                    case "Managaha Marine Water Quality Report":
                                        echo '<option value="" disabled>Title of Report</option>
                                        <option value="1">Saipan West Beaches Marine Water Quality Report</option>
                                        <option value="2">Saipan East Beaches Marine Water Quality Report</option>
                                        <option value="3">Tinian Marine Water Quality Report</option>
                                        <option value="4">Rota Marine Water Quality Report</option>
                                        <option value="5" selected>Managaha Marine Water Quality Report</option>';
                                        break;

                                }
                                
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <input type="date" name="date" class="form-control" placeholder="" id="" value="<?php echo date('Y-m-d', strtotime($results ['advisoryDate'])); ?>" required></input>
                                <label for="">Date</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="status" aria-label="" id="selectStatus" required>
                            <!-- <option value="" selected disabled>Beach Advisory Status</option>
                            <option value="GF">Green Flag</option>
                            <option value="RF">Red Flag</option> -->
                            <?php 
                            
                            switch ($results['advisorySts'])
                            {

                                case "Green Flag":
                                    echo '<option value="" disabled>Beach Advisory Status</option>
                                    <option value="GF" selected>Green Flag</option>
                                    <option value="RF">Red Flag</option>';
                                    break;

                                case "Red Flag":
                                    echo '<option value="" disabled>Beach Advisory Status</option>
                                    <option value="GF">Green Flag</option>
                                    <option value="RF" selected>Red Flag</option>';
                                    break;
                                
                            }
                            
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="advDesc" required>
                            <?php echo $results['advisoryDesc']; ?>
                        </textarea>
                    </div>

                    <?php 

                    $locations = $results['advisoryLocations'];
                    $locArr = explode(' ', trim($locations));
                    
                    switch (str_word_count($results['advisoryLocations']))
                    {
                        
                        case 3:
                            echo 
                            '<div id="trioOne">
                                <input type="text" name="loc[]" id="locOne" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[0]).'">
                                <input type="text" name="loc[]" id="locTwo" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[1]).'">
                                <input type="text" name="loc[]" id="locThree" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[2]).'">
                            </div>';
                            break;

                        case 6:
                            echo 
                            '<div id="trioOne">
                                <input type="text" name="loc[]" id="locOne" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[0]).'">
                                <input type="text" name="loc[]" id="locTwo" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[1]).'">
                                <input type="text" name="loc[]" id="locThree" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[2]).'">
                            </div>
                            
                            <div id="trioTwo">
                                <input type="text" name="loc[]" id="locFour" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[3]).'">
                                <input type="text" name="loc[]" id="locFive" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[4]).'">
                                <input type="text" name="loc[]" id="locSix" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[5]).'">
                            </div>';
                            break;

                        case 9:
                            echo 
                            '<div id="trioOne">
                                <input type="text" name="loc[]" id="locOne" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[0]).'">
                                <input type="text" name="loc[]" id="locTwo" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[1]).'">
                                <input type="text" name="loc[]" id="locThree" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[2]).'">
                            </div>
                            
                            <div id="trioTwo">
                                <input type="text" name="loc[]" id="locFour" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[3]).'">
                                <input type="text" name="loc[]" id="locFive" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[4]).'">
                                <input type="text" name="loc[]" id="locSix" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[5]).'">
                            </div>
                        
                            <div id="trioThree">
                                <input type="text" name="loc[]" id="locSeven" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[6]).'">
                                <input type="text" name="loc[]" id="locEight" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[7]).'">
                                <input type="text" name="loc[]" id="locNine" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[8]).'">
                            </div>';
                            break;

                        case 12:
                            echo 
                            '<div id="trioOne">
                                <input type="text" name="loc[]" id="locOne" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[0]).'">
                                <input type="text" name="loc[]" id="locTwo" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[1]).'">
                                <input type="text" name="loc[]" id="locThree" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[2]).'">
                            </div>
                            
                            <div id="trioTwo">
                                <input type="text" name="loc[]" id="locFour" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[3]).'">
                                <input type="text" name="loc[]" id="locFive" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[4]).'">
                                <input type="text" name="loc[]" id="locSix" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[5]).'">
                            </div>
                        
                            <div id="trioThree">
                                <input type="text" name="loc[]" id="locSeven" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[6]).'">
                                <input type="text" name="loc[]" id="locEight" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[7]).'">
                                <input type="text" name="loc[]" id="locNine" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[8]).'">
                            </div>
                    
                            <div id="trioFour">
                                <input type="text" name="loc[]" id="locTen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[9]).'">
                                <input type="text" name="loc[]" id="locEleven" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[10]).'">
                                <input type="text" name="loc[]" id="locTwelve" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[11]).'">
                            </div>';
                            break;

                        case 15:
                            echo 
                            '<div id="trioOne">
                                <input type="text" name="loc[]" id="locOne" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[0]).'">
                                <input type="text" name="loc[]" id="locTwo" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[1]).'">
                                <input type="text" name="loc[]" id="locThree" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[2]).'">
                            </div>
                        
                            <div id="trioTwo">
                                <input type="text" name="loc[]" id="locFour" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[3]).'">
                                <input type="text" name="loc[]" id="locFive" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[4]).'">
                                <input type="text" name="loc[]" id="locSix" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[5]).'">
                            </div>
                    
                            <div id="trioThree">
                                <input type="text" name="loc[]" id="locSeven" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[6]).'">
                                <input type="text" name="loc[]" id="locEight" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[7]).'">
                                <input type="text" name="loc[]" id="locNine" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[8]).'">
                            </div>
                
                            <div id="trioFour">
                                <input type="text" name="loc[]" id="locTen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[9]).'">
                                <input type="text" name="loc[]" id="locEleven" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[10]).'">
                                <input type="text" name="loc[]" id="locTwelve" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[11]).'">
                            </div>
            
                            <div id="trioFive">
                                <input type="text" name="loc[]" id="locThirteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[12]).'">
                                <input type="text" name="loc[]" id="locFourteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[13]).'">
                                <input type="text" name="loc[]" id="locFifteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[14]).'">
                            </div>';
                            break;

                        case 18:
                            echo 
                            '<div id="trioOne">
                                <input type="text" name="loc[]" id="locOne" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", str_replace(",", "", $locArr[0])).'">
                                <input type="text" name="loc[]" id="locTwo" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[1]).'">
                                <input type="text" name="loc[]" id="locThree" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[2]).'">
                            </div>
                    
                            <div id="trioTwo">
                                <input type="text" name="loc[]" id="locFour" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[3]).'">
                                <input type="text" name="loc[]" id="locFive" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[4]).'">
                                <input type="text" name="loc[]" id="locSix" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[5]).'">
                            </div>
                
                            <div id="trioThree">
                                <input type="text" name="loc[]" id="locSeven" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[6]).'">
                                <input type="text" name="loc[]" id="locEight" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[7]).'">
                                <input type="text" name="loc[]" id="locNine" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[8]).'">
                            </div>
            
                            <div id="trioFour">
                                <input type="text" name="loc[]" id="locTen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[9]).'">
                                <input type="text" name="loc[]" id="locEleven" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[10]).'">
                                <input type="text" name="loc[]" id="locTwelve" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[11]).'">
                            </div>
        
                            <div id="trioFive">
                                <input type="text" name="loc[]" id="locThirteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[12]).'">
                                <input type="text" name="loc[]" id="locFourteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[13]).'">
                                <input type="text" name="loc[]" id="locFifteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[14]).'">
                            </div>
    
                            <div id="trioSix">
                                <input type="text" name="loc[]" id="locSixteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[15]).'">
                                <input type="text" name="loc[]" id="locSeventeen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[16]).'">
                                <input type="text" name="loc[]" id="locEighteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[17]).'">
                            </div>';
                            break;

                        case 21:
                            echo 
                            '<div id="trioOne">
                                <input type="text" name="loc[]" id="locOne" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[0]).'">
                                <input type="text" name="loc[]" id="locTwo" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[1]).'">
                                <input type="text" name="loc[]" id="locThree" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[2]).'">
                                <div class="form-check mb-3" id="initOne">
                                    <input class="form-check-input" type="checkbox" value="" id="addTrioTwo">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Add More Locations
                                    </label>
                                </div>
                            </div>
                        
                            <div id="trioTwo">
                                <input type="text" name="loc[]" id="locFour" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[3]).'">
                                <input type="text" name="loc[]" id="locFive" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[4]).'">
                                <input type="text" name="loc[]" id="locSix" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[5]).'">
                                <div id="initTwo" class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="addTrioThree" value="">
                                        <label class="form-check-label" for="">Add More Locations</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="clearSecond" value="">
                                        <label class="form-check-label" for="">Clear</label>
                                    </div>
                                </div>
                            </div>
                    
                            <div id="trioThree">
                                <input type="text" name="loc[]" id="locSeven" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[6]).'">
                                <input type="text" name="loc[]" id="locEight" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[7]).'">
                                <input type="text" name="loc[]" id="locNine" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[8]).'">
                                <div id="initThree" class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="addTrioFour" value="">
                                        <label class="form-check-label" for="">
                                            Add More Locations
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="clearThird" value="">
                                        <label class="form-check-label" for="">Clear</label>
                                    </div>
                                </div>
                            </div>
                
                            <div id="trioFour">
                                <input type="text" name="loc[]" id="locTen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[9]).'">
                                <input type="text" name="loc[]" id="locEleven" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[10]).'">
                                <input type="text" name="loc[]" id="locTwelve" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[11]).'">
                                <div id="initFour" class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="addTrioFive" value="">
                                        <label class="form-check-label" for="">
                                            Add More Locations
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="clearFourth" value="">
                                        <label class="form-check-label" for="">Clear</label>
                                    </div>
                                </div>
                            </div>
            
                            <div id="trioFive">
                                <input type="text" name="loc[]" id="locThirteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[12]).'">
                                <input type="text" name="loc[]" id="locFourteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[13]).'">
                                <input type="text" name="loc[]" id="locFifteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[14]).'">
                                <div id="initFive" class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="addTrioSix" value="">
                                        <label class="form-check-label" for="">Add More Locations</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="clearFifth" value="">
                                        <label class="form-check-label" for="">Clear</label>
                                    </div>
                                </div>
                            </div>
        
                            <div id="trioSix">
                                <input type="text" name="loc[]" id="locSixteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[15]).'">
                                <input type="text" name="loc[]" id="locSeventeen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[16]).'">
                                <input type="text" name="loc[]" id="locEighteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[17]).'">
                                <div id="initSix" style="display: none;">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="addTrioSeven" value="">
                                        <label class="form-check-label" for="">Add More Locations</label>
                                    </div>
                                    <div class="form-check mb-3 form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="clearSixth" value="">
                                        <label class="form-check-label" for="">Clear</label>
                                    </div>
                                </div>
                            </div>
                                
                            <div id="trioSeven">
                                <input type="text" name="loc[]" id="locSixteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[18]).'">
                                <input type="text" name="loc[]" id="locSeventeen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[19]).'">
                                <input type="text" name="loc[]" id="locEighteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[20]).'">
                                <div id="initSeven" style="display: none;">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="addTrioEight" value="">
                                        <label class="form-check-label" for="">Add More Locations</label>
                                    </div>
                                    <div class="form-check mb-3 form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="clearSeventh" value="">
                                        <label class="form-check-label" for="">Clear</label>
                                    </div>
                                </div>
                            </div>';
                            break;

                            case 24:
                                echo 
                                '<div id="trioOne">
                                    <input type="text" name="loc[]" id="locOne" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[0]).'">
                                    <input type="text" name="loc[]" id="locTwo" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[1]).'">
                                    <input type="text" name="loc[]" id="locThree" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[2]).'">
                                    <div class="form-check mb-3" id="initOne">
                                        <input class="form-check-input" type="checkbox" value="" id="addTrioTwo">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Add More Locations
                                        </label>
                                    </div>
                                </div>
                            
                                <div id="trioTwo">
                                    <input type="text" name="loc[]" id="locFour" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[3]).'">
                                    <input type="text" name="loc[]" id="locFive" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[4]).'">
                                    <input type="text" name="loc[]" id="locSix" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[5]).'">
                                    <div id="initTwo" class="mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="addTrioThree" value="">
                                            <label class="form-check-label" for="">Add More Locations</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="clearSecond" value="">
                                            <label class="form-check-label" for="">Clear</label>
                                        </div>
                                    </div>
                                </div>
                        
                                <div id="trioThree">
                                    <input type="text" name="loc[]" id="locSeven" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[6]).'">
                                    <input type="text" name="loc[]" id="locEight" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[7]).'">
                                    <input type="text" name="loc[]" id="locNine" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[8]).'">
                                    <div id="initThree" class="mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="addTrioFour" value="">
                                            <label class="form-check-label" for="">Add More Locations</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="clearThird" value="">
                                            <label class="form-check-label" for="">Clear</label>
                                        </div>
                                    </div>
                                </div>
                    
                                <div id="trioFour">
                                    <input type="text" name="loc[]" id="locTen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[9]).'">
                                    <input type="text" name="loc[]" id="locEleven" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[10]).'">
                                    <input type="text" name="loc[]" id="locTwelve" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[11]).'">
                                    <div id="initFour" class="mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="addTrioFive" value="">
                                            <label class="form-check-label" for="">Add More Locations</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="clearFourth" value="">
                                            <label class="form-check-label" for="">Clear</label>
                                        </div>
                                    </div>
                                </div>
                
                                <div id="trioFive">
                                    <input type="text" name="loc[]" id="locThirteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[12]).'">
                                    <input type="text" name="loc[]" id="locFourteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[13]).'">
                                    <input type="text" name="loc[]" id="locFifteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[14]).'">
                                    <div id="initFive" class="mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="addTrioSix" value="">
                                            <label class="form-check-label" for="">Add More Locations</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="clearFifth" value="">
                                            <label class="form-check-label" for="">Clear</label>
                                        </div>
                                    </div>
                                </div>
            
                                <div id="trioSix">
                                    <input type="text" name="loc[]" id="locSixteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[15]).'">
                                    <input type="text" name="loc[]" id="locSeventeen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[16]).'">
                                    <input type="text" name="loc[]" id="locEighteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[17]).'">
                                    <div id="initSix" style="display: none;">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="addTrioSeven" value="">
                                            <label class="form-check-label" for="">Add More Locations</label>
                                        </div>
                                        <div class="form-check mb-3 form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="clearSixth" value="">
                                            <label class="form-check-label" for="">Clear</label>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div id="trioSeven">
                                    <input type="text" name="loc[]" id="locSixteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[18]).'">
                                    <input type="text" name="loc[]" id="locSeventeen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[19]).'">
                                    <input type="text" name="loc[]" id="locEighteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[20]).'">
                                    <div id="initSeven" style="display: none;">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="addTrioEight" value="">
                                            <label class="form-check-label" for="">Add More Locations</label>
                                        </div>
                                        <div class="form-check mb-3 form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="clearSeventh" value="">
                                            <label class="form-check-label" for="">Clear</label>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div id="trioEight">
                                    <input type="text" name="loc[]" id="locTwentyTwo" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[21]).'">
                                    <input type="text" name="loc[]" id="locTwentyThree" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[22]).'">
                                    <input type="text" name="loc[]" id="locTwentyFour" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[23]).'">
                                    <div id="initEight" style="display: none;">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="addTrioNine" value="">
                                            <label class="form-check-label" for="">Add More Locations</label>
                                        </div>
                                        <div class="form-check mb-3 form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="clearEighth" value="">
                                            <label class="form-check-label" for="">Clear</label>
                                        </div>
                                    </div>
                                </div>';
                                break;

                                case 27:
                                    echo 
                                    '<div id="trioOne">
                                        <input type="text" name="loc[]" id="locOne" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[0]).'">
                                        <input type="text" name="loc[]" id="locTwo" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[1]).'">
                                        <input type="text" name="loc[]" id="locThree" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[2]).'">
                                        <div class="form-check mb-3" id="initOne">
                                            <input class="form-check-input" type="checkbox" value="" id="addTrioTwo">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Add More Locations
                                            </label>
                                        </div>
                                    </div>
                                
                                    <div id="trioTwo">
                                        <input type="text" name="loc[]" id="locFour" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[3]).'">
                                        <input type="text" name="loc[]" id="locFive" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[4]).'">
                                        <input type="text" name="loc[]" id="locSix" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[5]).'">
                                        <div id="initTwo" class="mb-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="addTrioThree" value="">
                                                <label class="form-check-label" for="">Add More Locations</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="clearSecond" value="">
                                                <label class="form-check-label" for="">Clear</label>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div id="trioThree">
                                        <input type="text" name="loc[]" id="locSeven" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[6]).'">
                                        <input type="text" name="loc[]" id="locEight" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[7]).'">
                                        <input type="text" name="loc[]" id="locNine" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[8]).'">
                                        <div id="initThree" class="mb-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="addTrioFour" value="">
                                                <label class="form-check-label" for="">Add More Locations</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="clearThird" value="">
                                                <label class="form-check-label" for="">Clear</label>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <div id="trioFour">
                                        <input type="text" name="loc[]" id="locTen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[9]).'">
                                        <input type="text" name="loc[]" id="locEleven" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[10]).'">
                                        <input type="text" name="loc[]" id="locTwelve" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[11]).'">
                                        <div id="initFour" class="mb-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="addTrioFive" value="">
                                                <label class="form-check-label" for="">Add More Locations</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="clearFourth" value="">
                                                <label class="form-check-label" for="">Clear</label>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div id="trioFive">
                                        <input type="text" name="loc[]" id="locThirteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[12]).'">
                                        <input type="text" name="loc[]" id="locFourteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[13]).'">
                                        <input type="text" name="loc[]" id="locFifteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[14]).'">
                                        <div id="initFive" class="mb-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="addTrioSix" value="">
                                                <label class="form-check-label" for="">Add More Locations</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="clearFifth" value="">
                                                <label class="form-check-label" for="">Clear</label>
                                            </div>
                                        </div>
                                    </div>
                
                                    <div id="trioSix">
                                        <input type="text" name="loc[]" id="locSixteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[15]).'">
                                        <input type="text" name="loc[]" id="locSeventeen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[16]).'">
                                        <input type="text" name="loc[]" id="locEighteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[17]).'">
                                        <div id="initSix" style="display: none;">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="addTrioSeven" value="">
                                                <label class="form-check-label" for="">Add More Locations</label>
                                            </div>
                                            <div class="form-check mb-3 form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="clearSixth" value="">
                                                <label class="form-check-label" for="">Clear</label>
                                            </div>
                                        </div>
                                    </div>
                                        
                                    <div id="trioSeven">
                                        <input type="text" name="loc[]" id="locSixteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[18]).'">
                                        <input type="text" name="loc[]" id="locSeventeen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[19]).'">
                                        <input type="text" name="loc[]" id="locEighteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[20]).'">
                                        <div id="initSeven" style="display: none;">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="addTrioEight" value="">
                                                <label class="form-check-label" for="">Add More Locations</label>
                                            </div>
                                            <div class="form-check mb-3 form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="clearSeventh" value="">
                                                <label class="form-check-label" for="">Clear</label>
                                            </div>
                                        </div>
                                    </div>
                                        
                                    <div id="trioEight">
                                        <input type="text" name="loc[]" id="locTwentyTwo" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[21]).'">
                                        <input type="text" name="loc[]" id="locTwentyThree" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[22]).'">
                                        <input type="text" name="loc[]" id="locTwentyFour" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[23]).'">
                                        <div id="initEight" style="display: none;">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="addTrioNine" value="">
                                                <label class="form-check-label" for="">Add More Locations</label>
                                            </div>
                                            <div class="form-check mb-3 form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="clearEighth" value="">
                                                <label class="form-check-label" for="">Clear</label>
                                            </div>
                                        </div>
                                    </div>
                                        
                                    <div id="trioNine" style="display: none;">
                                        <input type="text" name="loc[]" id="locTwentyFive" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[24]).'">
                                        <input type="text" name="loc[]" id="locTwentySix" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[25]).'">
                                        <input type="text" name="loc[]" id="locTwentySeven" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[26]).'">
                                        <div id="initNine" style="display: none;">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="addTrioTen" value="">
                                                <label class="form-check-label" for="">Add More Locations</label>
                                            </div>
                                            <div class="form-check mb-3 form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="clearNinth" value="">
                                                <label class="form-check-label" for="">Clear</label>
                                            </div>
                                        </div>
                                    </div>';
                                    break;

                                    case 30:
                                        echo 
                                        '<div id="trioOne">
                                            <input type="text" name="loc[]" id="locOne" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[0]).'">
                                            <input type="text" name="loc[]" id="locTwo" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[1]).'">
                                            <input type="text" name="loc[]" id="locThree" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[2]).'">
                                            <div class="form-check mb-3" id="initOne">
                                                <input class="form-check-input" type="checkbox" value="" id="addTrioTwo">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Add More Locations
                                                </label>
                                            </div>
                                        </div>
                                    
                                        <div id="trioTwo">
                                            <input type="text" name="loc[]" id="locFour" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[3]).'">
                                            <input type="text" name="loc[]" id="locFive" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[4]).'">
                                            <input type="text" name="loc[]" id="locSix" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[5]).'">
                                            <div id="initTwo" class="mb-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="addTrioThree" value="">
                                                    <label class="form-check-label" for="">Add More Locations</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="clearSecond" value="">
                                                    <label class="form-check-label" for="">Clear</label>
                                                </div>
                                            </div>
                                        </div>
                                
                                        <div id="trioThree">
                                            <input type="text" name="loc[]" id="locSeven" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[6]).'">
                                            <input type="text" name="loc[]" id="locEight" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[7]).'">
                                            <input type="text" name="loc[]" id="locNine" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[8]).'">
                                            <div id="initThree" class="mb-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="addTrioFour" value="">
                                                    <label class="form-check-label" for="">Add More Locations</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="clearThird" value="">
                                                    <label class="form-check-label" for="">Clear</label>
                                                </div>
                                            </div>
                                        </div>
                            
                                        <div id="trioFour">
                                            <input type="text" name="loc[]" id="locTen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[9]).'">
                                            <input type="text" name="loc[]" id="locEleven" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[10]).'">
                                            <input type="text" name="loc[]" id="locTwelve" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[11]).'">
                                            <div id="initFour" class="mb-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="addTrioFive" value="">
                                                    <label class="form-check-label" for="">Add More Locations</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="clearFourth" value="">
                                                    <label class="form-check-label" for="">Clear</label>
                                                </div>
                                            </div>
                                        </div>
                        
                                        <div id="trioFive">
                                            <input type="text" name="loc[]" id="locThirteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[12]).'">
                                            <input type="text" name="loc[]" id="locFourteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[13]).'">
                                            <input type="text" name="loc[]" id="locFifteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[14]).'">
                                            <div id="initFive" class="mb-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="addTrioSix" value="">
                                                    <label class="form-check-label" for="">Add More Locations</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="clearFifth" value="">
                                                    <label class="form-check-label" for="">Clear</label>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div id="trioSix">
                                            <input type="text" name="loc[]" id="locSixteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[15]).'">
                                            <input type="text" name="loc[]" id="locSeventeen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[16]).'">
                                            <input type="text" name="loc[]" id="locEighteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[17]).'">
                                            <div id="initSix" style="display: none;">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="addTrioSeven" value="">
                                                    <label class="form-check-label" for="">Add More Locations</label>
                                                </div>
                                                <div class="form-check mb-3 form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="clearSixth" value="">
                                                    <label class="form-check-label" for="">Clear</label>
                                                </div>
                                            </div>
                                        </div>
                                            
                                        <div id="trioSeven">
                                            <input type="text" name="loc[]" id="locSixteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[18]).'">
                                            <input type="text" name="loc[]" id="locSeventeen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[19]).'">
                                            <input type="text" name="loc[]" id="locEighteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[20]).'">
                                            <div id="initSeven" style="display: none;">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="addTrioEight" value="">
                                                    <label class="form-check-label" for="">Add More Locations</label>
                                                </div>
                                                <div class="form-check mb-3 form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="clearSeventh" value="">
                                                    <label class="form-check-label" for="">Clear</label>
                                                </div>
                                            </div>
                                        </div>
                                            
                                        <div id="trioEight">
                                            <input type="text" name="loc[]" id="locTwentyTwo" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[21]).'">
                                            <input type="text" name="loc[]" id="locTwentyThree" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[22]).'">
                                            <input type="text" name="loc[]" id="locTwentyFour" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[23]).'">
                                            <div id="initEight" style="display: none;">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="addTrioNine" value="">
                                                    <label class="form-check-label" for="">Add More Locations</label>
                                                </div>
                                                <div class="form-check mb-3 form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="clearEighth" value="">
                                                    <label class="form-check-label" for="">Clear</label>
                                                </div>
                                            </div>
                                        </div>
                                            
                                        <div id="trioNine" style="display: none;">
                                            <input type="text" name="loc[]" id="locTwentyFive" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[24]).'">
                                            <input type="text" name="loc[]" id="locTwentySix" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[25]).'">
                                            <input type="text" name="loc[]" id="locTwentySeven" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[26]).'">
                                            <div id="initNine" style="display: none;">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="addTrioTen" value="">
                                                    <label class="form-check-label" for="">Add More Locations</label>
                                                </div>
                                                <div class="form-check mb-3 form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="clearNinth" value="">
                                                    <label class="form-check-label" for="">Clear</label>
                                                </div>
                                            </div>
                                        </div>
                                            
                                        <div id="trioTen" style="display: none;">
                                            <input type="text" name="loc[]" id="locTwentyEight" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[27]).'">
                                            <input type="text" name="loc[]" id="locTwentyNine" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[28]).'">
                                            <input type="text" name="loc[]" id="locThirty" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[29]).'">
                                            <div id="initTen" style="display: none;">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="addTrioEleven" value="">
                                                    <label class="form-check-label" for="">Add More Locations</label>
                                                </div>
                                                <div class="form-check mb-3 form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="clearTenth" value="">
                                                    <label class="form-check-label" for="">Clear</label>
                                                </div>
                                            </div>
                                        </div>';
                                        break;

                                        case 33:
                                            echo 
                                            '<div id="trioOne">
                                                <input type="text" name="loc[]" id="locOne" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[0]).'">
                                                <input type="text" name="loc[]" id="locTwo" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[1]).'">
                                                <input type="text" name="loc[]" id="locThree" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[2]).'">
                                                <div class="form-check mb-3" id="initOne">
                                                    <input class="form-check-input" type="checkbox" value="" id="addTrioTwo">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Add More Locations
                                                    </label>
                                                </div>
                                            </div>
                                        
                                            <div id="trioTwo">
                                                <input type="text" name="loc[]" id="locFour" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[3]).'">
                                                <input type="text" name="loc[]" id="locFive" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[4]).'">
                                                <input type="text" name="loc[]" id="locSix" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[5]).'">
                                                <div id="initTwo" class="mb-3">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="addTrioThree" value="">
                                                        <label class="form-check-label" for="">Add More Locations</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="clearSecond" value="">
                                                        <label class="form-check-label" for="">Clear</label>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                            <div id="trioThree">
                                                <input type="text" name="loc[]" id="locSeven" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[6]).'">
                                                <input type="text" name="loc[]" id="locEight" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[7]).'">
                                                <input type="text" name="loc[]" id="locNine" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[8]).'">
                                                <div id="initThree" class="mb-3">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="addTrioFour" value="">
                                                        <label class="form-check-label" for="">Add More Locations</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="clearThird" value="">
                                                        <label class="form-check-label" for="">Clear</label>
                                                    </div>
                                                </div>
                                            </div>
                                
                                            <div id="trioFour">
                                                <input type="text" name="loc[]" id="locTen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[9]).'">
                                                <input type="text" name="loc[]" id="locEleven" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[10]).'">
                                                <input type="text" name="loc[]" id="locTwelve" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[11]).'">
                                                <div id="initFour" class="mb-3">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="addTrioFive" value="">
                                                        <label class="form-check-label" for="">Add More Locations</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="clearFourth" value="">
                                                        <label class="form-check-label" for="">Clear</label>
                                                    </div>
                                                </div>
                                            </div>
                            
                                            <div id="trioFive">
                                                <input type="text" name="loc[]" id="locThirteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[12]).'">
                                                <input type="text" name="loc[]" id="locFourteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[13]).'">
                                                <input type="text" name="loc[]" id="locFifteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[14]).'">
                                                <div id="initFive" class="mb-3">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="addTrioSix" value="">
                                                        <label class="form-check-label" for="">Add More Locations</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="clearFifth" value="">
                                                        <label class="form-check-label" for="">Clear</label>
                                                    </div>
                                                </div>
                                            </div>
                        
                                            <div id="trioSix">
                                                <input type="text" name="loc[]" id="locSixteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[15]).'">
                                                <input type="text" name="loc[]" id="locSeventeen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[16]).'">
                                                <input type="text" name="loc[]" id="locEighteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[17]).'">
                                                <div id="initSix" style="display: none;">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="addTrioSeven" value="">
                                                        <label class="form-check-label" for="">Add More Locations</label>
                                                    </div>
                                                    <div class="form-check mb-3 form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="clearSixth" value="">
                                                        <label class="form-check-label" for="">Clear</label>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                            <div id="trioSeven">
                                                <input type="text" name="loc[]" id="locSixteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[18]).'">
                                                <input type="text" name="loc[]" id="locSeventeen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[19]).'">
                                                <input type="text" name="loc[]" id="locEighteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[20]).'">
                                                <div id="initSeven" style="display: none;">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="addTrioEight" value="">
                                                        <label class="form-check-label" for="">Add More Locations</label>
                                                    </div>
                                                    <div class="form-check mb-3 form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="clearSeventh" value="">
                                                        <label class="form-check-label" for="">Clear</label>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                            <div id="trioEight">
                                                <input type="text" name="loc[]" id="locTwentyTwo" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[21]).'">
                                                <input type="text" name="loc[]" id="locTwentyThree" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[22]).'">
                                                <input type="text" name="loc[]" id="locTwentyFour" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[23]).'">
                                                <div id="initEight" style="display: none;">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="addTrioNine" value="">
                                                        <label class="form-check-label" for="">Add More Locations</label>
                                                    </div>
                                                    <div class="form-check mb-3 form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="clearEighth" value="">
                                                        <label class="form-check-label" for="">Clear</label>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                            <div id="trioNine">
                                                <input type="text" name="loc[]" id="locTwentyFive" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[24]).'">
                                                <input type="text" name="loc[]" id="locTwentySix" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[25]).'">
                                                <input type="text" name="loc[]" id="locTwentySeven" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[26]).'">
                                                <div id="initNine" style="display: none;">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="addTrioTen" value="">
                                                        <label class="form-check-label" for="">Add More Locations</label>
                                                    </div>
                                                    <div class="form-check mb-3 form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="clearNinth" value="">
                                                        <label class="form-check-label" for="">Clear</label>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                            <div id="trioTen">
                                                <input type="text" name="loc[]" id="locTwentyEight" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[27]).'">
                                                <input type="text" name="loc[]" id="locTwentyNine" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[28]).'">
                                                <input type="text" name="loc[]" id="locThirty" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[29]).'">
                                                <div id="initTen" style="display: none;">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="addTrioEleven" value="">
                                                        <label class="form-check-label" for="">Add More Locations</label>
                                                    </div>
                                                    <div class="form-check mb-3 form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="clearTenth" value="">
                                                        <label class="form-check-label" for="">Clear</label>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                            <div id="trioEleven">
                                                <input type="text" name="loc[]" id="locThirtyOne" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[30]).'">
                                                <input type="text" name="loc[]" id="locThirtyTwo" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[31]).'">
                                                <input type="text" name="loc[]" id="locThirtyThree" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[32]).'">
                                                <div id="initEleven" style="display: none;">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="addTrioTwelve" value="">
                                                        <label class="form-check-label" for="">Add More Locations</label>
                                                    </div>
                                                    <div class="form-check mb-3 form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="clearEleventh" value="">
                                                        <label class="form-check-label" for="">Clear</label>
                                                    </div>
                                                </div>
                                            </div>';
                                            break;

                                            case 36:
                                                echo 
                                                '<div id="trioOne">
                                                    <input type="text" name="loc[]" id="locOne" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[0]).'">
                                                    <input type="text" name="loc[]" id="locTwo" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[1]).'">
                                                    <input type="text" name="loc[]" id="locThree" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[2]).'">
                                                    <div class="form-check mb-3" id="initOne">
                                                        <input class="form-check-input" type="checkbox" value="" id="addTrioTwo">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                                Add More Locations
                                                        </label>
                                                    </div>
                                                </div>
                                            
                                                <div id="trioTwo">
                                                    <input type="text" name="loc[]" id="locFour" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[3]).'">
                                                    <input type="text" name="loc[]" id="locFive" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[4]).'">
                                                    <input type="text" name="loc[]" id="locSix" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[5]).'">
                                                    <div id="initTwo" class="mb-3">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="addTrioThree" value="">
                                                            <label class="form-check-label" for="">Add More Locations</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="clearSecond" value="">
                                                            <label class="form-check-label" for="">Clear</label>
                                                        </div>
                                                    </div>
                                                </div>
                                        
                                                <div id="trioThree">
                                                    <input type="text" name="loc[]" id="locSeven" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[6]).'">
                                                    <input type="text" name="loc[]" id="locEight" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[7]).'">
                                                    <input type="text" name="loc[]" id="locNine" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[8]).'">
                                                    <div id="initThree" class="mb-3">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="addTrioFour" value="">
                                                            <label class="form-check-label" for="">Add More Locations</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="clearThird" value="">
                                                            <label class="form-check-label" for="">Clear</label>
                                                        </div>
                                                    </div>
                                                </div>
                                    
                                                <div id="trioFour">
                                                    <input type="text" name="loc[]" id="locTen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[9]).'">
                                                    <input type="text" name="loc[]" id="locEleven" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[10]).'">
                                                    <input type="text" name="loc[]" id="locTwelve" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[11]).'">
                                                    <div id="initFour" class="mb-3">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="addTrioFive" value="">
                                                            <label class="form-check-label" for="">Add More Locations</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="clearFourth" value="">
                                                            <label class="form-check-label" for="">Clear</label>
                                                        </div>
                                                    </div>
                                                </div>
                                
                                                <div id="trioFive">
                                                    <input type="text" name="loc[]" id="locThirteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[12]).'">
                                                    <input type="text" name="loc[]" id="locFourteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[13]).'">
                                                    <input type="text" name="loc[]" id="locFifteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[14]).'">
                                                    <div id="initFive" class="mb-3">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="addTrioSix" value="">
                                                            <label class="form-check-label" for="">Add More Locations</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="clearFifth" value="">
                                                            <label class="form-check-label" for="">Clear</label>
                                                        </div>
                                                    </div>
                                                </div>
                            
                                                <div id="trioSix">
                                                    <input type="text" name="loc[]" id="locSixteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[15]).'">
                                                    <input type="text" name="loc[]" id="locSeventeen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[16]).'">
                                                    <input type="text" name="loc[]" id="locEighteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[17]).'">
                                                    <div id="initSix" style="display: none;">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="addTrioSeven" value="">
                                                            <label class="form-check-label" for="">Add More Locations</label>
                                                        </div>
                                                        <div class="form-check mb-3 form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="clearSixth" value="">
                                                            <label class="form-check-label" for="">Clear</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                    
                                                <div id="trioSeven">
                                                    <input type="text" name="loc[]" id="locSixteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[18]).'">
                                                    <input type="text" name="loc[]" id="locSeventeen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[19]).'">
                                                    <input type="text" name="loc[]" id="locEighteen" class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[20]).'">
                                                    <div id="initSeven" style="display: none;">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="addTrioEight" value="">
                                                            <label class="form-check-label" for="">Add More Locations</label>
                                                        </div>
                                                        <div class="form-check mb-3 form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="clearSeventh" value="">
                                                            <label class="form-check-label" for="">Clear</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                    
                                                <div id="trioEight">
                                                    <input type="text" name="loc[]" id="locTwentyTwo" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[21]).'">
                                                    <input type="text" name="loc[]" id="locTwentyThree" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[22]).'">
                                                    <input type="text" name="loc[]" id="locTwentyFour" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[23]).'">
                                                    <div id="initEight" style="display: none;">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="addTrioNine" value="">
                                                            <label class="form-check-label" for="">Add More Locations</label>
                                                        </div>
                                                        <div class="form-check mb-3 form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="clearEighth" value="">
                                                            <label class="form-check-label" for="">Clear</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                    
                                                <div id="trioNine">
                                                    <input type="text" name="loc[]" id="locTwentyFive" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[24]).'">
                                                    <input type="text" name="loc[]" id="locTwentySix" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[25]).'">
                                                    <input type="text" name="loc[]" id="locTwentySeven" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[26]).'">
                                                    <div id="initNine" style="display: none;">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="addTrioTen" value="">
                                                            <label class="form-check-label" for="">Add More Locations</label>
                                                        </div>
                                                        <div class="form-check mb-3 form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="clearNinth" value="">
                                                            <label class="form-check-label" for="">Clear</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                    
                                                <div id="trioTen">
                                                    <input type="text" name="loc[]" id="locTwentyEight" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[27]).'">
                                                    <input type="text" name="loc[]" id="locTwentyNine" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[28]).'">
                                                    <input type="text" name="loc[]" id="locThirty" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[29]).'">
                                                    <div id="initTen" style="display: none;">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="addTrioEleven" value="">
                                                            <label class="form-check-label" for="">Add More Locations</label>
                                                        </div>
                                                        <div class="form-check mb-3 form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="clearTenth" value="">
                                                            <label class="form-check-label" for="">Clear</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                    
                                                <div id="trioEleven">
                                                    <input type="text" name="loc[]" id="locThirtyOne" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[30]).'">
                                                    <input type="text" name="loc[]" id="locThirtyTwo" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[31]).'">
                                                    <input type="text" name="loc[]" id="locThirtyThree" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[32]).'">
                                                    <div id="initEleven" style="display: none;">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="addTrioTwelve" value="">
                                                            <label class="form-check-label" for="">Add More Locations</label>
                                                        </div>
                                                        <div class="form-check mb-3 form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="clearEleventh" value="">
                                                            <label class="form-check-label" for="">Clear</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                    
                                                <div id="trioTwelve">
                                                    <input type="text" name="loc[]" id="locThirtyFour" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[33]).'">
                                                    <input type="text" name="loc[]" id="locThirtyFive" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[34]).'">
                                                    <input type="text" name="loc[]" id="locThirtySix" disabled class="form-control mb-3" placeholder="Name of Location" value="'.str_replace(",", "", $locArr[35]).'">
                                                    <div id="initTwelve" style="display: none;">
                                                        <div class="form-check mb-3 form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="clearTwelfth" value="">
                                                            <label class="form-check-label" for="">Clear</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="clearAll" value="">
                                                            <label class="form-check-label" for="">Clear All</label>
                                                        </div>
                                                    </div>
                                                </div>';
                                                break;

                    }
                    
                    ?>
                    <!-- <div id="initSix" style="display: none;">
                        <div class="form-check mb-3 form-check-inline">
                            <input class="form-check-input" type="checkbox" id="clearSixth" value="">
                            <label class="form-check-label" for="">Clear</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="clearAll" value="">
                            <label class="form-check-label" for="">Clear All</label>
                        </div>
                    </div> -->
                    <?php } ?>
                    <button type="submit" name="edit" class="btn btn-success">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/nicEdit-latest.js"></script>
    <script src="./js/nicEdit-component.js"></script>
</body>

</html>