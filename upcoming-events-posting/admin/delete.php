<?php

  function dbAccess($params)
  {
    
    try
    {

      $pdo = new PDO("mysql:host=localhost;dbname=opd", 'opdW', 'B62XPdHClHukD7Q0', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

      $stmt = $pdo->prepare($params['sql']);
      $stmt->execute($params['bindParam']);

      return $stmt;

    } catch (PDOException $e) {

      echo "Connection failed: " . $e->getMessage();

    }

    return $params;

  }

  if (!$_GET['event'])
  {

    // echo 'not nice';

  } else {

    function deleteEvent($pdo)
    {

      $params['id'] = $_GET['event'];
      $params['sql'] = "DELETE FROM events WHERE id = :id";

      $params['bindParam'] = array(
        ':id' => $params['id']
      );

      dbAccess($params);

      if ($params['sql'])
      {

        header('Location: manage-events.php');

      } else {

        // echo 'not nice';

      }

    }

    deleteEvent($pdo);

  }
