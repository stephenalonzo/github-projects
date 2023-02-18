<?php

require_once('./admin/calendar-form.php');

?>
        <section class="opd-events spacing">
            <div class="container">
                <h1>Upcoming Events</h1>
                <div class="opd-events-body">
                    <div class="row">
                        <?php

                        $results = getEvent($params);

                        foreach ($results as $row) {

                        ?>

                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-upper-text">
                                    <h5 class="text-uppercase">
                                        <?php

                                        echo date('M', strtotime($row['startDate']));

                                        ?>
                                    </h5>
                                    <h3>
                                        <?php

                                        echo date('j', strtotime($row['startDate']));

                                        ?>
                                    </h3>
                                    <p class="card-text">
                                        <small>
                                            <?php

                                            if($row['allDay'] == 1)
                                            {

                                                echo 'All Day';

                                            } else {

                                                echo date('h:iA', strtotime($row['startDate']));

                                            }

                                            ?>
                                        </small>
                                    </p>
                                    </div>
                                    <div class="card-middle-text">
                                    <p class="card-text">
                                        <?php
                                        
                                        if(str_word_count($row['eventTitle']) == 3)
                                        {

                                            $array = explode(" ", $row['eventTitle']);
                                            $total = array_chunk($array, 2);

                                            foreach ($total as $new)
                                            {

                                                echo implode(" ", $new)."<br>";

                                            }

                                        } elseif(str_word_count($row['eventTitle']) == 4)
                                        {

                                            $array = explode(" ", $row['eventTitle']);
                                            $total = array_chunk($array, 3);

                                            foreach ($total as $new)
                                            {

                                                echo implode(" ", $new)."<br>";

                                            }

                                        } else {

                                            echo $row['eventTitle'];

                                        }

                                        ?>
                                    </p>
                                    </div>
                                    <a href="./event.php?id=<?php echo $row['id']; ?>&title=<?php echo $row['eventTitle']; ?>" class="btn btn-primary mt-1" target="_blank">Learn More</a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="row" style="margin: 35px auto 25px auto;" id="viewPreviousPosts">
                            <div class="col-lg-12 text-center">
                                <a href="./calendar.php" class="btn btn-primary" target="_blank" style="width: 225px;">View Calendar
                                </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
