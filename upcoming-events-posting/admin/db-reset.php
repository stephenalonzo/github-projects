<?php

function dbAccess()
{

    try
    {
        // $pdo = new PDO("mysql:host=localhost;dbname=opd", 'root', '');
        $pdo = new PDO("mysql:host=localhost;dbname=opd", 'opdW', 'B62XPdHClHukD7Q0', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
         

    } catch(PDOException $e) {

        echo "Connection failed: " . $e->getMessage();
      
    }

    return $pdo;

}

$pdo = dbAccess();

if(!$_GET['id']) {

    echo 'not nice';

} else {

    function resetPW($pdo)
    {

        try
        {
            
            $params['id'] = $_GET['id'];
            $params['dba']['u'] = "UPDATE events_users SET resetSts = '1', pass = 'monday' WHERE id = :id";
            $stmt = $pdo->prepare($params['dba']['u']);
            $stmt->bindParam(':id', $params['id']);
            $stmt->execute();

            if($params['dba']['u'])
            {

                $key = 'e1613246c0a361340b1f64f4ab3bf0bd06de8704f29e6acb4c';
                header("Location: index.php?pwReset=$key");


            } else {

                // echo 'not nice';

            }
            
        } catch(PDOException $e) {

            echo "Connection failed: " . $e->getMessage();
          
        }

    }

    resetPW($pdo);

}

?>
