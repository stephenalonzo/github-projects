<!-- <?php

require_once('./app-header.php');
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
    <script>
        window.history.forward();

        function noBack() {
            window.history.forward();
        }
    </script>
</head>

<body onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">
    <div class="container">
        <div class="wrapper">
            <div class="content w-25 mx-auto">
                <form class="mt-3" action="" method="POST">
                    <div class="form-floating mb-3">
                        <input type="text" name="user" class="form-control" id="" placeholder="Your Username" value="">
                        <label for="">Your Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="currentPw" class="form-control" id="" placeholder="Current Password" value="">
                        <label for="">Current Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="newPw" class="form-control" placeholder="New Password" id=""></input>
                        <label for="">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="confirmNewPw" class="form-control" placeholder="Confirm New Password" id=""></input>
                        <label for="">Confirm New Password</label>
                    </div>
                    <button type="submit" name="changePw" class="btn btn-primary">Change Password</button>
                </form>
            </div>
        </div>
    </div>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/popper.min.js"></script>
</body>

</html> -->