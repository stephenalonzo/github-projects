<?php

error_reporting (E_ALL ^ E_NOTICE);
error_reporting (E_ERROR | E_PARSE);
date_default_timezone_set('Pacific/Saipan');

function dbAccess($params)
{

    try {

		// Establish connection with the localhost
        $pdo = new PDO("mysql:host=localhost;dbname=github_projects", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        foreach ($params['dba'] as $key => $value) { $stmt = $pdo->prepare($params['dba'][$key]); }

        $stmt->execute($params['bindParam']);

        return $stmt;
        
    } catch (PDOException $e) {

        echo "Connection failed: " . $e->getMessage();
  
    }

    return $params;

}

//load events data from db
function load($params) {

    //run sql connection and query
    $data = array();
    $params['dba']['s']  = "SELECT * FROM pavreservations";

    $stmt           = dbAccess($params);
    $result         = $stmt->fetchAll(PDO::FETCH_ASSOC);    

    //output events data from db in array using foreach loop
    foreach($result as $row) {

        // get string component of confirmID
        $str    = $row['confirmID'];
        $title  = explode('-', $str);
        $trimmedTitle   = trim($title[0]);

        // assign page link
        switch ($trimmedTitle) {
            
            case 'SIBP':
                $params['link']  = './san-isidro-beach-park.php';
                break;

            case 'KBP':
                $params['link']  = './kilili-beach.php';
                break;

            case 'CKBC':
                $params['link']  = './chalan-kanoa-basketball-court.php';
                break;

            default:
            $params['link'] = strtolower(str_replace("#", "", str_replace(" ", "-", preg_replace('/[0-9]+/', '', $row['pavName'])))).".php";
            
        }

        if ($row['pavStatus'] == 'CANCELED') {

        } else {

            $data[] = array(
                'id'   => $row["id"],
                'title' => $row['pavName'], 
                'pillTitle'   => $row["pavName"],
                'start'   => date('Y-m-d', strtotime($row['resStart'])),
                'end'   => date('Y-m-d', strtotime($row['resEnd'])),
                'status' => $row['pavStatus'],
                'description' => $row['pavName'],
                'url'         => $params['link'],
                'borderColor' => $row['pavColor']
            );

        }

    }

    //echo and convert array to JSON representation
    echo json_encode($data);
    
}

//execute load function
load($params);

?>