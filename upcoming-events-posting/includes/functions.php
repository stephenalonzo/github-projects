<?php

    error_reporting (E_ALL ^ E_NOTICE);
    error_reporting(E_ERROR | E_PARSE);
    date_default_timezone_set('Pacific/Saipan');

// $sql="update visitor_counter set visitor_counter=visitor_counter+30";

// $stmt=$conn->prepare($sql);
// $stmt->execute();

// $sql="select visitor_counter from visitor_counter";

// $stmt=$conn->prepare($sql);
// $stmt->execute();

// $arr=$stmt->fetchAll(PDO::FETCH_ASSOC);

// $counter=$arr[0]['visitor_counter'];
// $count=strlen($counter);

    function dbAccess($params)
    {

        try
        {

            $pdo = new PDO("mysql:host=localhost;dbname=opd", 'opdW', 'B62XPdHClHukD7Q0', array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));
            $params['dba']['u'] = "UPDATE visitor_counter SET visitor_counter = visitor_counter+30";
            $stmt = $pdo->prepare($params['dba']['u']);
            $stmt->execute();
            $params['rowCount'] = $stmt->rowCount();
            
            if($params['rowCount'] == 1)
            {
    
                $params['dba']['s'] = "SELECT visitor_counter FROM visitor_counter";
                $stmt = $pdo->prepare($params['dba']['s']);
                $stmt->execute();
    
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                return $results;
    
            } else {
    
                // do nothing
    
            }

        } catch(PDOException $e) {
            
            $e->getMessage();

        }

    }

?>