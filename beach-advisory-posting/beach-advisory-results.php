<?php 

require_once('./controller.php');

?>

                <script>
                    $(document).ready(function() {    
                        if (window.location.hash)
                        {
                            setTimeout(function()
                            {

                                $('html, body').scrollTop(0).show();
                                $('html, body').animate({
                                scrollTop: $(window.location.hash).offset().top
                                }, 0)

                            }, 0);
                        }
                    });
                </script>
                <?php 
                    
                $results = getReport($params);

                foreach ($results as $row)
                {

                ?>
                <div id="<?php echo strtolower(date('M', strtotime($row['advisoryDate']))) . date('Y', strtotime($row['advisoryDate'])); ?>">
                    <div class="ba">
                        <hr>
                        <h4>
                            Marine Quality Report for the week of <?php echo date('F d, Y', strtotime($row['advisoryDate'])); ?>
                        </h4>
                        <div>
                            <p class="fw-bold text-uppercase">
                                <?php echo $row['advisoryTitle']; ?>
                            </p>
                            <?php

                            if($row['advisorySts'] == "Green Flag")
                            {

                                echo '<h4 class="green-flag"></h4>';

                            } else {

                                echo '<h4 class="red-flag"></h4>';

                            }
                            
                            ?>
                            <div class="ba-desc">
                                <?php echo $row['advisoryDesc']; ?>
                            </div>
                            <table id="becqTable" class="table-borderless d-flex justify-content-center align-items-center">
                                    <tbody class="d-flex">
                                <?php
                                
                                $locations = $row['advisoryLocations'];
                                $locArr = explode(", ", $locations);

                                switch(count($locArr))
                                {

                                    case 1:
                                        echo
                                        "<tr>
                                        <td class='fw-bold'>
                                        $locArr[0]
                                        </td>
                                        </tr>";
                                        break;

                                    case 2:
                                        echo
                                        "<tr>
                                        <td class='fw-bold'>
                                        $locArr[0]
					</br>
					$locArr[1]
                                        </br>
                                        </td>
                                        </tr>";
                                        break;


                                    case 3:
                                        echo 
                                        "<tr>
                                        <td class='fw-bold'>
                                        $locArr[0]
                                        </br>
                                        $locArr[1]
                                        </br>
                                        $locArr[2]
                                        </td>
                                        </tr>";
                                        break;

				    case 4:
                                        echo 
                                        "<tr>
                                        <td class='fw-bold'>
                                        $locArr[0]
                                        </br>
                                        $locArr[1]
                                        </br>
                                        $locArr[2]
					</br>
                                        $locArr[3]
                                        </td>
                                        </tr>";
                                        break;

				case 5:
                                        echo 
                                        "<tr>
                                        <td class='fw-bold'>
                                        $locArr[0]
                                        </br>
                                        $locArr[1]
                                        </br>
                                        $locArr[2]
					</br>
                                        $locArr[3]
					</br>
                                        $locArr[4]
                                        </td>
                                        </tr>";
                                        break;


                                    case 6: 
                                        echo 
                                        "<tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[0]
                                        </br>
                                        $locArr[1]
                                        </br>
                                        $locArr[2]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[3]
                                        </br>
                                        $locArr[4]
                                        </br>
                                        $locArr[5]
                                        </td>
                                        </tr>";
                                        break;

				    case 7: 
                                        echo 
                                        "<tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[0]
                                        </br>
                                        $locArr[1]
                                        </br>
                                        $locArr[2]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[3]
                                        </br>
                                        $locArr[4]
                                        </br>
                                        $locArr[5]
                                        </td>
                                        </tr>

					<tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[6]
                                        </td>
                                        </tr>";
                                        break;

				    case 8: 
                                        echo 
                                        "<tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[0]
                                        </br>
                                        $locArr[1]
                                        </br>
                                        $locArr[2]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[3]
                                        </br>
                                        $locArr[4]
                                        </br>
                                        $locArr[5]
                                        </td>
                                        </tr>

					<tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[6]
					</br>
                                        $locArr[7]
                                        </td>
                                        </tr>";
                                        break;

                                    case 9: 
                                        echo 
                                        "<tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[0]
                                        </br>
                                        $locArr[1]
                                        </br>
                                        $locArr[2]
                                        </td>
                                        </tr>

                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[3]
                                        </br>
                                        $locArr[4]
                                        </br>
                                        $locArr[5]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[6]
                                        </br>
                                        $locArr[7]
                                        </br>
                                        $locArr[8]
                                        </td>
                                        </tr>";
                                        break;

                                    case 12: 
                                        echo 
                                        "<tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[0]
                                        </br>
                                        $locArr[1]
                                        </br>
                                        $locArr[2]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[3]
                                        </br>
                                        $locArr[4]
                                        </br>
                                        $locArr[5]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[6]
                                        </br>
                                        $locArr[7]
                                        </br>
                                        $locArr[8]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[9]
                                        </br>
                                        $locArr[10]
                                        </br>
                                        $locArr[11]
                                        </td>
                                        </tr>";
                                        break;

                                    case 15: 
                                        echo 
                                        "<tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[0]
                                        </br>
                                        $locArr[1]
                                        </br>
                                        $locArr[2]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[3]
                                        </br>
                                        $locArr[4]
                                        </br>
                                        $locArr[5]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[6]
                                        </br>
                                        $locArr[7]
                                        </br>
                                        $locArr[8]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[9]
                                        </br>
                                        $locArr[10]
                                        </br>
                                        $locArr[11]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[12]
                                        </br>
                                        $locArr[13]
                                        </br>
                                        $locArr[14]
                                        </td>
                                        </tr>";
                                        break;

                                    case 18: 
                                        echo 
                                        "<tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[0]
                                        </br>
                                        $locArr[1]
                                        </br>
                                        $locArr[2]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[3]
                                        </br>
                                        $locArr[4]
                                        </br>
                                        $locArr[5]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[6]
                                        </br>
                                        $locArr[7]
                                        </br>
                                        $locArr[8]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[9]
                                        </br>
                                        $locArr[10]
                                        </br>
                                        $locArr[11]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[12]
                                        </br>
                                        $locArr[13]
                                        </br>
                                        $locArr[14]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[15]
                                        </br>
                                        $locArr[16]
                                        </br>
                                        $locArr[17]
                                        </td>
                                        </tr>";
                                        break;
                                        
                                    case 21: 
                                        echo 
                                        "<tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[0]
                                        </br>
                                        $locArr[1]
                                        </br>
                                        $locArr[2]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[3]
                                        </br>
                                        $locArr[4]
                                        </br>
                                        $locArr[5]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[6]
                                        </br>
                                        $locArr[7]
                                        </br>
                                        $locArr[8]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[9]
                                        </br>
                                        $locArr[10]
                                        </br>
                                        $locArr[11]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[12]
                                        </br>
                                        $locArr[13]
                                        </br>
                                        $locArr[14]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[15]
                                        </br>
                                        $locArr[16]
                                        </br>
                                        $locArr[17]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[18]
                                        </br>
                                        $locArr[19]
                                        </br>
                                        $locArr[20]
                                        </td>
                                        </tr>";
                                        break;

                                    case 24: 
                                        echo 
                                        "<tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[0]
                                        </br>
                                        $locArr[1]
                                        </br>
                                        $locArr[2]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[3]
                                        </br>
                                        $locArr[4]
                                        </br>
                                        $locArr[5]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[6]
                                        </br>
                                        $locArr[7]
                                        </br>
                                        $locArr[8]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[9]
                                        </br>
                                        $locArr[10]
                                        </br>
                                        $locArr[11]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[12]
                                        </br>
                                        $locArr[13]
                                        </br>
                                        $locArr[14]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[15]
                                        </br>
                                        $locArr[16]
                                        </br>
                                        $locArr[17]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[18]
                                        </br>
                                        $locArr[19]
                                        </br>
                                        $locArr[20]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[21]
                                        </br>
                                        $locArr[22]
                                        </br>
                                        $locArr[23]
                                        </td>
                                        </tr>";
                                        break;

                                    case 27: 
                                        echo 
                                        "<tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[0]
                                        </br>
                                        $locArr[1]
                                        </br>
                                        $locArr[2]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[3]
                                        </br>
                                        $locArr[4]
                                        </br>
                                        $locArr[5]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[6]
                                        </br>
                                        $locArr[7]
                                        </br>
                                        $locArr[8]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[9]
                                        </br>
                                        $locArr[10]
                                        </br>
                                        $locArr[11]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[12]
                                        </br>
                                        $locArr[13]
                                        </br>
                                        $locArr[14]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[15]
                                        </br>
                                        $locArr[16]
                                        </br>
                                        $locArr[17]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[18]
                                        </br>
                                        $locArr[19]
                                        </br>
                                        $locArr[20]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[21]
                                        </br>
                                        $locArr[22]
                                        </br>
                                        $locArr[23]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[24]
                                        </br>
                                        $locArr[25]
                                        </br>
                                        $locArr[26]
                                        </td>
                                        </tr>";
                                        break;

                                    case 30: 
                                        echo 
                                        "<tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[0]
                                        </br>
                                        $locArr[1]
                                        </br>
                                        $locArr[2]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[3]
                                        </br>
                                        $locArr[4]
                                        </br>
                                        $locArr[5]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[6]
                                        </br>
                                        $locArr[7]
                                        </br>
                                        $locArr[8]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[9]
                                        </br>
                                        $locArr[10]
                                        </br>
                                        $locArr[11]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[12]
                                        </br>
                                        $locArr[13]
                                        </br>
                                        $locArr[14]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[15]
                                        </br>
                                        $locArr[16]
                                        </br>
                                        $locArr[17]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[18]
                                        </br>
                                        $locArr[19]
                                        </br>
                                        $locArr[20]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[21]
                                        </br>
                                        $locArr[22]
                                        </br>
                                        $locArr[23]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[24]
                                        </br>
                                        $locArr[25]
                                        </br>
                                        $locArr[26]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[27]
                                        </br>
                                        $locArr[28]
                                        </br>
                                        $locArr[29]
                                        </td>
                                        </tr>";
                                        break;

                                    case 33: 
                                        echo 
                                        "<tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[0]
                                        </br>
                                        $locArr[1]
                                        </br>
                                        $locArr[2]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[3]
                                        </br>
                                        $locArr[4]
                                        </br>
                                        $locArr[5]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[6]
                                        </br>
                                        $locArr[7]
                                        </br>
                                        $locArr[8]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[9]
                                        </br>
                                        $locArr[10]
                                        </br>
                                        $locArr[11]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[12]
                                        </br>
                                        $locArr[13]
                                        </br>
                                        $locArr[14]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[15]
                                        </br>
                                        $locArr[16]
                                        </br>
                                        $locArr[17]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[18]
                                        </br>
                                        $locArr[19]
                                        </br>
                                        $locArr[20]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[21]
                                        </br>
                                        $locArr[22]
                                        </br>
                                        $locArr[23]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[24]
                                        </br>
                                        $locArr[25]
                                        </br>
                                        $locArr[26]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[27]
                                        </br>
                                        $locArr[28]
                                        </br>
                                        $locArr[29]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[30]
                                        </br>
                                        $locArr[31]
                                        </br>
                                        $locArr[32]
                                        </td>
                                        </tr>";
                                        break;

                                    case 36: 
                                        echo 
                                        "<tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[0]
                                        </br>
                                        $locArr[1]
                                        </br>
                                        $locArr[2]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[3]
                                        </br>
                                        $locArr[4]
                                        </br>
                                        $locArr[5]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[6]
                                        </br>
                                        $locArr[7]
                                        </br>
                                        $locArr[8]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-5'>
                                        <td class='fw-bold'>
                                        $locArr[9]
                                        </br>
                                        $locArr[10]
                                        </br>
                                        $locArr[11]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[12]
                                        </br>
                                        $locArr[13]
                                        </br>
                                        $locArr[14]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[15]
                                        </br>
                                        $locArr[16]
                                        </br>
                                        $locArr[17]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[18]
                                        </br>
                                        $locArr[19]
                                        </br>
                                        $locArr[20]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[21]
                                        </br>
                                        $locArr[22]
                                        </br>
                                        $locArr[23]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[24]
                                        </br>
                                        $locArr[25]
                                        </br>
                                        $locArr[26]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[27]
                                        </br>
                                        $locArr[28]
                                        </br>
                                        $locArr[29]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[30]
                                        </br>
                                        $locArr[31]
                                        </br>
                                        $locArr[32]
                                        </td>
                                        </tr>
                                        
                                        <tr class='mx-3'>
                                        <td class='fw-bold'>
                                        $locArr[33]
                                        </br>
                                        $locArr[34]
                                        </br>
                                        $locArr[35]
                                        </td>
                                        </tr>";
                                        break;

                                    case "":
                                        echo '';
                                        break;

                                    default:
                                        echo '';
                                        break;

                                }
                                
                                ?>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <?php } ?> 
                </div>