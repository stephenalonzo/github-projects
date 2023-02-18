<?php

require_once('./app-header.php');
require_once('./app-authorization.php');
require_once('./app-functions.php');

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
                                <option value="" selected disabled>Title of Report</option>
                                <option value="1">Saipan West Beaches Marine Water Quality Report</option>
                                <option value="2">Saipan East Beaches Marine Water Quality Report</option>
                                <option value="3">Tinian Marine Water Quality Report</option>
                                <option value="4">Rota Marine Water Quality Report</option>
                                <option value="5">Managaha Marine Water Quality Report</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <input type="date" name="date" class="form-control" placeholder="" id="" required></input>
                                <label for="">Date</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="status" aria-label="" id="selectStatus" required>
                            <option value="" selected disabled>Beach Advisory Status</option>
                            <option value="GF">Green Flag</option>
                            <option value="RF">Red Flag</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="advDesc" required>
                            <!-- Saipan West Green Flag -->
                            <div id="swGF" style="display: none;">
                                <p>
                                The Bureau of Environmental and Coastal Quality (BECQ) analyzed marine water samples collected from <a href="https://becq.gov.mp/assets/img/beachadvisory/spn-west.jpg" target="_blank">Saipan's recreational western beaches</a> and storm drainages every week as part of a regularly scheduled sampling program. None of the samples collected from Saipan's west beaches contained excessive concentration of fecal indicator bacteria nor did they exceed the CNMI Marine Water Quality Standards. Therefore, BECQ assigns all of the sampled beach sites a <span class="green-flag"></span>. Enjoy our waters!
                                </p>
                            </div>

                            <!-- Saipan West Red Flag -->
                            <div id="swRF" style="display: none;">
                                <p>
                                The Division of Environmental Quality (DEQ) analyzed water samples collected from <a href="https://becq.gov.mp/assets/img/beachadvisory/spn-west.jpg" target="_blank">Saipan's west coast recreational beaches</a> and storm drainages every week. Samples collected from the following locations contained excessive concentrations of fecal indicator bacteria (enterococci) that exceeded the CNMI Marine Water Quality Standards. These bacteria can indicate the presence of human and animal waste in the water. <strong>However, studies have shown that storm water runoff in tropical environments may also contain these bacteria from the natural environment</strong>, which may not be directly associated with public health concerns. Therefore, In order to adequately address public health concerns, DEQ has given the following locations a <span class="red-flag"></span> and advises the public <strong>not to fish or swim within 300 feet of these locations for the next 48 hours or until otherwise notified</strong>.
                                </p>
                            </div>

                            <!-- Saipan East Green Flag -->
                            <div id="seGF" style="display: none;">
                                <p>
                                The Bureau of Environmental and Coastal Quality (BECQ) analyzes water samples collected from <a href="https://becq.gov.mp/assets/img/beachadvisory/spn-east.jpg" target="_blank">Saipan's east and south recreational beaches</a> this week as part of the regularly scheduled sampling. None of the samples collected contained excessive concentration of fecal indicator bacteria nor did they exceed the CNMI Marine Water Quality Standards. Therefore, BECQ assigns the following sampled beach sites a <span class="green-flag"></span>. Enjoy our waters!
                                </p>
                            </div>

                            <!-- Saipan East Red Flag -->
                            <div id="seRF" style="display: none;">
                                <p>
                                The Division of Environmental Quality (DEQ) analyzed water samples collected from <a href="https://becq.gov.mp/assets/img/beachadvisory/spn-east.jpg" target="_blank">Saipan's east and south recreational beaches</a> and storm drainages every week. Samples collected from the following locations contained excessive concentrations of fecal indicator bacteria (enterococci) that exceeded the CNMI Marine Water Quality Standards. These bacteria can indicate the presence of human and animal waste in the water. <strong>However, studies have shown that storm water runoff in tropical environments may also contain these bacteria from the natural environment</strong>, which may not be directly associated with public health concerns. Therefore, In order to adequately address public health concerns, DEQ has given the following locations a <span class="red-flag"></span> and advises the public <strong>not to fish or swim within 300 feet of these locations for the next 48 hours or until otherwise notified</strong>.
                                </p>
                            </div>

                            <!-- Tinian Green Flag -->
                            <div id="tGF" style="display: none;">
                                <p>
                                The Bureau of Environmental and Coastal Quality (BECQ) analyzed (10) water samples collected from <a href="https://becq.gov.mp/assets/img/beachadvisory/tinian.jpg" target="_blank">Tinian’s recreational beaches</a> and storm water drainages this week as part of the regularly scheduled sampling. None of the samples collected contained excessive concentration of fecal indicator bacteria nor did they exceed the CNMI Marine Water Quality Standards. Therefore, BECQ assigns all of the sampled beach sites a <span class="green-flag"></span>. Enjoy our waters!
                                </p>
                            </div>

                            <!-- Tinian Red Flag -->
                            <div id="tRF" style="display: none;">
                                <p>
                                The Division of Environmental Quality (DEQ) analyzed water samples collected this week from <a href="https://becq.gov.mp/assets/img/beachadvisory/tinian.jpg" target="_blank">Tinian’s recreational beaches</a> and storm drainages. Samples collected from the following locations contained excessive concentrations of fecal indicator bacteria (enterococci) that exceeded the CNMI Marine Water Quality Standards. These bacteria can indicate the presence of human and animal waste in the water. <strong>However, studies have shown that storm water runoff in tropical environments may also contain these bacteria from the natural environment</strong>, which may not be directly associated with public health concerns. Therefore, In order to adequately address public health concerns, DEQ has given the following locations a <span class="red-flag"></span> and advises the public <strong>not to fish or swim within 300 feet of these locations for the next 48 hours or until otherwise notified</strong>.                        
                                </p>
                            </div>

                            <!-- Rota Green Flag -->
                            <div id="rGF" style="display: none;">
                                <p>
                                The Division of Environmental Quality (DEQ) analyzed water samples collected from <a href="https://becq.gov.mp/assets/img/beachadvisory/rota.jpg" target="_blank">Rota's recreational beaches</a> and storm drainages this week. None of the samples collected contained excessive concentrations of fecal indicator bacteria nor did they exceed the CNMI Marine Water Quality Standards. Therefore, DEQ assigns all of the sampled beach sites a <span class="green-flag"></span>. Enjoy our waters!
                                </p>
                            </div>

                            <!-- Rota Red Flag -->
                            <div id="rRF" style="display: none;">
                                <p>
                                The Division of Environmental Quality (DEQ) analyzed water samples collected from <a href="https://becq.gov.mp/assets/img/beachadvisory/rota.jpg" target="_blank">Rota's recreational beaches</a> and storm drainages. Samples collected from the following locations contained excessive concentrations of fecal indicator bacteria (enterococci) that exceeded the CNMI Marine Water Quality Standards. These bacteria can indicate the presence of human and animal waste in the water. <strong>However, studies have shown that storm water runoff in tropical environments may also contain these bacteria from the natural environment</strong>, which may not be directly associated with public health concerns. Therefore, In order to adequately address public health concerns, DEQ has given the following locations a <span class="red-flag"></span> and advises the public <strong>not to fish or swim within 300 feet of these locations for the next 48 hours or until otherwise notified</strong>.
                                </p>
                            </div>

                            <!-- Managaha Green Flag -->
                            <div id="mGF" style="display: none;">
                                <p>
                                The Bureau of Environmental and Coastal Quality (BECQ) analyzes water samples collected from <a href="https://becq.gov.mp/assets/img/beachadvisory/managaha.jpg" target="_blank">Managaha’s recreational beaches</a> and dock as part of the regularly scheduled sampling. None of the samples collected this week contained excessive concentrations of fecal indicator bacteria nor did they exceed the CNMI Marine Water Quality Standards. Therefore, BECQ assigns all of the sampled beach sites a <span class="green-flag"></span>. Enjoy our waters!
                                </p>
                            </div>

                            <!-- Managaha Red Flag -->
                            <div id="mRF" style="display: none;">
                                <p>
                                The Bureau of Environmental and Coastal Quality (BECQ) analyzes water samples collected from <a href="https://becq.gov.mp/assets/img/beachadvisory/managaha.jpg" target="_blank">Managaha’s recreational beaches</a> and dock as part of the regularly scheduled sampling. Samples collected from the following locations contained excessive concentrations of fecal indicator bacteria (enterococci) that exceeded the CNMI Marine Water Quality Standards. These bacteria can indicate the presence of human and animal waste in the water. <strong>However, studies have shown that storm water runoff in tropical environments may also contain these bacteria from the natural environment</strong>, which may not be directly associated with public health concerns. Therefore, In order to adequately address public health concerns, DEQ has given the following locations a <span class="red-flag"></span> and advises the public <strong>not to fish or swim within 300 feet of these locations for the next 48 hours or until otherwise notified</strong>.
                                </p>
                            </div>
                        </textarea>
                    </div>
                    <div id="trioOne" style="display: none;">
                        <label class="form-check-label" for="">
                            1.
                        </label>
                        <input type="text" name="loc[]" id="locOne" disabled class="form-control mb-3" placeholder="Name of Location">
                        <label class="form-check-label" for="">
                            2.
                        </label>
                        <input type="text" name="loc[]" id="locTwo" disabled class="form-control mb-3" placeholder="Name of Location">
                        <label class="form-check-label" for="">
                            3.
                        </label>
                        <input type="text" name="loc[]" id="locThree" disabled class="form-control mb-3" placeholder="Name of Location">
                        <div class="form-check mb-3" id="initOne">
                            <input class="form-check-input" type="checkbox" value="" id="addTrioTwo">
                            <label class="form-check-label" for="flexCheckDefault">
                                Add More Locations
                            </label>
                        </div>
                    </div>
                    <div id="trioTwo" style="display: none;">
                    <label class="form-check-label" for="">
                            4.
                        </label>
                        <input type="text" name="loc[]" id="locFour" disabled class="form-control mb-3" placeholder="Name of Location">
                        <label class="form-check-label" for="">
                            5.
                        </label>
                        <input type="text" name="loc[]" id="locFive" disabled class="form-control mb-3" placeholder="Name of Location">
                        <label class="form-check-label" for="">
                            6.
                        </label>
                        <input type="text" name="loc[]" id="locSix" disabled class="form-control mb-3" placeholder="Name of Location">
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
                    <div id="trioThree" style="display: none;">
                        <label class="form-check-label" for="">
                            7.
                        </label>
                        <input type="text" name="loc[]" id="locSeven" disabled class="form-control mb-3" placeholder="Name of Location">
                        <label class="form-check-label" for="">
                            8.
                        </label>
                        <input type="text" name="loc[]" id="locEight" disabled class="form-control mb-3" placeholder="Name of Location">
                        <label class="form-check-label" for="">
                            9.
                        </label>
                        <input type="text" name="loc[]" id="locNine" disabled class="form-control mb-3" placeholder="Name of Location">
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
                    <div id="trioFour" style="display: none;">
                    <label class="form-check-label" for="">
                            10.
                        </label>
                        <input type="text" name="loc[]" id="locTen" disabled class="form-control mb-3" placeholder="Name of Location">
                        <label class="form-check-label" for="">
                            11.
                        </label>
                        <input type="text" name="loc[]" id="locEleven" disabled class="form-control mb-3" placeholder="Name of Location">
                        <label class="form-check-label" for="">
                            12.
                        </label>
                        <input type="text" name="loc[]" id="locTwelve" disabled class="form-control mb-3" placeholder="Name of Location">
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
                    <div id="trioFive" style="display: none;">
                    <label class="form-check-label" for="">
                            13.
                        </label>
                        <input type="text" name="loc[]" id="locThirteen" disabled class="form-control mb-3" placeholder="Name of Location">
                        <label class="form-check-label" for="">
                            14.
                        </label>
                        <input type="text" name="loc[]" id="locFourteen" disabled class="form-control mb-3" placeholder="Name of Location">
                        <label class="form-check-label" for="">
                            15.
                        </label>
                        <input type="text" name="loc[]" id="locFifteen" disabled class="form-control mb-3" placeholder="Name of Location">
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
                    <div id="trioSix" style="display: none;">
                        <label class="form-check-label" for="">
                            16.
                        </label>
                        <input type="text" name="loc[]" id="locSixteen" disabled class="form-control mb-3" placeholder="Name of Location">
                        <label class="form-check-label" for="">
                            17.
                        </label>
                        <input type="text" name="loc[]" id="locSeventeen" disabled class="form-control mb-3" placeholder="Name of Location">
                        <label class="form-check-label" for="">
                            18.
                        </label>
                        <input type="text" name="loc[]" id="locEighteen" disabled class="form-control mb-3" placeholder="Name of Location">
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
                    <div id="trioSeven" style="display: none;">
                        <label class="form-check-label" for="">
                            19.
                        </label>
                        <input type="text" name="loc[]" id="locNineteen" disabled class="form-control mb-3" placeholder="Name of Location">
                        <label class="form-check-label" for="">
                            20.
                        </label>
                        <input type="text" name="loc[]" id="locTwenty" disabled class="form-control mb-3" placeholder="Name of Location">
                        <label class="form-check-label" for="">
                            21.
                        </label>
                        <input type="text" name="loc[]" id="locTwentyOne" disabled class="form-control mb-3" placeholder="Name of Location">
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
                    <div id="trioEight" style="display: none;">
                        <label class="form-check-label" for="">
                            22.
                        </label>
                        <input type="text" name="loc[]" id="locTwentyTwo" disabled class="form-control mb-3" placeholder="Name of Location">
                        <label class="form-check-label" for="">
                            23.
                        </label>
                        <input type="text" name="loc[]" id="locTwentyThree" disabled class="form-control mb-3" placeholder="Name of Location">
                        <label class="form-check-label" for="">
                            24.
                        </label>
                        <input type="text" name="loc[]" id="locTwentyFour" disabled class="form-control mb-3" placeholder="Name of Location">
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
                        <label class="form-check-label" for="">
                            25.
                        </label>
                        <input type="text" name="loc[]" id="locTwentyFive" disabled class="form-control mb-3" placeholder="Name of Location">
                        <label class="form-check-label" for="">
                            26.
                        </label>
                        <input type="text" name="loc[]" id="locTwentySix" disabled class="form-control mb-3" placeholder="Name of Location">
                        <label class="form-check-label" for="">
                            27.
                        </label>
                        <input type="text" name="loc[]" id="locTwentySeven" disabled class="form-control mb-3" placeholder="Name of Location">
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
                        <label class="form-check-label" for="">
                            28.
                        </label>
                        <input type="text" name="loc[]" id="locTwentyEight" disabled class="form-control mb-3" placeholder="Name of Location">
                        <label class="form-check-label" for="">
                            29.
                        </label>
                        <input type="text" name="loc[]" id="locTwentyNine" disabled class="form-control mb-3" placeholder="Name of Location">
                        <label class="form-check-label" for="">
                            30.
                        </label>
                        <input type="text" name="loc[]" id="locThirty" disabled class="form-control mb-3" placeholder="Name of Location">
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
                    <div id="trioEleven" style="display: none;">
                        <label class="form-check-label" for="">
                            31.
                        </label>
                        <input type="text" name="loc[]" id="locThirtyOne" disabled class="form-control mb-3" placeholder="Name of Location">
                        <label class="form-check-label" for="">
                            32.
                        </label>
                        <input type="text" name="loc[]" id="locThirtyTwo" disabled class="form-control mb-3" placeholder="Name of Location">
                        <label class="form-check-label" for="">
                            33.
                        </label>
                        <input type="text" name="loc[]" id="locThirtyThree" disabled class="form-control mb-3" placeholder="Name of Location">
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
                    <div id="trioTwelve" style="display: none;">
                        <label class="form-check-label" for="">
                            34.
                        </label>
                        <input type="text" name="loc[]" id="locThirtyFour" disabled class="form-control mb-3" placeholder="Name of Location">
                        <label class="form-check-label" for="">
                            35.
                        </label>
                        <input type="text" name="loc[]" id="locThirtyFive" disabled class="form-control mb-3" placeholder="Name of Location">
                        <label class="form-check-label" for="">
                            36.
                        </label>
                        <input type="text" name="loc[]" id="locThirtySix" disabled class="form-control mb-3" placeholder="Name of Location">
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
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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