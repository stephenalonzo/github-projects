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
            <div class="content w-75 mx-auto py-3">
                <form action="" method="post">
                <table class="table table-bordered table-borderless">
                    <thead>
                        <tr>
                            <th class="align-middle">
                                &nbsp;
                            </th>
                            <th>Advisory Title</th>
                            <th>Advisory Date</th>
                            <th>Advisory Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <form action="" method="post">
                        <?php 

                        $results = getReports($params);

                        foreach ($results as $row)
                        {
                        
                        ?>
                            <tr>
                                <td class="align-middle">
                                    <div class="form-check d-flex justify-content-center">
                                        <input class="form-check-input" type="checkbox" name="advisoryID[<?php echo $row['id']; ?>]" value="<?php echo $row['id']; ?>" id="checkBox">
                                    </div>
                                </td>
                                <td>
                                    <?php echo $row['advisoryTitle']; ?>
                                </td>
                                <td>
                                    <?php echo date('F d, Y', strtotime($row['advisoryDate'])); ?>
                                </td>
                                <td>
                                    <?php
                                    
                                    // echo $row['advisorySts'];
                                    
                                    switch ($row['advisorySts'])
                                    {

                                        case "Green Flag":
                                            echo '<strong style="color: green;">Green Flag</strong>';
                                            break;

                                        case "Red Flag":
                                            echo '<strong style="color: red;">Red Flag</strong>';
                                            break;

                                    }
                                    
                                    ?>
                                </td>
                                <form action="" method="post" id="deleteAction">
                                <td class="d-flex justify-content-around">
                                        <a href="./edit.php?advisory=<?php echo $row['id']; ?>" target="_blank" class="btn btn-warning" style="color: #fff;">Edit</a>
                                        <input type="text" name="id" id="" value="<?php echo $row['id'] ?>" style="display: none;">
                                        <button for="deleteAction" type="submit" name="delete" onclick="return confirm('Are you sure you want to delete the following Beach Advisory?')" class="btn btn-danger" style="color: #fff;">Delete</button>
                                </td>
                                </form>
                                </tr>
                        <?php } ?>
                        </form>
                    </tbody>
                </table>
                    <span class="d-flex justify-content-end">
                        <button onclick="return confirm('Are you sure you want to delete these Beach Advisories?')" type="submit" name="deleteSelected" class="btn btn-danger me-3">
                            Delete Selected
                        </button>
                        <button onclick="return confirm('Are you sure you want to delete all the Beach Advisories?')" type="submit" name="deleteAll" class="btn btn-danger">
                            Delete All
                        </button>
                    </span>
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