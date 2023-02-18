<?php 

require_once('./controller.php');

?>

<ul class="li-square li-tight">

    <?php 

    $results = getReport($params);

        
    for ($m=1; $m<=12; $m++) {
        $lastYear[] = date('F Y', mktime(0, 0, 0, $m, 1, date('Y')-1));
        $newYear[]  = date('F Y', mktime(0, 0, 0, $m, 1, date('Y')));
    }

    switch (date('n')) {

        case 1:
            foreach (array_splice($lastYear, 6, 11) as $key => $value) {
                echo '<li><a href="./beach-advisory-results.html#'.strtolower(date('MY', strtotime($value))).'">'.date('F Y', strtotime($value)).'</a></li>';
            }
            foreach (array_splice($newYear, 0, 1) as $key => $value) {
                echo '<li><a href="./beach-advisory-results.html#'.strtolower(date('MY', strtotime($value))).'">'.date('F Y', strtotime($value)).'</a></li>';
            }
        break;

        case 2:
            foreach (array_splice($lastYear, 7, 11) as $key => $value) {
                echo '<li><a href="./beach-advisory-results.html#'.strtolower(date('MY', strtotime($value))).'">'.date('F Y', strtotime($value)).'</a></li>';
            }
            foreach (array_splice($newYear, 0, 2) as $key => $value) {
                echo '<li><a href="./beach-advisory-results.html#'.strtolower(date('MY', strtotime($value))).'">'.date('F Y', strtotime($value)).'</a></li>';
            }
        break;

        case 3:
            foreach (array_splice($lastYear, 8, 11) as $key => $value) {
                echo '<li><a href="./beach-advisory-results.html#'.strtolower(date('MY', strtotime($value))).'">'.date('F Y', strtotime($value)).'</a></li>';
            }
            foreach (array_splice($newYear, 0, 3) as $key => $value) {
                echo '<li><a href="./beach-advisory-results.html#'.strtolower(date('MY', strtotime($value))).'">'.date('F Y', strtotime($value)).'</a></li>';
            }
        break;

        case 4:
            foreach (array_splice($lastYear, 9, 11) as $key => $value) {
                echo '<li><a href="./beach-advisory-results.html#'.strtolower(date('MY', strtotime($value))).'">'.date('F Y', strtotime($value)).'</a></li>';
            }
            foreach (array_splice($newYear, 0, 4) as $key => $value) {
                echo '<li><a href="./beach-advisory-results.html#'.strtolower(date('MY', strtotime($value))).'">'.date('F Y', strtotime($value)).'</a></li>';
            }
        break;

        case 5:
            foreach (array_splice($lastYear, 10, 11) as $key => $value) {
                echo '<li><a href="./beach-advisory-results.html#'.strtolower(date('MY', strtotime($value))).'">'.date('F Y', strtotime($value)).'</a></li>';
            }
            foreach (array_splice($newYear, 0, 5) as $key => $value) {
                echo '<li><a href="./beach-advisory-results.html#'.strtolower(date('MY', strtotime($value))).'">'.date('F Y', strtotime($value)).'</a></li>';
            }
        break;

        case 6:
            foreach (array_splice($lastYear, 11) as $key => $value) {
                echo '<li><a href="./beach-advisory-results.html#'.strtolower(date('MY', strtotime($value))).'">'.date('F Y', strtotime($value)).'</a></li>';
            }
            foreach (array_splice($newYear, 0, 6) as $key => $value) {
                echo '<li><a href="./beach-advisory-results.html#'.strtolower(date('MY', strtotime($value))).'">'.date('F Y', strtotime($value)).'</a></li>';
            }
        break;

        case 7:
            foreach (array_splice($newYear, 1, 6) as $key => $value) {
                echo '<li><a href="./beach-advisory-results.html#'.strtolower(date('MY', strtotime($value))).'">'.date('F Y', strtotime($value)).'</a></li>';
            }
        break;

        case 8:
            foreach (array_splice($newYear, 2, 7) as $key => $value) {
                echo '<li><a href="./beach-advisory-results.html#'.strtolower(date('MY', strtotime($value))).'">'.date('F Y', strtotime($value)).'</a></li>';
            }
        break;

        case 9:
            foreach (array_splice($newYear, 3, 8) as $key => $value) {
                echo '<li><a href="./beach-advisory-results.html#'.strtolower(date('MY', strtotime($value))).'">'.date('F Y', strtotime($value)).'</a></li>';
            }
        break;

        case 10:
            foreach (array_splice($newYear, 4, 9) as $key => $value) {
                echo '<li><a href="./beach-advisory-results.html#'.strtolower(date('MY', strtotime($value))).'">'.date('F Y', strtotime($value)).'</a></li>';
            }
        break;

        case 11:
            foreach (array_splice($newYear, 5, 10) as $key => $value) {
                echo '<li><a href="./beach-advisory-results.html#'.strtolower(date('MY', strtotime($value))).'">'.date('F Y', strtotime($value)).'</a></li>';
            }
        break;

        case 12:
            foreach (array_splice($newYear, 6, 11) as $key => $value) {
                echo '<li><a href="./beach-advisory-results.html#'.strtolower(date('MY', strtotime($value))).'">'.date('F Y', strtotime($value)).'</a></li>';
            }
        break;

        default:
        break;

    }
    
    ?>

</ul>