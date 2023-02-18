<?php

  error_reporting (E_ALL ^ E_NOTICE);
  error_reporting (E_ERROR | E_PARSE);
  date_default_timezone_set('Pacific/Saipan');

  function dbAccess($params)
  {

    try
    {

      $pdo = new PDO("mysql:host=localhost;dbname=opd", 'opdW', 'B62XPdHClHukD7Q0', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

      $stmt = $pdo->prepare($params['sql']);
      $stmt->execute();

      return $stmt;

    } catch (PDOException $e) {

      echo "Connection failed: " . $e->getMessage();

    }

    return $params;

  }

  //load events data from db
  function load($params)
  {

    $data = array(); // output data to calendar will be an array
    $params['sql'] = "SELECT * FROM events";
    $stmt = dbAccess($params);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //output events data from db in array using foreach loop
    foreach($result as $row)
    {

      $description = $row['eventDesc'];
      $sentence = preg_replace('/(.*?[?!.](?=\s|$)).*/', '\\1', $description);

      if(($row['allDay'] == '1') == 1)
      {

        $data[] = array(
          'id'              => $row["id"],
          'title'           => $row["eventTitle"],
          'start'           => $row["startDate"],
          'description'     => $sentence,
          'end'             => $row["endDate"],
          'allDay'          => $row['allDay'],
          'url'             => "../event.php?id=".$row['id']."&title=".$row['eventTitle'],
          'backgroundColor' => $row['eventColor'],
          'borderColor'     => $row['eventColor'],
          'keywords'        => $row['eventTags'],
          'category'        => $row['eventCategory']
        );

      } else {

        $data[] = array(
          'id'   => $row["id"],
          'title'   => $row["eventTitle"],
          'start'   => $row["startDate"],
          'description' => $sentence,
          'end'   => $row["endDate"],
          'url'   => "../event.php?id=".$row['id']."&title=".$row['eventTitle'],
          'backgroundColor' => $row['eventColor'],
          'borderColor' => $row['eventColor'],
          'keywords' => $row['eventTags'],
          'category' => $row['eventCategory']
        );

      }

    }

    //echo and convert array to JSON representation
    echo json_encode($data);

  }

  //execute load function
  load($params);

?>
